<?php namespace App;

use App\Helpers\Parsedown;
use stdclass;

class CourseRepository {
    
    public $source;
    public $posts;

    public function __construct(){
       $this->db = storage_path().'/db/courses.json';
       $this->lessonsPath = storage_path().'/db/lessons/';
       $this->path = base_path().'/resources/docs/blog/';   
    }

    public function all()
    {
        return $this->build()->db->data->courses;
    }

    public function where($field, $compare, $value)
    {
        $this->build();
        return $this->posts;    
    }

    private function build(){
        if(!is_object($this->db)){
            $this->db = json_decode(file_get_contents($this->db));
        }
        
        return $this;
    }

    public function first($id){

        $item = null;
        foreach($this->build()->db->data->courses as $struct) {
            if ($id == $struct->id) {
                $item = $struct;
                break;
            }
        }
        return $item;
    }

    public function lesson($courseId,$lessonId)
    {   
        $file = json_decode(file_get_contents($this->lessonsPath . $lessonId . ".json"));

        $lesson = null;

        foreach($this->first($courseId)->tasks as $task){

            if((int) $task->id === (int) $lessonId){
                $lesson = $task;
                break;
            }
        }

        if($file->value->raw){
            $raw = $file->value->raw;
        }else{
            dd($lesson, $file);
            $raw = $file->value->raw;
        }

        $lesson->value->text = \App\Helpers\Parsedown::parse($raw, $file->title);

        return $lesson;
    }

    public function scanADir()
    {
        $this->posts = preg_grep('/^([^.])/', scandir($this->source));
        $posts = [];

        foreach($this->posts AS $post){
            $posts[]= \App\Helpers\Parsedown::parse(file_get_contents($this->source . $post), $post );
        }

        $this->posts = $posts;
       
        return $this;
    }

}
