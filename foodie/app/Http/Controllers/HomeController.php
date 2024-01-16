<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use function Laravel\Prompts\search;

class HomeController extends Controller
{
    public function index()
    {
        $data['categories'] = Category::all();
        return view("home.home", $data);
    }

    public function search(Request $req)
    {
        $search = $req->search;
        $data['search'] = Product::where("title", "like", "%$search%")->orWhere('price',$search)->get();
        $data['categories'] = Category::all();
        $data['search'] = $search;
        return view("home.home",  $data);
    }

    

    public function login(Request $req)
    {
        if ($req->isMethod("post")) {
            $data = $req->validate([
                'email' => 'required',
                'password' => 'required'
            ]);

            if (Auth::attempt($data)) {
                return redirect()->route('home')->with("success", "login successfully");
            } else {
                return redirect()->back()->with("error", "Email or Password is invalid");
            }
        }
        return view("home.login");
    }

    public function signup(Request $request)
    {
        if ($request->isMethod("post")) {
            $data = $request->validate([
                'name' => 'required',
                'email' => 'required',
                'password' => 'required',
            ]);

            $data['password'] = bcrypt($data['password']);
            User::create($data);
            return redirect()->route("login");
        }
        return view("home.signup");
    }

    public function logout(Request $req)
    {
        Auth::logout();
        return redirect()->route("login");
    }

   
}
