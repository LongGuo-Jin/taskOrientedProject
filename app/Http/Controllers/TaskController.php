<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index() {
        echo "index";
    }

    public function taskCard() {
        return view('task/taskCard');
    }

    public function taskList() {
        return view('task/taskList');
    }
}
