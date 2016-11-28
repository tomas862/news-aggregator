<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\CategoryModel;
use Config;
use Session;
use Route;


class CategoryController extends Controller
{
    public function index()
    {
        $categoryModel = new CategoryModel();
        $categories = $categoryModel::all();

        return view('admin/adminCategoryCrud', [
            'categories' => $categories,
            'is_category' => $categoryModel->exists()
        ]);
    }

    public function addFeedCategoryAction(\Illuminate\Http\Request $request)
    {
        $this->validate($request, [
            'category' => 'required|unique:category,name,:name|max:255',
        ]);

        return $this->addOrUpdate($request, (int)$request->id_category);
    }

    public function addOrUpdate($request, $id_category = 0)
    {
        if (!$id_category) {
            $categoryModel = new CategoryModel();
            $categoryModel->name = $request->category;

            if (!$categoryModel->save()) {
                return Redirect::back()->withErrors(['Failed to store data to database']);
            }
        } elseif ($id_category) {
            $categoryModel = CategoryModel::find($id_category);
            $categoryModel->name = $request->category;
            if (!$categoryModel->update()) {
                return Redirect::back()->withErrors(['Failed to update data to database']);
            }
        }

        Session::flash('success_message', Config::get('constants.SUCCESS_MESSAGE'));

        if ($request->has('submit_and_stay_category')) {
            $url = 'addCategory';
            $url .= ($id_category) ? '/'.$id_category : '';
            
            return Redirect($url);
        }

        return Redirect('categories');
    }
}

