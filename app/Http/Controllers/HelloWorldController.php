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
        return view("welcome");
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
