<?php

namespace App\Http\Controllers\Frontend;

use App\Facades\Cart;
use App\Models\Category;
use App\Http\Controllers\Controller;

class FrontendCategoryController extends Controller
{
    /**
     * Show the category.
     *
     * @param Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('frontend.category.index', [
            'thisCategory' => $category,
            'categories'   => Category::whereParent_id($category->id)->get(),
            'cartProducts' => Cart::get()['products'],
        ]);
    }

}
