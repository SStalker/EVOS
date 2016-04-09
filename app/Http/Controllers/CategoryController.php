<?php

namespace EVOS\Http\Controllers;

use EVOS\Category;
use Auth;

use EVOS\Http\Requests;
use EVOS\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Session;


class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['only' => ['create', 'store', 'update', 'destroy', 'edit']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Auth::user()->categories;

        return view('categories.index')
            ->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $request['user_id'] = Auth::id();

        $category = Category::create($request->all());

        return redirect('/categories/'.$category->id)
            ->with('message', 'Kategorie wurde angelegt!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $categories)
    {
        Session::put('category_id', $categories->id);

        return view('categories.show')
            ->with('category', $categories);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $categories)
    {
        return view('categories.edit')
            ->with('category', $categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $categories)
    {
        $categories->fill($request->all());
        $categories->save();

        return redirect('categories')
            ->with('message', 'Kategorie wurde geändert!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $categories)
    {
        $categories->delete();

        return redirect('categories')
            ->with('message', 'Kategorie wurde gelöscht!');
    }
}
