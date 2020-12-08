<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\AttributeGroup;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    protected $paginate_per_page = 10;
    protected $category;

    /**
     * Display a listing of the categories.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->handlePerPage($request->input('PerPage'));

        return view('admin.categories.index', [
            'categories' => Category::with('childrenRecursive')->whereParent_id(0)->paginate($this->paginate_per_page),
        ]);
    }

    /**
     * Show the form for creating a new category.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create', [
            'categories' => Category::with('childrenRecursive')->whereParent_id('0')->get(),
        ]);
    }

    /**
     * Store a newly created category in storage.
     *
     * @param CategoryRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        Category::create($this->handleInputs($request));

        return redirect(route('categories.index'))->with([
            'category' => 'The "' . $request->name . '" category created successfully',
            'toastr'   => 'success'
        ]);
    }

    /**
     * Show the form for editing the selected category.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.categories.edit', [
            'category'   => Category::findOrFail($id),
            'categories' => Category::with('childrenRecursive')->whereParent_id('0')->get(),
        ]);
    }

    /**
     * Update the specified category in storage.
     *
     * @param CategoryRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $this->category = Category::findorfail($id);
        $this->category->update($this->handleInputs($request));

        //redirect to the correct page number
        return redirect($request->redirects_to)->with([
            'category' => 'The "' . $request->name . '" category updated successfully',
            'toastr'   => 'info'
        ]);
    }

    /**
     * Remove the specified category from storage.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $this->category = Category::with('childrenRecursive')->whereId($id)->firstOrFail();
        if (count($this->category->childrenRecursive) > 0) {
            return back()->with([
                'category' => 'The "' . $this->category->name . '" category has subcategories so it can not be deleted',
                'toastr'   => 'warning'
            ]);
        }
        $this->deleteMedia('icon');
        $this->deleteMedia('image');
        $this->category->delete();
        Session::flash('category', 'The "' . $this->category->name . '" category deleted successfully');
        Session::flash('toastr', 'error');

        // solving the problem that causes return to the empty page after deleting
        $lastPage = Category::where('parent_id', '0')->paginate(session('PerPageCategory'))->lastPage(); // Get last page with results.

        if ($request->currentPage > $lastPage) {
            return redirect(url('administrator/categories') . '?page=' . $lastPage);    // Manually build true last page URL.
        } else {
            return back();
        }
    }

    /**
     * Show the form for editing the attribute group of the selected category.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function indexSetting($id)
    {
        return view('admin.categories.index-setting', [
            'category'        => Category::findOrFail($id),
            'attributeGroups' => AttributeGroup::all(),
        ]);
    }

    /**
     * Store the specified attribute group for the selected category in storage.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function saveSetting(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->attributeGroups()->sync($request->attributeGroups);

        //return to the correct page number
        return redirect($request->redirects_to)->with([
            'category' => 'attributes for The "' . $category->name . '" category updated successfully',
            'toastr'   => 'warning'
        ]);
    }

    /**
     * Return an array of needed inputs and store the medias .
     *
     * @param CategoryRequest $request
     * @return array
     */
    protected function handleInputs(CategoryRequest $request): array
    {
        return array_merge(
            $request->only('name', 'meta_title', 'slug', 'meta_desc', 'meta_keywords', 'parent_id'), [
            'icon'  => $this->storeMedias($request->file('icon'), 'icon'),
            'image' => $this->storeMedias($request->file('image')),
        ]);
    }

    /**
     * Store medias in storage .
     *
     * @param $file
     * @param string $type
     * @return string|null
     */
    protected function storeMedias($file, $type = 'image'): ?string
    {
        if ($file) {
            $this->deleteMedia($type);
            $filename = Str::random(40) . $file->getClientOriginalName();
            $file->storeAs('public/categories', $filename);
            $this->resizeImg($filename, $type);
            return $filename;
        }
        return ($this->category ? $this->category->getAttribute($type) : null);
    }

    /**
     * Delete the old image from storage.
     *
     * @param string $type
     */
    protected function deleteMedia(string $type): void
    {
        if (($this->category ? $this->category->getAttribute($type) : false)) {
            if (file_exists(storage_path('app/public/categories/' . $this->category->getAttribute($type)))) {
                unlink(storage_path('app/public/categories/' . $this->category->getAttribute($type)));
            }
        }
    }

    /**
     * Resize and fit the uploaded image .
     *
     * @param $filename
     * @param $type
     */
    protected function resizeImg($filename, $type): void
    {
        $path = storage_path('app/public/categories/' . $filename);
        if ($type === 'icon') {
            Image::make($path)->fit(200, 200)->save($path);
        } else {
            Image::make($path)->fit(1920, 310)->save($path);
        }
    }

    /**
     * Handle the show per page number for pagination.
     *
     * @param $perPage
     */
    protected function handlePerPage($perPage): void
    {
        if ($perPage) {                                               //get show per page options if exist
            $this->paginate_per_page = $perPage;
            session(['PerPageCategory' => $perPage]);
        } elseif ($perPage = session('PerPageCategory')) {        //get show per page options from session
            $this->paginate_per_page = $perPage;
        } else {
            session(['PerPageCategory' => $this->paginate_per_page]);
        }
    }

}
