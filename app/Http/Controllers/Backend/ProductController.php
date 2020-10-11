<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\ProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.products.index', [
            'products' => Product::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create', [
            'categories' => Category::with('childrenRecursive')->whereParent_id('0')->get(),
            'brands'     => Brand::Pluck('title', 'id')
        ]);
    }

    public function store(ProductRequest $request)
    {

        $newProduct = Product::create($request->merge(['user_id' => Auth::id()])
            ->only('title', 'status', 'meta_title', 'slug', 'description', 'meta_desc',
                'meta_keywords', 'price', 'discount_price', 'brand_id', 'sku', 'user_id'));

        $newProduct->categories()->attach($request->category);
        $newProduct->attributeValues()->attach($request->attributeValues);

        if ($request->photosId) {
            $newProduct->medias()->attach(explode(',', $request->photosId));
        }

        Session::flash('product', 'The "' . $newProduct->title . '" product created successfully');
        Session::flash('toastr', 'success');
        return redirect(route('products.index'));

    }


}
