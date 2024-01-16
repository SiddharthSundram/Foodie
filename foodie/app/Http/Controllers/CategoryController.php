<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function manageCategory(Request $req)
    {
        if ($req->isMethod("post")) {
            $data = $req->validate(['cat_title' => 'required']);


            Category::create($data);

            return redirect()->route("admin.category")->with("success", "Category inserted successfully");
        }


        $data['categories'] = Category::all();
        return view("admin.manageCategory", $data);
    }

    public function updateCategory(Request $req, $id)
    {
        if ($req->isMethod("post")) {
            $data = $req->validate(['cat_title' => 'required']);


            Category::findorFail($id)->update($data);

            return redirect()->route("admin.category")->with("success", "Category updated successfully");
        }


        $data['categories'] = Category::all();
        return view("admin.manageCategory", $data);
    }



    public function deleteCategory(Request $req)
    {
        $id = $req->id;
        $recoard = Category::findorFail($id);

        $recoard->delete();

        return redirect()->back()->with("error", "Category deleted successfully");
    }
}
