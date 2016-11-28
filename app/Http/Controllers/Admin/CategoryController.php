<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\CategoryModel;
use Config;
use Session;


class CategoryController extends Controller
{
    public function index()
    {
        return view('admin/adminCategoryCrud');
    }

    public function addFeedCategoryAction(\Illuminate\Http\Request $request)
    {
        $this->validate($request, [
            'category' => 'required|unique:category,name,:name|max:255',
        ]);

        $categoryModel = new CategoryModel();
        $categoryModel->name = $request->category;

        if (!$categoryModel->save()) {
            return Redirect::back()->withErrors(['Failed to store data to database']);
        }

        Session::flash('success_message', Config::get('constants.SUCCESS_MESSAGE'));

        if ($request->has('submit_and_stay_category')) {
            return redirect()->back();
        }

        if ($request->has('submit_category')) {
            return redirect('categories');
        }

        return redirect('categories');
    }
}

