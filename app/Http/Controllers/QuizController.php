<?php

namespace EVOS\Http\Controllers;

use EVOS\Question;
use EVOS\Quiz;
use EVOS\Category;
use EVOS\Http\Requests\QuizRequest;

use EVOS\Http\Requests;
use Illuminate\Support\Facades\Session;

class QuizController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['only' => ['next','create', 'store', 'update', 'destroy', 'edit']]);
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
        if(Session::has('category_id'))
        {
            $category_id = Session::get('category_id');
        }
        else
        {
            abort(403,'Unauthorized action.');
        }
        $category = Category::findOrFail($category_id);

        return view('quizzes.create')->with('category', $category);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \EVOS\Http\Requests\QuizRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuizRequest $request)
    {
        $quiz = Quiz::create($request->all());

        return redirect('/quizzes/'.$quiz->id)
            ->with('message', 'Quiz wurde angelegt!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $quiz = Quiz::findOrFail($id);
        Session::put('quiz_id', $id);

        return view('quizzes.show')->with('quiz', $quiz);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $quiz = Quiz::findOrFail($id);

        return view('quizzes.edit')
            ->with('quiz', $quiz);
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

    /**
     * @param  int $id
     * @return The next question or first (Starts the quiz)
     */
    public function next(Quiz $quiz)
    {
        // If collection is empty redirect with error
        $questions = $quiz->questions;
        $questionsCounter = $quiz->questionsCounter;

        // If no questions then redirect with error
        if($questions->isEmpty())
        {
            return redirect('quizzes/'. $quiz->id)
                ->withErrors(['Quiz hat keine Fragen']);
        }

        // If counter is greater than array size then quiz ends
        if($quiz->questionsCounter >= $questions->count()-1)
        {
            // Set the quiz as active
            $quiz->isActive = false;
            $quiz->questionsCounter = 0;
            $quiz->save();

            //TODO Show end results
            return redirect('quizzes/'. $quiz->id)
                ->withErrors(['Quiz ist zu Ende']);
        }

        if($quiz->isActive)
        {
            // Increase question counter
            $quiz->questionsCounter = ++$questionsCounter;
            $quiz->save();
        }
        else
        {
            // Set the quiz as active
            $quiz->isActive = true;
            $quiz->save();
        }

        $question = $questions->get($questionsCounter);

        return view('questions.showQuestion')
                ->with('question', $question);
    }

    /**
     * @param int $id
     * @return json The answers for the current question
     */
    public function choices(Quiz $quiz)
    {
        $questions = $quiz->questions;
        $questionsCounter = $quiz->questionsCounter;
        $question = $questions->get($questionsCounter);

        return $question;
    }
}
