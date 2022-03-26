<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;


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
        $nextTasks = DB::table("todo")->where("status", "next")->get();
        $onProgressTask = DB::table("todo")->where("status", "on_progress")->get();
        $doneTask = DB::table("todo")->where("status", "done")->get();
        return view("welcome", [
            "next" => $nextTasks, 
            "on_progress" => $onProgressTask, 
            "done" => $doneTask,
            "user_data" => $userData,
            "is_manager" => $isManager
        ]);
    }

    public function createTask(Request $request) {
        $isLogin = $this->isLogin($request);
        $isManager = $request->session()->get("is_manager");
        if (!$isLogin || !$isManager) {
            abort(403);
        }
        $title = $requst->input()["task"];
        $discription = $request->input()["discription"];
    }

    private function isLogin(Request $request) {
        $userId = $request->session()->get("user_id");
        if (!isset($userId)) {
            return false;
        }
        return true;
    }
}
