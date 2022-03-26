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
        $nextTasks = DB::table("todo")->where("status", "next")->where("user_id", $userId)->get();
        $onProgressTask = DB::table("todo")->where("status", "on_progress")->where("user_id", $userId)->get();
        $doneTask = DB::table("todo")->where("status", "done")->where("user_id", $userId)->get();
        return view("welcome", 
            [
                "next" => $nextTasks, 
                "on_progress" => $onProgressTask, 
                "done" => $doneTask,
                "user_data" => $userData,
                "manager_view" => false,
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
        
        if ($this->validateInputLenght($task, 20) && $this->validateInputLenght($discription, 50)) {
            $todo->task = $task;
            $todo->discription = $discription;
            $todo->status = $status;
            $todo->date = $currentDate;
            $todo->user_id = $userId;

            $todo->save();
            $request->session()->flash("message", "Task created");
            $request->session()->flash("type", "success");
        } else {
            $request->session()->flash("message", "Title and discription are too long");
            $request->session()->flash("type", "error");
        }
        return redirect($request->url());
    }

    public function update(Request $request) {
        $taskId = $request->input()["task-id"];
        $task = $request->input()["task"];
        $discription = $request->input()["discription"];
        $userId = $request->session()->get("user_id");

        if ($this->validateInputLenght($task, 20) && $this->validateInputLenght($discription, 50)) {
            DB::table("todo")->where("id", $taskId)->update(
                [
                    "discription" => $discription,
                    "task" => $task
                ]
            );
            $request->session()->flash("message", "Task created");
            $request->session()->flash("type", "success");
        } else {
            $request->session()->flash("message", "Title and discription are too long");
            $request->session()->flash("type", "error");
        }
        return redirect()->back();
    }

    public function progress(Request $request, $status, $id) {
        $todoData = DB::table("todo")->where("id", $id)->first();
        if (isset($todoData)) {
            abort(404);
        }
        if ($status == "delete") {
            DB::table("todo")->where("id", $id)->delete();
            $request->session()->flash("message", "Task removed");
            $request->session()->flash("type", "success");
        } else {
            DB::table("todo")->where("id", $id)->update(
                [
                    "status" => $status
                ]
            );
            $request->session()->flash("message", "Task updated");
            $request->session()->flash("type", "success");
        }
        return redirect("/");
    }

    public function delete(Request $request, $id) {
        $isLogin = $this->isLogin($request);
        if (!$isLogin) {
            return redirect("/login");
        }
        $todoData = DB::table("todo")->where("id", $id)->where(
            "user_id",
            $request->session()->get('user_id')
        )->first();

        if (isset($todoData)) {
            DB::table("todo")->where("id", $id)->delete();
            $request->session()->flash("message", "Task removed");
            $request->session()->flash("type", "success");
        } else {
            abort(404);
        }
        return redirect()->back();
    }

    public function logout(Request $request) {
        $request->session()->forget("user_id");
        $request->session()->flash("message", "You are logged out");
        $request->session()->flash("type", "success");
        return redirect("/login");
    }

    private function validateInputLenght($value, $lenght) {
        if (strlen($value) > $lenght) {
            return false;
        }
        return true;
    }

    private function isLogin(Request $request) {
        $userId = $request->session()->get("user_id");
        if (!isset($userId)) {
            return false;
        }
        return true;
    }
}
