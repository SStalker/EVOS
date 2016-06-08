<?php

namespace EVOS\Http\Controllers;

use Auth;
use EVOS\Category;
use EVOS\Quiz;
use EVOS\Share;
use Illuminate\Http\Request;

/*
use EVOS\Http\Requests;
*/

class ShareController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shares = Auth::user()->shares;
        return view('shares.index')
            ->with('shares', $shares);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect('/')
            ->withErrors(['Die Seite sollte nicht direkt aufgerufen werden.']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $quiz = Quiz::findOrFail($request->get('quiz_id'));
        $duplicateQuiz = $quiz->replicate();

        // replicate() only creates a flat copy, so we need to replicate the
        // corresponding questions as well.
        $duplicatedQuestions = [];
        foreach($quiz->questions as $question) {
            array_push($duplicatedQuestions, $question->replicate());
        }
        $duplicateQuiz->save();
        $duplicateQuiz->questions()->saveMany($duplicatedQuestions);

        $share = new Share;
        $share->quiz()->associate($duplicateQuiz);
        $share->user()->associate($user);
        $share->save();

        return redirect(action('ShareController@show', $share->id))
            ->with('message', 'Freigabe wurde erstellt!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Share $share)
    {
        return view('shares.show')
            ->with('share', $share);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return redirect('/')
            ->withErrors(['Die Seite sollte nicht direkt aufgerufen werden.']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return redirect('/')
            ->withErrors(['Die Seite sollte nicht direkt aufgerufen werden.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Share $share)
    {
        $user = Auth::user();
        $category = Category::where('user_id', '=', $user->id)
            ->where('title', '=', 'Freigabe')->get()->first();

        if($category == null) {
            $category = new Category;
            $category->title = "Freigabe";
            $category->user()->associate($user);
            $category->save();
        }

        $quiz = $share->quiz;
        $quiz->category()->associate($category);
        $quiz->save();

        $share->delete();

        return redirect(action('CategoryController@show', $category->id))
            ->with('message', 'Quiz wurde zu Ihrer Sammlung hinzugefügt!');
    }
}
