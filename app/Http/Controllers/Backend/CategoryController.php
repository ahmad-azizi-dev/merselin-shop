<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    private $paginate_per_page = 5;


    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($PerPageCategory = $request->input('PerPage')) {     //can get show per page options from a user that apply
            $this->paginate_per_page = $PerPageCategory;
            session(['PerPageCategory' => $PerPageCategory]);
        } elseif ($PerPageCategory = session('PerPageCategory')) {  //get show per page options from session
            $this->paginate_per_page = $PerPageCategory;
        } else {
            session(['PerPageCategory' => $this->paginate_per_page]);
        }

        $categories = Category::with('childrenRecursive')
            ->where('parent_id', '0')->paginate($this->paginate_per_page);


        return view('admin.categories.index', compact(['categories']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::with('childrenRecursive')
            ->where('parent_id', '0')->get();

        return view('admin.categories.create', compact(['categories']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $category = new Category();
        $category->name = $request->input('name');
        $category->meta_title = $request->input('meta_title');
        $category->slug = $request->input('slug');     // the input slug must be made before validation!!!
        $category->meta_desc = $request->input('meta_desc');
        $category->meta_keywords = $request->input('meta_keywords');
        $category->parent_id = $request->input('category_parent');
        $category->save();

        Session::flash('category', 'The "' . $category->name . '" category created successfully');
        Session::flash('toastr', 'success');
        return redirect(route('categories.index'));
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
        $category = Category::findorfail($id);

        $categories = Category::with('childrenRecursive')
            ->where('parent_id', '0')->get();

        return view('admin.categories.edit', compact(['categories', 'category']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $category = Category::findorfail($id);
        $category->name = $request->input('name');
        $category->meta_title = $request->input('meta_title');
        $category->slug = $request->input('slug');     // the input slug must be made before validation!!!
        $category->meta_desc = $request->input('meta_desc');
        $category->meta_keywords = $request->input('meta_keywords');

        //You can not choose its own and its children as parents, no problem! these IDs are restricted in edit view
        $category->parent_id = $request->input('category_parent');
        $category->save();

        Session::flash('category', 'The "' . $category->name . '" category updated successfully');
        Session::flash('toastr', 'info');

        $url = $request->only('redirects_to'); //return to the correct page number
        return redirect()->to($url['redirects_to']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Request $request, $id)
    {

        $category = Category::with('childrenRecursive')->where('id', $id)->first();
        if (count($category->childrenRecursive) > 0) {
            Session::flash('category', 'The "' . $category->name . '" category has subcategories so it can not be deleted');
            Session::flash('toastr', 'warning');
            return back();
        }


        if ($PerPage = session('PerPageCategory')) {     //get show per page options from session
            $this->paginate_per_page = $PerPage;
        }

        $category->delete();
        Session::flash('category', 'The "' . $category->name . '" category deleted successfully');
        Session::flash('toastr', 'error');

        // this codes is for solving the problem that causes return to the empty page after deleting
        $lastPage = Category::with('childrenRecursive')
            ->where('parent_id', '0')->paginate($this->paginate_per_page)->lastPage(); // Get last page with results.

        if ($request->currentpage > $lastPage) {
            $lastPage_url = url('administrator/categories') . '?page=' . $lastPage; // Manually build true last page URL.
            return redirect($lastPage_url);
        } else {
            return back();
        }

    }
}
