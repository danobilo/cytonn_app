<?php

namespace App\Http\Controllers;

use App\Task as Task;
use App\Document as Document;

use Illuminate\Http\Request;

class DocumentsController extends Controller
{
     //
    public function addDocument($task_id, $name) {
        $document = new Document();
        $task_instance = new Task();

        $task = $task_instance->find($task_id);
        $document->name = $name;

        $document->task()->associate($task);

        $document->save();

        return redirect()->route('tasks');
        //return view('reservations/bookRoom');
    }
    
    public function download($filename) {
        return response()->download('../documents/'.$filename);
    }
}
