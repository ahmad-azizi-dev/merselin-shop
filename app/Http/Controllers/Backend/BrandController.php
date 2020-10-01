<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::with('media')->get();

        return view('admin.brands.index', compact(['brands']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandRequest $request)
    {

        $brand = new Brand();
        $brand->title = $request->input('title');
        $brand->description = $request->input('description');
        $brand->media_id = $request->input('media_id');
        $brand->save();

        Session::flash('brand', 'The "' . $brand->title . '" brand created successfully');
        Session::flash('toastr', 'success');
        return redirect(route('brands.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand = Brand::with('media')->whereId($id)->first();

        return view('admin.brands.edit', compact(['brand']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(BrandRequest $request, $id)
    {
        $brand = Brand::findOrFail($id);
        $brand->title = $request->input('title');
        $brand->description = $request->input('description');
        $brand->media_id = $request->input('media_id');
        $brand->save();

        Session::flash('brand', 'The "' . $brand->title . '" brand edited successfully');
        Session::flash('toastr', 'info');
        return redirect(route('brands.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();

        Session::flash('brand', 'The "' . $brand->title . '" brand deleted successfully');
        Session::flash('toastr', 'error');
        return redirect(route('brands.index'));
    }
}
