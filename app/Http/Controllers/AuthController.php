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
        if (isset($userData)) {
            $userPassword = $userData->password;
            if (Hash::check($password, $userPassword)) {
                $request->session()->put("user_id", $userData->id);
                $request->session()->put("is_manager",  $userData->role == "manager");
                $request->session()->flash("message", "You are logged in");
                $request->session()->flash("type", "success");
                return redirect("/");
            }
            $request->session()->flash("message", "Password did not match");
            $request->session()->flash("type", "error");
            return redirect($request->url());
        }
        $request->session()->flash("message", "Invalid email");
        $request->session()->flash("type", "error");
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
            $request->session()->flash("message", "Password did not match");
            $request->session()->flash("type", "error");
            return redirect($request->url());
        }
        $userData = DB::table("users")->where("email", $email)->first();
        if (!isset($userData)) {
            $users = new Users();
            $users->username = $username;
            $users->password = Hash::make($password);
            $users->email = $email;
            $users->role = "user";
            $users->save();
            $request->session()->flash("message", "You accout is created");
            $request->session()->flash("type", "success");
            return redirect("/login");
        }
        $request->session()->flash("message", "This email is already been used try another one");
        $request->session()->flash("type", "error");
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
