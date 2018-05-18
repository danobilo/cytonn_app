<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use App\Task as Task;
use App\Department as Department;
use App\Category as Category;
use App\User as User;
use App\Tag as Tag;
use App\Comment as Comment;
use App\Document as Document;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Mail\TaskMail as TaskMail;

class TasksController extends Controller {

    //
    public function __construct(Task $task, Department $department, Category $category, User $user, Tag $tag) {
        $this->task = $task;
        $this->department = $department;
        $this->category = $category;
        $this->user = $user;
        $this->tag = $tag;
    }

    public function index(Request $request) {
        $data = [];


        $data['tasks'] = $this->task->where('private', '=', 0)->orWhere([['private', '=', 1], ['assigned_to', '=', Auth::user()->id]])->orWhere([['private', '=', 1], ['created_by', '=', Auth::user()->id]])->get();
        $data['departments'] = $this->department->all();

        return view('task/index', $data);
    }

    public function showSelectedTasks(Request $request) {

        $data = [];
        $query = [];

        $data['department'] = $request->input('department');
        $data['tasks'] = $request->input('tasks');
        $data['access'] = $request->input('access');

//        if ($data['department'] > 0) {
//            $query[] = ['department_id', '=', $data['department']];
//        }

        if ($data['tasks'] === 'user') {
            $query[] = ['assigned_to', '=', Auth::user()->id];
        }

        if ($data['tasks'] === 'overdue') {

            $query[] = ['assigned_to', '=', Auth::user()->id];
            $query[] = ['progress', '<', 100];
            $query[] = ['due_date', '<', Carbon::today()];
        }

        if ($data['tasks'] === 'open') {
            $query[] = ['assigned_to', '=', Auth::user()->id];
            $query[] = ['open', '=', 1];
        }

        if ($data['access'] === '1') {
            $query[] = ['private', '=', $data['access']];
        }

        if ($data['access'] === '0') {
            $query[] = ['private', '=', $data['access']];
        }

//        if ($data['department'] > 0) {
//            $data['tasks'] = Task::join('tags', 'tags.task_id', '=', 'tasks.id')
//                    ->join('users', 'tags.user_id', '=', 'users.id')
//                    ->join('departments', 'users.department_id', '=', 'departments.id')
//                    ->where($query)
//                    ->get();
//        } else {
        $data['tasks'] = Task::where($query)->get();
//        }


        $data['departments'] = $this->department->all();
        return view('task/index', $data);
    }

    public function export() {
        $data = [];

        $data['tasks'] = $this->task->all();
        header('Content-Disposition: attachment;filename=export.xls');
        return view('task/export', $data);
    }

    public function newTask(Request $request, Task $task) {

        $data = [];

        if ($request->isMethod('post')) {
//            dd($data);
            $this->validate(
                    $request, [
                'title' => 'required',
                'description' => 'required',
                'assigned_to' => 'required',
                'category_id' => 'required',
                'start_date' => 'required',
                'due_date' => 'required',
                'priority' => 'required',
                'private' => 'required',
                'progress' => 'required',
                    ]
            );

            $task->title = $request->input('title');
            $task->description = $request->input('description');
            $task->assigned_to = $request->input('assigned_to');
            $task->category_id = $request->input('category_id');
            $task->start_date = $request->input('start_date');
            $task->due_date = $request->input('due_date');
            $task->priority = $request->input('priority');
            $task->open = '1';
            $task->private = $request->input('private');
            $task->progress = $request->input('progress');
            $task->created_by = $request->input('assigned_to');
            $task->reccurring = 0;

            $task->save();

            $lastInsertedId = $task->id;

            $data['user_group'] = $request->input('user_group');
            $data['user_group'][] = $request->input('assigned_to');
            foreach ($data['user_group'] as $value) {
                $tag = new TagsController();
                $tag->addTag($lastInsertedId, $value);

//                $mail = new TaskMail;
//                $mail->send();
            }

            return redirect('tasks');
        }

        $data['title'] = $request->input('title');
        $data['description'] = $request->input('description');
        $data['assigned_to'] = $request->input('assigned_to');
        $data['category_id'] = $request->input('category_id');
        $data['start_date'] = $request->input('start_date');
        $data['due_date'] = $request->input('due_date');
        $data['priority'] = $request->input('priority');
        $data['private'] = $request->input('private');
        $data['progress'] = $request->input('progress');
        $data['created_by'] = $request->input('assigned_to');
//        $data['reccurring'] = '0';
        $list = array();
        $usergoup = DB::table('users')
                ->join('departments', 'users.department_id', '=', 'departments.id')
                ->select('users.id AS user_id', 'users.name AS user_name', 'departments.id AS department_id', 'departments.name AS department_name')
                ->get();

        foreach ($usergoup as $row) {

            $list[$row->department_id]['id'] = $row->department_id;
            $list[$row->department_id]['name'] = $row->department_name;
            $list[$row->department_id]['children'][$row->user_id]['id'] = $row->user_id;
            $list[$row->department_id]['children'][$row->user_id]['name'] = $row->user_name;
        }

        $data['categories'] = $this->category->all();
        $data['employees'] = $this->user->all();

        $data['departments'] = $list;

        $data['priorities'] = ['Urgent', 'High', 'Medium', 'Low'];
        $data['modify'] = 0;
        return view('task/form')->with('data', $data);
    }

    public function create() {
        return view('task/create');
    }

