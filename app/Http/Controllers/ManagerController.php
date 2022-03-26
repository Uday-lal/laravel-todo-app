<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\Todo;


class ManagerController extends Controller
{
    public function getUsers(Request $request) {
        $isLogin = $this->isLogin($request);
        $isManager = $request->session()->get("is_manager");
        if (!$isLogin || !$isManager) {
            abort(403);
        }
        $userId = $request->session()->get("user_id");
        $userData = DB::table("users")->where("id", $userId)->first();
        $allUserData = DB::table("users")->where("id", "!=", $userId)->get();
        return view("users", [
            "user_data" => $userData,
            "all_user_data" => $allUserData
        ]);
    }

    public function getUser(Request $request, $id) {
        $isLogin = $this->isLogin($request);
        $isManager = $request->session()->get("is_manager");
        if (!$isLogin || !$isManager) {
            abort(403);
        };
        $userData = DB::table("users")->where("id", $id)->first();
        if (isset($userData)) {
            $nextTasks = DB::table("todo")->where("status", "next")->get();
            $onProgressTask = DB::table("todo")->where("status", "on_progress")->get();
            $doneTask = DB::table("todo")->where("status", "done")->get();
            return view("welcome", [
                "next" => $nextTasks, 
                "on_progress" => $onProgressTask, 
                "done" => $doneTask,
                "user_data" => $userData,
                "manager_view" => true,
                "is_manager" => $isManager
            ]);
        } else {
            abort(404);
        }
    }

    public function createTask(Request $request, $id) {
        $isLogin = $this->isLogin($request);
        $isManager = $request->session()->get("is_manager");
        if (!$isLogin || !$isManager) {
            abort(403);
        }
        $userData = DB::table("users")->where("id", $id)->first();
        if (isset($userData)) {
            abort(404);
        }
        $title = $request->input()["task"];
        $discription = $request->input()["discription"];

        if ($this->validateInputLenght($title, 20) && $this->validateInputLenght($discription, 50)) {
            $todoModel = new Todo();
            $todoModel->task = $title;
            $todoModel->discription = $discription;
            $todoModel->user_id = $id;
            $todoModel->status = "next";
            $todoModel->date = date("Y-m-d");
            $todoModel->save();
            $request->session()->flash("message", "Task created");
            $request->session()->flash("type", "success");
        } else {
            $request->session()->flash("message", "Title and discription are too long");
            $request->session()->flash("type", "error");
        }
        return redirect($request->url());
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
