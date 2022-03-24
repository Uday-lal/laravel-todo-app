<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function getLoginTemplate(Request $request) {
        $isLogin = $this->isLogin($request);

        if ($isLogin) {
            return redirect("/");
        }
        return view("login");
    }

    public function userLogin(Request $request) {
        $email = $request->input()["email"];
        $password = $request->input()["password"];
        $users = new Users();
        $userData = DB::table("users")->where("email", $email)->first();
        $userPassword = $userData->password;
        if (Hash::check($password, $userPassword)) {
            $request->session()->put("user_id", $userData->id);
            return redirect("/");
        }
        return redirect($request->url());
    }

    public function getCreateAccountTemplate(Request $request) {
        $isLogin = $this->isLogin($request);
        if ($isLogin) {
            return redirect("/");
        }
        return view("create_account");
    }

    public function createAccount(Request $request) {
        $username = $request->input()["username"];
        $email = $request->input()["email"];
        $password = $request->input()["password"];
        $conformPassword = $request->input()["conform-password"];

        if ($password != $conformPassword) {
            return redirect($request->url());
        }
        $users = new Users();
        $users->username = $username;
        $users->password = Hash::make($password);
        $users->email = $email;
        $users->save();

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
