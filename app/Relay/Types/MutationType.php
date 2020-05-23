<?php namespace App\Relay\Types;

//use GraphQL\Type\Definition\EnumType;
//use GraphQL\Type\Definition\InterfaceType;
use GraphQL\Type\Definition\NonNull;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use App\Relay\Support\Traits\GlobalIdTrait;
use App\Relay\Support\TypeResolver;
use GraphQLRelay\Relay;

use App\Relay\Types\BibleVerseType AS BibleVerse;
use App\Relay\Types\UserType AS User;
use App\Relay\Types\CourseType AS Course;
use App\Relay\Types\LessonType AS Lesson;
use App\Relay\Types\StepType AS Step;
use App\Relay\Types\NoteType AS Note;
use App\Relay\Types\ErrorType AS Error;

use App\BibleVerse as BibleVerseModel;
use App\User as UserModel;
use App\Course as CourseModel;
use App\Lesson as LessonModel;
use App\Step as StepModel;
use App\Note as NoteModel;

use App\Relay\Mutations\Course as CourseMutation;
use App\Relay\Mutations\Lesson as LessonMutation;
use App\Relay\Mutations\Note as NoteMutation;
use App\Relay\Mutations\Statement as StatementMutation;
use App\Relay\Mutations\Session as SessionMutation;
use App\Relay\Mutations\User as UserMutation;

class MutationType extends ObjectType {

use GlobalIdTrait;

    public function __construct(TypeResolver $typeResolver)
    {

        return parent::__construct([
            'name' => 'Mutation',
                'fields' => function () use ($typeResolver) {
            		   return [
            		    'createSession' => SessionMutation::create($typeResolver),
                        'deleteSession' => SessionMutation::delete($typeResolver),
                        'createUser' => UserMutation::create($typeResolver),
            		    'userCourseCreate' =>CourseMutation::create($typeResolver),
                        'userCourseUpdate' =>CourseMutation::update($typeResolver),
                        'userCourseDestroy' =>CourseMutation::destroy($typeResolver),
            		    'userLessonUpdate' => LessonMutation::update($typeResolver),
            		    'userLessonCreate' => LessonMutation::create($typeResolver),
                        'userLessonDestroy' => LessonMutation::destroy($typeResolver),
            		    'createNote' => NoteMutation::create($typeResolver),
            		    'updateNote' => NoteMutation::update($typeResolver),
            		    'deleteNote' => NoteMutation::delete($typeResolver),
                        'createStatement' => StatementMutation::create($typeResolver),
            		   ];
      		}
      	]);

    }

}
