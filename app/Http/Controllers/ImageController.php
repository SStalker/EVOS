<?php

namespace EVOS\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use EVOS\Image;
use EVOS\Http\Requests;

class ImageController extends Controller
{
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!$request->hasFile('image')) {
            return "no file, image probably too big?";
        }

        if(!$request->file('image')->isValid()) {
            return "file is invalid";
        }

        $file = $request->file('image');
        $image = Image::create([
            'user_id' => Auth::user()->id,
            'original_filename' => $file->getClientOriginalName()
        ]);
        $newFilename = $image->id . '.' . $file->getClientOriginalExtension();

        $image->update([
            'filename' => $newFilename
        ]);

        $request->file('image')->move(public_path('storage/uploads'), $newFilename);
        return $newFilename;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
