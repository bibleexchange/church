<?php
//dd($random = rand (1, 1024));
/*
|--------------------------------------------------------------------------
| General Application Routes
|--------------------------------------------------------------------------
|
*/
include(app_path().'/Http/routes/test.php');

Route::get('/stream/{file}', function($file){

  $contents = file_get_contents(base_path().'/public/'.$file);
  $statusCode = 200;
  $response = Response::make($contents, $statusCode);
  $response->header('Content-Type', 'application/javascript');
  $response->header('Cache-Control', 'max-age: 99');
  return $response;
});

Route::get('/bin/course-images/{course}/{file}', function($course,$file){
  return response()->file(base_path().'/../courses/'.$course.'/'.$file);
});

Route::get('/bin/courses/{course}/{file}', function($course, $file){
  return file_get_contents(base_path().'/../courses/'.$course .'/'. $file);
});

Route::get('/bin/courses/{course}/{section}/{file}', function($course, $section, $file){

  $contents = file_get_contents(base_path().'/../courses/'.$course .'/'. $section .'/'. $file);
  return $contents;
  //$statusCode = 200;
  //$response = Response::make($contents, $statusCode);
  //$response->header('Content-Type', 'application/javascript');
  //$response->header('Cache-Control', 'max-age: 99');
  return $response;
});

/*
|--------------------------------------------------------------------------
| Graphiql
|--------------------------------------------------------------------------
|
*/
Route::get('graphiql',function(){return view('graphiql');});

include(app_path().'/Relay/Http/routes.php');
/*
|------------------------------------------------------------------
| Site (this is for super admin users only)
|------------------------------------------------------------------
*/
include(app_path().'/Http/routes/site.php');

/*
|------------------------------------------------------------------
| Lrs & Lrs Client & Exporting & Reporting
|------------------------------------------------------------------
*/
include(app_path().'/Http/routes/lrs.php');

/*
|------------------------------------------------------------------
| Statements
|------------------------------------------------------------------
*/
include(app_path().'/Http/routes/statements.php');

/*
|------------------------------------------------------------------
| Learning Locker RESTful API
|------------------------------------------------------------------
*/
include(app_path().'/Http/routes/api-v1.php');

/*
|----------------------------------------------------------------------
| Auth handling
|----------------------------------------------------------------------
*/
include(app_path().'/Http/routes/auth.php');


Route::get('/course-api/{course}/full', function($course_name) {
  $course = new App\Services\CourseCreator($course_name);
  return response()->json($course->toJSON());
});
  
Route::get('{section}', '\App\Http\Controllers\ReactController@index')->where(['section' => '.*']);

//CATCH ALL ROUTE

Route::get('/notes/{noteId}', '\App\Http\Controllers\ReactController@note');
Route::get('/course/{courseId}', '\App\Http\Controllers\ReactController@course');
Route::get('/bible/{reference}', '\App\Http\Controllers\ReactController@bible');
Route::get('/register/{confirmation_code}', '\App\Http\Controllers\RegistrationController@confirmUser');
Route::get('{section}', '\App\Http\Controllers\ReactController@index')->where(['section' => '.*']);