    public function show($task_id, Request $request) {
        $data = [];
        $data['task_id'] = $task_id;
        $data['modify'] = 1;
        $task_data = $this->task->find($task_id);
        $data['title'] = $task_data->title;
        $data['description'] = $task_data->description;
        $data['assigned_to'] = $task_data->assigned_to;
        $data['category_id'] = $task_data->category_id;
        $data['start_date'] = $task_data->start_date;
        $data['due_date'] = $task_data->due_date;
        $data['priority'] = $task_data->priority;
        $data['private'] = $task_data->private;
        $data['progress'] = $task_data->progress;

        $tags = DB::table('tags')->where('task_id', '=', $task_id)->get();

        foreach ($tags as $tag) {
            $data['user_group'][] = $tag->user_id;
        }
        $list = array();
        $usergoup = DB::table('users')
                ->join('departments', 'users.department_id', '=', 'departments.id')
                ->select('users.id AS user_id', 'users.name AS user_name', 'departments.id AS department_id', 'departments.name AS department_name')
                ->get();

        foreach ($usergoup as $row) {

            $list[$row->department_id]['id'] = $row->department_id;
            $list[$row->department_id]['name'] = $row->department_name;
            $list[$row->department_id]['children'][$row->user_id]['id'] = $row->user_id;
            $list[$row->department_id]['children'][$row->user_id]['name'] = $row->user_name;
        }

        $data['categories'] = $this->category->all();
        $data['employees'] = $this->user->all();

        $data['departments'] = $list;

        $data['priorities'] = ['Urgent', 'High', 'Medium', 'Low'];


        return view('task/form')->with('data', $data);
    }

    public function taskDetails($task_id, Request $request) {



        $data = [];

        $data['task'] = $this->task->find($task_id);
        $data['user'] = Auth::user();
        $data['tags'] = Tag::where('task_id', $task_id)->get();
        $data['comments'] = Comment::where('task_id', $task_id)->get();
        $data['documents'] = Document::where('task_id', $task_id)->get();

        $data['departments'] = DB::table('departments')
                ->join('users', 'users.department_id', '=', 'departments.id')
                ->join('tags', 'tags.user_id', '=', 'users.id')
                ->where('task_id', $task_id)
                ->select('departments.*')
                ->get();

        if ($data['task']->priority === 'Urgent') {
            $data['badge'] = 'danger';
        }
        if ($data['task']->priority === 'High') {
            $data['badge'] = 'warning';
        }
        if ($data['task']->priority === 'Medium') {
            $data['badge'] = 'primary';
        }
        if ($data['task']->priority === 'Low') {
            $data['badge'] = 'info';
        }



        return view('task/details', $data);
    }

    public function modify(Request $request, $task_id, Task $task) {
        $data = [];

        $data['title'] = $request->input('title');
        $data['description'] = $request->input('description');
        $data['assigned_to'] = $request->input('assigned_to');
        $data['category_id'] = $request->input('category_id');
        $data['start_date'] = $request->input('start_date');
        $data['due_date'] = $request->input('due_date');
        $data['priority'] = $request->input('priority');
//        $data['open'] = $request->input('open');
        $data['private'] = $request->input('private');
        $data['progress'] = $request->input('progress');
//        $data['reccurring'] = $request->input('reccurring');



        if ($request->isMethod('post')) {
            //dd($data);
            $this->validate(
                    $request, [
                'title' => 'required',
                'description' => 'required',
                'assigned_to' => 'required',
                'category_id' => 'required',
                'start_date' => 'required',
                'due_date' => 'required',
                'priority' => 'required',
                'private' => 'required',
                'progress' => 'required',
                    ]
            );

            $task_data = $this->task->find($task_id);

            $task_data->title = $request->input('title');
            $task_data->description = $request->input('description');
            $task_data->assigned_to = $request->input('assigned_to');
            $task_data->category_id = $request->input('category_id');
            $task_data->start_date = $request->input('start_date');
            $task_data->due_date = $request->input('due_date');
            $task_data->priority = $request->input('priority');
            $task_data->private = $request->input('private');
            $task_data->progress = $request->input('progress');

            $task_data->save();

            return redirect('tasks');
        }

        return view('task/form', $data);
    }

    public function upload(Request $request, $task_id, Document $document) {
        $data = [];
        if ($request->isMethod('post')) {
//            $this->validate(
//                    $request, [
//                'image_upload' => 'mimes:jpeg,bmp,png'
//                    ]
//            );
            Input::file('image_upload')->move('documents');

            $document->task_id = $task_id;
            $document->name = $_FILES['image_upload']['name'];
            $document->save();

            return redirect('/');
        }
        return view('task/upload', $data);
    }

    public function showBoard() {
        $data = [];
        $data['selected_user'] = 0;
        $data['employees'] = $this->user->all();
        $data['upcoming'] = $this->task->where('progress', 0)->get();
        $data['ongoing'] = Task::where('progress', '>', 0)->get();
        $data['completed'] = Task::where('progress', 100)->get();

        return view('task/taskboard', $data);
    }

    public function showUserBoard(Request $request) {
        $data = [];
        $user_id = $request->input('user');
        $data['selected_user'] = $user_id;

        if ($user_id > 0) {

            $data['employees'] = $this->user->all();
            $data['upcoming'] = Task::where([['progress', '=', 0], ['assigned_to', '=', $user_id]])->get();
            $data['ongoing'] = Task::where([['progress', '>', 0], ['assigned_to', '=', $user_id]])->get();
            $data['completed'] = Task::where([['progress', '=', 100], ['assigned_to', '=', $user_id]])->get();
        } else {
            $data['employees'] = $this->user->all();
            $data['upcoming'] = Task::where('progress', 0)->get();
            $data['ongoing'] = Task::where('progress', '>', 0)->get();
            $data['completed'] = Task::where('progress', 100)->get();
        }

        return view('task/taskboard', $data);
    }

}
