<?php

namespace EVOS\Http\Controllers;

use EVOS\Question;
use EVOS\Quiz;
use EVOS\Category;


use EVOS\Http\Requests\QuestionRequest;
use Illuminate\Support\Facades\Session;

class QuestionController extends Controller
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
        return redirect('categories');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Session::has('quiz_id') && !Session::has('category_id')) {
            return redirect('categories')
                ->withErrors(['Nicht autorisierter Zugriff!']);
        }

        $quiz = Quiz::findOrFail(Session::get('quiz_id'));
        $category = Category::findOrFail(Session::get('category_id'));

        return view('questions.create')
            ->with('quiz', $quiz)
            ->with('category', $category);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \EVOS\Http\Requests\QuestionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionRequest $request)
    {
        $question = Question::create($request->all());

        return redirect('/questions/'.$question->id)
            ->with('message', 'Frage wurde angelegt!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Question $questions)
    {
        Session::put('quiz_id', $questions->id);

        return view('questions.show')
            ->with('question', $questions);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $questions)
    {
        return view('questions.edit')
            ->with('question', $questions);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \EVOS\Http\Requests\QuestionRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionRequest $request, Question $questions)
    {
        $questions->update($request->all());

        return redirect('/questions/'.$questions->id)
            ->with('message', 'Frage wurde geändert!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $questions)
    {
        $questions->delete();

        return redirect('quizzes/'. $questions->quiz->id)
            ->with('message', 'Frage wurde gelöscht!');

    }
}
