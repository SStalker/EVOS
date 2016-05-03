<?php

namespace EVOS\Http\Controllers;

use EVOS\Attendee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
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

    public function store(AttendeeRequest $request) {
        
        $request['session_token'] = Session::getId();
        $justCreated = Attendee::create($request->all());
        if ($justCreated == null) {
            return 'error';
        } else {
            return 'waiting';
        }

    }

    public function getQuiz($pin) {

        $theQuiz = Quiz::find($pin);
        if ($theQuiz != null) {
            return 'quiz_exists';
        } else {
            return 'wrongpin';
        }
    }
}
