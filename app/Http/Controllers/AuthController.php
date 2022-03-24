<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index(Request $request) {
        $isLogin = $this->isLogin($request);

        if ($isLogin) {
            return redirect("/");
        }
        return view("login");
    }

    public function createAccount(Request $request) {
        $isLogin = $this->isLogin($request);
        if ($isLogin) {
            return redirect("/");
        }
        return view("create_account");
    }

    private function isLogin(Request $request) {
        $userId = $request->session()->get("user_id");
        if (!isset($userId)) {
            return false;
        }
        return true;
    }
}
