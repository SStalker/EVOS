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
        $this->middleware('auth', ['only' => ['start', 'next', 'create', 'store', 'update', 'destroy', 'edit']]);
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
     * @param  \EVOS\Http\Requests\QuizRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(Category $categories, QuizRequest $request)
    {
        $request['category_id'] = $categories->id;
        $quiz = Quiz::create($request->all());

        return redirect('categories/' . $categories->id . '/quizzes/' . $quiz->id)
            ->with('message', 'Quiz wurde angelegt!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
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
     * @param  int $id
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
     * @param  \EVOS\Http\Requests\QuizRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuizRequest $request, Category $categories, Quiz $quizzes)
    {
        $request['category_id'] = $categories->id;
        $quizzes->update($request->all());

        return redirect('categories/' . $categories->id . '/quizzes/' . $quizzes->id)
            ->with('message', 'Quiz wurde geändert!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $categories, Quiz $quizzes)
    {
        $quizzes->delete();

        return redirect('categories/' . $quizzes->category->id)
            ->with('message', 'Quiz wurde gelöscht!');
    }

    /**
     * Starts a new quiz.
     *
     * @param Category $categories
     * @param Quiz $quizzes
     */
    public function start(Category $categories, Quiz $quizzes)
    {
        // If collection is empty redirect with error
        $questions = $quizzes->questions;

        // If no questions then redirect with error
        if ($questions->isEmpty()) {
            return redirect('categories/' . $categories->id . '/quizzes/' . $quizzes->id)
                ->withErrors(['Quiz hat keine Fragen']);
        }


        // Now we can start the quiz
        $quizzes->isActive = true;
        $quizzes->questionsCounter = 0;
        $quizzes->save();

        return view('questions.start')
            ->with('quiz', $quizzes);
    }

    /**
     * Returns the next question of the quiz as JSON.
     *
     * @param  int $id
     * @return The next question or first (Starts the quiz)
     */
    public function next(Category $categories, Quiz $quizzes)
    {
        if ($quizzes->isActive) {
            $quizzes->questionsCounter++;
            $quizzes->save();
        } else {
            return request()->ajax() ?
                request()->json(['error' => '1']) : // 1 = not active
                redirect('categories/' . $categories->id . '/quizzes/' . $quizzes->id)
                    ->withErrors(['Quiz wurde nicht getstartet']);
        }

        // If counter is greater than array size then quiz ends
        if ($quizzes->questionsCounter > $quizzes->questions->count()) {
            // Set the quiz as active
            $quizzes->isActive = false;
            $quizzes->questionsCounter = 0;
            $quizzes->save();

            //TODO Show end results
            return request()->ajax() ?
                request()->json(['error' => 'quiz has ended']) :
                redirect('categories/' . $categories->id . '/quizzes/' . $quizzes->id)
                    ->withErrors(['Quiz ist zu Ende']);
        }

        $quiz = $quizzes->questions->get($quizzes->questionsCounter - 1);
        $quiz["last"] = $quizzes->questionsCounter == $quizzes->questions->count();

        return $quiz;
    }

    /**
     * @param int $id
     * @return json The answers for the current question
     */
    public function choices(Category $categories, Quiz $quizzes)
    {

        $questions = $quizzes->questions;
        $questionsCounter = $quizzes->questionsCounter;

        //$question = $questions->get($questionsCounter);
        //$question['correct_answers'] = null;


        $countdown = $questions->get($questionsCounter)['countdown'];
        $question = [ 'countdown' => $countdown ];

        return $question;
    }
}
