<?php

namespace EVOS\Http\Controllers;

use EVOS\Attendee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use EVOS\Quiz;
use EVOS\Http\Requests\AttendeeRequest;

class AttendeeController extends Controller
{

    public function __construct() {
        $this->middleware('auth', ['except' => ['index', 'getQuiz', 'enterName', 'create', 'store', 'update', 'destroy', 'edit', 'errorPage' ]]);
    }

    /**
     * Returns the Page to the Session. Its the starting point of our student front end.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        return view('frontend.entrypoint');
    }

    /**
     * Store the Attendee and send a "waiting" response if everything went as expected.
     *
     * @param AttendeeRequest $request
     * @return string
     */
    public function store(AttendeeRequest $request) {
        $request['session_token'] = Session::getId();
        $request['name'] = 'Anonymer Alf';
        $justCreated = Attendee::create($request->all());
        if ($justCreated == null) {
            return 'error';
        } else {
            return 'waiting';
        }
    }

    /**
     * Returns the corresponding pin if the quiz is flagged active.
     *
     * @param Quiz $pin
     * @return Quiz|string
     */
    public function getQuiz(Quiz $pin) {
        if ($pin != null) {
            if ($pin->isActive) {
                return $pin;
            } else {
                return 'quiz_not_active';
            }
        } else {
            return 'wrongpin';
        }
    }

    /**
     * Shows an error Page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function errorPage(){
        return view('errors.errorPage');
    }
}
