<?php

namespace EVOS\Http\Controllers;

use EVOS\Category;
use Auth;

use EVOS\Http\Requests;
use EVOS\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['only' => ['index', 'create', 'store', 'update', 'destroy', 'edit']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Auth::user()->rootCategories();

        return view('categories.index')
            ->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $parent_id = intval($request->input('parent_id')) <= 0 ? null : intval($request->input('parent_id'));
        $parentCategory = Category::find($parent_id);

        return view('categories.create')
            ->with('parentCategory', $parentCategory)
            ->with('parent_id', $parent_id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $request['user_id'] = Auth::id();

        if (empty($request['parent_id'])) {
            $request['parent_id'] = null;
            $category = Category::create($request->all());

            return redirect(action('CategoryController@show', $category->id))
                ->with('message', 'Kategorie wurde angelegt!');
        }

        $parent = Category::findOrFail($request['parent_id']);
        $category = Category::create($request->all());
        $category->makeChildOf($parent);

        return redirect(action('CategoryController@show', $category->id))
            ->with('message', 'Kategorie wurde angelegt!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $categories)
    {
        if ($categories->user->id != Auth::user()->id) {
            return redirect(action('CategoryController@index'))
                ->withErrors(['Zugriff auf die Seite verweigert. Du hast nicht die Rechte diese Seite zu sehen!']);
        }

        Session::put('category_id', $categories->id);

        return view('categories.show')
            ->with('category', $categories);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Category $categories
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $categories)
    {
        return view('categories.edit')
            ->with('category', $categories)
            ->with('parent_id', $categories->parent_id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $categories)
    {
        $categories->fill($request->all());

        if (empty($categories->parent_id))
            $categories->parent_id = null;

        $categories->save();

        return redirect('categories')
            ->with('message', 'Kategorie wurde geändert!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Category $categories
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $categories)
    {
        $redirectTarget = $categories->parent == null ? action('CategoryController@index') : action('CategoryController@show', $categories->parent->id);
        $categories->delete();

        return redirect($redirectTarget)
            ->with('message', 'Kategorie wurde gelöscht!');
    }

    /**
     *
     *
     * @return $this
     */
    public function getMove()
    {
        $rootCategories = Auth::user()->rootCategories();
        $text = '<ul>';

        foreach ($rootCategories as $child)
            $text .= Auth::user()->renderNode($child);

        $text .= '</ul>';

        return view('categories.move')
            ->with('recursiveCategories', $text);
    }

    /**
     *
     *
     * @param Request $request
     * @param Category $categories
     */
    public function postMove(Request $request, Category $categories)
    {

        $currentID = $request['currentID'];
        $parentID = $request['parentID'];

        $currentCategory = Category::findOrFail($currentID);

        if ($parentID == 0) {
            $currentCategory->makeRoot();
            return;
        }


        $parentCategory = Category::findOrFail($parentID);

        $currentCategory->makeChildOf($parentCategory);
    }
}
