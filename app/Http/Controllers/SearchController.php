<?php

namespace EVOS\Http\Controllers;

use Request;
use Auth;
use EVOS\Http\Requests;

class SearchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getSearch()
    {
        $searchFor = Request::input('searchtext');
        $input = '%'.$searchFor.'%';

        $categoriesResult = Auth::user()->categories()->where('title', 'LIKE', $input)->getModels();
        $quizzesResult = array();
        $questionsResult = array();

        foreach ($categoriesResult as $category)
        {
            $quizzes = $category->quizzes();

            $quizzesResult = array_merge($quizzesResult , $quizzes->where('title', 'LIKE', $input)->getModels());

            foreach ($quizzesResult as $quiz)
            {
                $questionsResult = array_merge($questionsResult, $quiz->questions()->where('question', 'LIKE', $input)->getModels());
            }
        }

        return view('search.result')
            ->with('input', $searchFor)
            ->with('categories', $categoriesResult)
            ->with('quizzes', $quizzesResult)
            ->with('questions', $questionsResult);
    }
}
