<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Article;

class CategoryController extends Controller
{
    private function addCategory($input) {
        if (!Category::find($input['new-category-name'])) {
            Category::create(['name' => $input['new-category-name']]);
        }
    }

    private function deleteCategory($input) {
        $categoryToDelete = Category::find($input['category-to-delete']);

        if ($categoryToDelete) {

            //Un-assign the category from any articles that use it.
            Article::where('category_name', '=',$categoryToDelete->name)->update(['category_name' => Category::UNASSIGNED]);

            //Then delete the Category
            $categoryToDelete->delete();
        }
    }

    public function update(Request $request) {
        $input =$request->input();

        switch($input['action']) {
            case 'add':
                $this->addCategory($input);
                break;
            case 'delete':
                $this->deleteCategory($input);
                break;
        }

        $data = [
            'allCategories' => Category::all(),
            'mode' => 'categories',
        ];

        return view('admin', $data);
    }
}
