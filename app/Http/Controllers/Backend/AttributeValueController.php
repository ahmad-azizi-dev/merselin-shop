<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\AttributeValueRequest;
use App\Models\AttributeGroup;
use App\Models\AttributeValue;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class AttributeValueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attributesValue = AttributeValue::with('attributeGroup')->get();
        return view('admin.attributes-value.index', ['attributesValue' => $attributesValue]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $attributesGroup = AttributeGroup::pluck('title', 'id');

        return view('admin.attributes-value.create', ['attributesGroup' => $attributesGroup]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(AttributeValueRequest $request)
    {
        $newValue = new AttributeValue();
        $newValue->title = $request->input('title');
        $newValue->attributeGroup_id = $request->input('attributeGroup_id');
        $newValue->save();

        Session::flash('attributeValue', 'The "' . $newValue->title . '" attribute value created successfully');
        Session::flash('toastr', 'success');
        return redirect(route('attributes-value.index'));

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
        $attributeValue = AttributeValue::with('attributeGroup')->whereId($id)->first();
        $attributesGroup = AttributeGroup::pluck('title', 'id');

        return view('admin.attributes-value.edit', ['attributeValue' => $attributeValue, 'attributesGroup' => $attributesGroup]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(AttributeValueRequest $request, $id)
    {
        $updatedValue = AttributeValue::findOrFail($id);
        $updatedValue->title = $request->input('title');
        $updatedValue->attributeGroup_id = $request->input('attributeGroup_id');
        $updatedValue->save();

        Session::flash('attributeValue', 'The "' . $updatedValue->title . '" attribute value updated successfully');
        Session::flash('toastr', 'info');
        return redirect(route('attributes-value.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $attributeValue = AttributeValue::findOrFail($id);
        $attributeValue->delete();

        Session::flash('attributeValue', 'The "' . $attributeValue->title . '" attribute value deleted successfully');
        Session::flash('toastr', 'error');

        return redirect(route('attributes-value.index'));
    }
}
