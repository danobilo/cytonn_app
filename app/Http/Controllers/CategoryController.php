<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department As Department;
use App\Category As Category;

class CategoryController extends Controller {

    public function __construct(Department $department) {
        $this->department = $department;
    }

    public function newCategory(Request $request, Category $category) {

        $data = [];

        if ($request->isMethod('post')) {
//            dd($data);
            $this->validate(
                    $request, [
                'name' => 'required',
                    ]
            );

            $category->name = $request->input('name');
            $category->department_id = $request->input('department_id');

            $category->save();

            return redirect('tasks');
        }

        $data['departments'] = $this->department->all();

        return view('category/createCategory', $data);
    }

}
