<?php

namespace EVOS\Http\Controllers;

use Illuminate\Http\Request;
use EVOS\Quiz;
use EVOS\Http\Requests\AttendeeRequest;

class AttendeeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'getQuiz', 'enterName', 'create', 'store', 'update', 'destroy', 'edit']]);
    }
    
    public function index() {
        return view('frontend.entrypoint');
    }

    public function store(Request $request) {

        return 'waiting';

    }

    public function getQuiz($pin) {

        $theQuiz = Quiz::find($pin);
        //dd($keks);
        if ($theQuiz != null) {
            return "quiz_exists";
        } else {
            return "wrongpin";
        }
    }
}
