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
    public function create(Quiz $quizzes)
    {
        return view('questions.create')
            ->with('quiz', $quizzes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \EVOS\Http\Requests\QuestionRequest  $request    Injected object built on the request.
     * @return \Illuminate\Http\Response
     */
    public function store(Quiz $quizzes, QuestionRequest $request)
    {
        $toggles = [
            'a' => $request->get('answerAbool') != null ? true : false,
            'b' => $request->get('answerBbool') != null ? true : false,
            'c' => $request->get('answerCbool') != null ? true : false,
            'd' => $request->get('answerDbool') != null ? true : false
        ];

        $request['correct_answers'] = json_encode($toggles);
        $request['quiz_id'] = $quizzes->id;

        // Ugly way to create an int
        $request->all()['countdown'] = intval($request->get('countdown'));

        $question = Question::create($request->all());

        return redirect('quizzes/'.$quizzes->id.'/questions/'.$question->id)
            ->with('message', 'Frage wurde angelegt!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \EVOS\Quiz $quizzes
     * @param  \EVOS\Question $questions
     * @return \Illuminate\Http\Response
     */
    public function show(Quiz $quizzes, Question $questions)
    {
        $answers = json_decode($questions->correct_answers);
        $questions->setAttribute('answerABool', $answers->a);
        $questions->setAttribute('answerBBool', $answers->b);
        $questions->setAttribute('answerCBool', $answers->c);
        $questions->setAttribute('answerDBool', $answers->d);

        return view('questions.show')
            ->with('question', $questions);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \EVOS\Quiz $quizzes
     * @param  \EVOS\Question $questions
     * @return \Illuminate\Http\Response
     */
    public function edit(Quiz $quizzes, Question $questions)
    {
        $answers = json_decode($questions->correct_answers);
        $questions->setAttribute('answerABool', $answers->a);
        $questions->setAttribute('answerBBool', $answers->b);
        $questions->setAttribute('answerCBool', $answers->c);
        $questions->setAttribute('answerDBool', $answers->d);

        return view('questions.edit')
            ->with('question', $questions);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \EVOS\Http\Requests\QuestionRequest  $request
     * @param  \EVOS\Quiz $quizzes
     * @param  Question $questions
     *
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionRequest $request, Quiz $quizzes, Question $questions)
    {
        $toggles = [
            'a' => $request->get('answerAbool') != null ? true : false,
            'b' => $request->get('answerBbool') != null ? true : false,
            'c' => $request->get('answerCbool') != null ? true : false,
            'd' => $request->get('answerDbool') != null ? true : false
        ];

        $request['correct_answers'] = json_encode($toggles);
        $request['quiz_id'] = $quizzes->id;

        // Ugly way to create an int
        $request->all()['countdown'] = (int)$request->get('countdown');

        $questions->update($request->all());

        return redirect('quizzes/'.$quizzes->id.'/questions/'.$questions->id)
            ->with('message', 'Frage wurde geändert!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \EVOS\Quiz
     * @param  \EVOS\Question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quiz $quizzes, Question $questions)
    {
        $questions->delete();

        return redirect('categories/'.$quizzes->category->id.'/quizzes/'. $quizzes->id)
            ->with('message', 'Frage wurde gelöscht!');

    }

}
