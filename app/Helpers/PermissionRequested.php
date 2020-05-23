<?php namespace App\Helpers;

class PermissionRequested {

  public function __construct($user, $request, $options){

      $this->user = $user;
      $this->request = $request;
      $this->options = $options;
      $this->can = false;
      $this->reason = "I_SAY_NO_TO_EVERYBODY_AT_FIRST";

      if($user->hasRole('SUPER')){
        $this->can = true;
        $this->reason = "SUPER_USER_CAN_DO_ANYTHING";
      }else{

        switch ($request) {
          case 'EDIT_LRS': $this->editLRS(); break;
          case 'CREATE_LRS': $this->createLRS(); break;
          case 'CREATE_LESSON': $this->createLesson(); break;
          case 'UPDATE_LESSON': $this->updateLesson(); break;
          case 'DESTROY_LESSON': $this->destroyLesson(); break;

          case 'CREATE_COURSE': $this->createCourse(); break;
          case 'UPDATE_COURSE': $this->updateCourse(); break;
          case 'DESTROY_COURSE': $this->destroyCourse(); break;
          case 'CREATE_STATEMENT': $this->createStatement(); break;

          default: //$hasPermission = in_array($request,$this->permissions());
        }

      }

   }

   function editLRS(){
      //$lrs = $this->user->lrs()->where('lrs_id',$this->options['lrs_id'])->get();
      $this->can = false;
      $this->reason = "NOT_ALLOWING_ANYONE_RIGHT_NOW";
   }

   function createLRS(){
      $hasPermission = in_array($request,$user->permissions());
      $this->can = $hasPermission;
      
      if($hasPermission){
        $this->reason = "";
      }else{
        $this->reason = "USER_DOES_NOT_HAVE_PERMISSION_TO_" . $this->request;
      }

      

   }

      function createLesson(){
          $course = Course::find($this->options['course_id']);

          if($course !== null){

            $this->can  = $this->user->id === $course->user_id;

            if(!$this->can){
              $this->reason = "USER_CANNOT_CREATE_LESSONS_FOR_" . $course->title . "_ID_" . $course->id;
            }

          }else{
            $this->reason = "COURSE_" . $this->options['course_id'] . "_NOT_FOUND";
          }
      

   }

         function updateLesson(){
          $lesson = Lesson::find($this->options['id']);

          if($lesson !== null){

            $this->can  = $this->user->id === $lesson->course->user_id;

            if(!$this->can){
              $this->reason = "USER_CANNOT_UPDATE_LESSONS_FOR_COURSE_" . $lesson->course->title . "_ID_" . $lesson->course->id;
            }

          }else{
            $this->reason = "LESSON_ID_" . $this->options['id'] . "_NOT_FOUND";
          }
      

   }

    function destroyLesson(){
          $lesson = Lesson::find($this->options['id']);

          if($lesson !== null){

            $this->can  = $this->user->id === $lesson->course->user_id;

            if(!$this->can){
              $this->reason = "USER_CANNOT_DELETE_LESSONS_FOR_COURSE_" . $lesson->course->title . "_ID_" . $lesson->course->id;
            }

          }else{
            $this->reason = "LESSON_ID_" . $this->options['id'] . "_NOT_FOUND";
          }
      

   }


     function createCourse(){

            $this->can  = in_array($this->request,$this->user->permissions());

            if(!$this->can){
              $this->reason = "USER_CANNOT_COURSE_WITH_TITLE_:_" . $this->options['title'];
            }

   }

         function updateCourse(){
          $course = Course::find($this->options['id']);

          if($course !== null){

            $this->can  = $this->user->id === $course->user_id;
            if(!$this->can){
              $this->reason = $this->user->id . "_USER_CANNOT_UPDATE_COURSE_WITH_ID_" . $course->id ."_AND_USER_ID:_" . $course->user_id;
            }

          }else{
            $this->reason = "COURSE_ID_" . $this->options['id'] . "_NOT_FOUND";
          }
      

   }

    function destroyCourse(){
          $course = Course::find($this->options['id']);

          if($course !== null){

            $this->can  = $this->user->id === $course->user_id;

            if(!$this->can){
              $this->reason = "USER_CANNOT_DELETE_COURSE_WITH_ID_:_" . $course->id;
            }

          }else{
            $this->reason = "COURSE_ID_" . $this->options['id'] . "_NOT_FOUND";
          }
      

   }

        function createStatement(){
            $this->can  = true;
        }

}
