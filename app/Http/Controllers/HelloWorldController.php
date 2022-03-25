<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\Todo;

class HelloWorldController extends Controller
{
    public function index(Request $request) {
        $isLogin = $this->isLogin($request);

        if (!$isLogin) {
            return redirect("/login");
        }
        $nextTasks = DB::table("todo")->where("status", "next")->get();
        $onProgressTask = DB::table("todo")->where("status", "on_progress")->get();
        $doneTask = DB::table("todo")->where("status", "done")->get();
        return view("welcome", [
            "next" => $nextTasks, 
            "on_progress" => $onProgressTask, 
            "done" => $doneTask
            ]
        );
    }

    public function createTask(Request $request) {
        $task = $request->input()["task"];
        $discription = $request->input()["discription"];
        $userId = $request->session()->get("user_id");
        $currentDate = date("Y-m-d");
        $status = "next";
        $todo = new Todo();
        
        $todo->task = $task;
        $todo->discription = $discription;
        $todo->status = $status;
        $todo->date = $currentDate;
        $todo->user_id = $userId;

        $todo->save();
        return redirect($request->url());
    }

    private function isLogin(Request $request) {
        $userId = $request->session()->get("user_id");
        if (!isset($userId)) {
            return false;
        }
        return true;
    }
}
