<?php

namespace EVOS\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use EVOS\User;
use EVOS\Http\Requests;
use EVOS\Http\Requests\UserRequest;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(30);
        return view('users.index')
            ->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $request['isAdmin'] = $request->has('isAdmin');
        $user = User::create($request->all());
        return redirect(action('UserController@index'))
            ->with('message', 'Benutzer ' . $user->name . ' wurde angelegt');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $users)
    {
        return view('users.edit')
            ->with('user', $users);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $users)
    {
        $request['isAdmin'] = $request->has('isAdmin');
        $users->update($request->all());
        return redirect(action('UserController@index'))
            ->with('message', 'Benutzerdaten wurden gespeichert!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $users)
    {
        if (Auth::user()->id === $users->id) {
            return redirect(action('UserController@index'))
                ->withErrors('Das eigene Benutzerkonto kann nicht gelöscht werden!');
        }

        $users->delete();
        return redirect(action('UserController@index'))
            ->with('message', 'Der Benutzer wurde gelöscht!');
    }
}
