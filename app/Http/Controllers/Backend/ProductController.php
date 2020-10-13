<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\ProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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

    /**
     * Store the specified resource in storage.
     *
     * @param ProductRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $newProduct = Product::create($this->getInputs($request));
        $newProduct->categories()->attach($request->category);
        $newProduct->attributeValues()->attach($request->attributeValues);

        if ($request->photosId) {
            $newProduct->medias()->attach(explode(',', $request->photosId));
        }

        return redirect(route('products.index'))->with([
            'product' => 'The "' . $newProduct->title . '" created successfully',
            'toastr'  => 'success'
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.products.edit', [
            'categories' => Category::with('childrenRecursive')->whereParent_id('0')->get(),
            'brands'     => Brand::Pluck('title', 'id'),
            'product'    => Product::with(['attributeValues', 'brand', 'categories', 'medias'])->whereId($id)->first()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductRequest $request
     * @param Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        $product->update($this->getInputs($request));
        $product->categories()->sync($request->category);
        $product->attributeValues()->sync($request->attributeValues);

        if ($request->photosId) {
            $product->medias()->sync(explode(',', $request->photosId));
        }

        return redirect(route('products.index'))->with([
            'product' => 'The "' . $product->title . '" updated successfully',
            'toastr'  => 'info'
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Product $product)
    {
        foreach ($product->medias()->get() as $photo) {   // try to delete the photos if was exist

            if (file_exists(storage_path('app/public/photos/' . $photo->path))) {
                unlink(storage_path('app/public/photos/' . $photo->path));
            }
            $photo->delete();
        }
        $product->delete();

        return redirect(route('products.index'))->with([
            'product' => 'The "' . $product->title . '" deleted successfully',
            'toastr'  => 'error'
        ]);
    }

    /**
     * return an array of needed input columns for the query builder .
     *
     * @param ProductRequest $request
     * @return array
     */
    private function getInputs($request)
    {
        return $request->merge(['user_id' => Auth::id()])
            ->only('title', 'status', 'meta_title', 'slug', 'description', 'meta_desc',
                'meta_keywords', 'price', 'discount_price', 'brand_id', 'sku', 'user_id');
    }
}
