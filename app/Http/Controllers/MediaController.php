<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Media;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Media::images()->paginate(10);
        $session_last_feature = false;
        $last_edited_study = null;
        $last_edited_course = null;
        
        if (Session::get('last_edited_study_id'))
        {
            $session_last_feature = true;
            $last_edited_study = Study::find(Session::get('last_edited_study_id'));
        }
        
        if (Session::get('last_edited_course_id'))
        {
            $session_last_feature = true;
            $last_edited_course = Course::find(Session::get('last_edited_course_id'));
        }
        
        return view('photos.index',compact('images','session_last_feature','last_edited_study','last_edited_course'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        if (strpos($request->getUri(), "images")){
            return $this->showImage($request, $id);
        }else{
            dd($id);
        }
    }

    public function showImage(Request $request, $id)
    {
        return (new \App\Helpers\Image($request,$id))->show();
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

    public function copyImageToSession(\Request $request){
        return Images::copyImageToSession($request);
    }
}
