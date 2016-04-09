<?php

namespace EVOS\Http\Controllers;

use EVOS\Quiz;
use EVOS\Category;
use EVOS\Http\Requests\QuizRequest;

use EVOS\Http\Requests;
use Illuminate\Support\Facades\Session;

class QuizController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Category $categories)
    {
        return view('quizzes.create')
            ->with('category', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \EVOS\Http\Requests\QuizRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Category $categories, QuizRequest $request)
    {
        $request['category_id'] = $categories->id;
        $quiz = Quiz::create($request->all());

        return redirect('categories/'.$categories->id.'/quizzes/'.$quiz->id)
            ->with('message', 'Quiz wurde angelegt!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $categories, Quiz $quizzes)
    {
        return view('quizzes.show')
            ->with('quiz', $quizzes);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $categories, Quiz $quizzes)
    {
        return view('quizzes.edit')
            ->with('quiz', $quizzes);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \EVOS\Http\Requests\QuizRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuizRequest $request, $id)
    {
        $quiz = Quiz::findOrFail($id);
        $quiz->fill($request->all());
        $quiz->save();

        return redirect('/quizzes/'.$quiz->id)
            ->with('message', 'Quiz wurde geändert!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $quiz = Quiz::findOrFail($id);
        $quiz->delete();

        return redirect('categories/'. $quiz->category->id)
            ->with('message', 'Quiz wurde gelöscht!');
    }
}
