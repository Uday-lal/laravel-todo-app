<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
    public function index(Request $request) {
        $isLogin = $this->isLogin($request);

        if (!$isLogin) {
            return redirect("/login");
        }
        $userId = $request->session()->get("user_id");
        $userData = DB::table("users")->where("id", $userId)->first();
        $nextTasks = DB::table("todo")->where("status", "next")->get();
        $onProgressTask = DB::table("todo")->where("status", "on_progress")->get();
        $doneTask = DB::table("todo")->where("status", "done")->get();
        return view("welcome", 
            [
                "next" => $nextTasks, 
                "on_progress" => $onProgressTask, 
                "done" => $doneTask,
                "user_data" => $userData,
                "is_manager" => $request->session()->get("is_manager")
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

    public function update(Request $request) {
        $taskId = $request->input()["task-id"];
        $task = $request->input()["task"];
        $discription = $request->input()["discription"];
        $userId = $request->session()->get("user_id");

        DB::table("todo")->where("id", $taskId)->update(
            [
                "discription" => $discription,
                "task" => $task
            ]
        );
        return redirect("/");
    }

    public function progress(Request $request, $status, $id) {
        if ($status == "delete") {
            DB::table("todo")->where("id", $id)->delete();
        } else {
            DB::table("todo")->where("id", $id)->update(
                [
                    "status" => $status
                ]
            );
        }
        return redirect("/");
    }

    public function logout(Request $request) {
        $request->session()->forget("user_id");
        return redirect("/login");
    }

    private function isLogin(Request $request) {
        $userId = $request->session()->get("user_id");
        if (!isset($userId)) {
            return false;
        }
        return true;
    }
}
