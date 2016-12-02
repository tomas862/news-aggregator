<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Models\CategoryModel;
use Config;
use Session;
use Route;


class CategoryController extends Controller
{
    /** renders admin category CRUD view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $categoryModel = new CategoryModel();
        $categories = $categoryModel::paginate(Config::get('constants.PAGE_COUNT'));

        return view('admin/adminCategoryCrud', [
            'categories' => $categories,
            'is_category' => $categoryModel->exists()
        ]);
    }

    /** renders add category form view
     * @param int $id_category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addCategoryView($id_category = 0)
    {
        $categoryModel = CategoryModel::find($id_category);
        return view(
            'admin/addFeedCategory',
            [
                'id_category' => $id_category,
                'category_name' => ($categoryModel)? $categoryModel->name: null
            ]
        );
    }

    /** validate form request
     * @param \Illuminate\Http\Request $request
     * @return Redirect
     */
    public function addFeedCategoryAction(\Illuminate\Http\Request $request)
    {
        $this->validate($request, [
            'category' => 'required|unique:category,name,:name|max:255',
        ]);

        return $this->addOrUpdate($request, (int)$request->id_category);
    }

    /** adds or updates category table
     * @param $request
     * @param int $id_category
     * @return Redirect
     */
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

    /** removes category from category table and from feed_category table
     * @return Redirect
     */
    public function removeCategoryAction()
    {
        $id_category = (int)Route::current()->getParameter('id');

        if (!$id_category) {
            return Redirect::back()->withErrors(['No data provided for remove process']);
        }

        $categoryModel = CategoryModel::find($id_category);

        if (!$categoryModel) {
            return Redirect::back()->withErrors(['Unable to find category']);
        }

        if (!$categoryModel->delete()) {
            return Redirect::back()->withErrors(['Failed to delete category']);
        }

        Session::flash('success_message', Config::get('constants.SUCCESS_DELETE'));
        return Redirect('categories');
    }
}

