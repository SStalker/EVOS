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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Session::has('quiz_id') && Session::has('category_id'))
        {
            $quiz_id = Session::get('quiz_id');
            $category_id = Session::get('category_id');
        }
        else
        {
            abort(403,'Unauthorized action.');
        }

        $quiz = Quiz::findOrFail($quiz_id);
        $category = Category::findOrFail($category_id);

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
    public function show($id)
    {
        $question = Question::findOrFail($id);
        Session::put('quiz_id', $id);

        return view('questions.show')
            ->with('question', $question);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = Question::findOrFail($id);

        return view('questions.edit')
            ->with('question', $question);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \EVOS\Http\Requests\QuestionRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionRequest $request, $id)
    {
        $question = Question::findOrFail($id);
        $question->fill($request->all());
        $question->save();

        return redirect('/questions/'.$question->id)
            ->with('message', 'Frage wurde geändert!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question = Question::findOrFail($id);
        $question->delete();

        return redirect('quizzes/'. $question->quiz->id)
            ->with('message', 'Frage wurde gelöscht!');

    }
}
