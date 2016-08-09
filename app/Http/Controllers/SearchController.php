<?php

namespace EVOS\Http\Controllers;

use Request;
use Auth;
use EVOS\Quiz;
use EVOS\Question;
use EVOS\Http\Requests;

class SearchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Gets all the categories and relating quizzes/questions by user.
     *
     * @return $this    The created view.
     */
    public function getSearch()
    {
        $searchFor = trim(Request::input('searchtext'));
        if (empty($searchFor)) {
            return view('search.result')
                ->withErrors(['Der Suchtext darf nicht leer sein!']);
        }

        $input = '%' . $searchFor . '%';

        // Get all categories created by user
        $categoriesResult = Auth::user()->categories()->where('title', 'LIKE', $input)->getModels();
        $categories_ids = Auth::user()->categories()->lists('id');

        // Get all quizzes related by id from categories
        $quizzesResult = Quiz::whereIn('category_id', $categories_ids)->where('title', 'LIKE', $input)->getModels();
        $quizzes_ids = Quiz::whereIn('category_id', $categories_ids)->lists('id');

        // Get all questions related by id from quizzes
        $questionsResult = Question::whereIn('quiz_id', $quizzes_ids)->where('question', 'LIKE', $input)->getModels();

        return view('search.result')
            ->with('input', $searchFor)
            ->with('categories', $categoriesResult)
            ->with('quizzes', $quizzesResult)
            ->with('questions', $questionsResult);
    }
}
