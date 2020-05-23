<?php namespace App\Relay\Queries;

//use GraphQL\Type\Definition\EnumType;
//use GraphQL\Type\Definition\InterfaceType;
use GraphQL\Type\Definition\NonNull;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

use App\Relay\Support\TypeResolver;
use App\Relay\Support\Traits\GlobalIdTrait;

use App\Relay\Types\NodeType;
use App\Relay\Types\ViewerType;

use App\Bible as BibleModel;
use App\BibleBook as BibleBookModel;
use App\BibleChapter as BibleChapterModel;
use App\BibleVerse as BibleVerseModel;
use App\Library as LibraryModel;
use App\Course as CourseModel;
use App\Lesson as LessonModel;
use App\Step as StepModel;
use App\Note as NoteModel;
use App\User as UserModel;
use App\Viewer as ViewerModel;

class ViewerQuery extends ObjectType {

use GlobalIdTrait;

    public function __construct(TypeResolver $typeResolver)
    {
	       $this->typeResolver = $typeResolver;

         $this->models = [
           'Bible'=> BibleModel::class,
           'BibleBook'=> BibleBookModel::class,
           'BibleChapter'=> BibleChapterModel::class,
           'BibleVerse'=> BibleVerseModel::class,
           'Library'=> LibraryModel::class,
           'Course'=> CourseModel::class,
           'Lesson'=> LessonModel::class,
           'Step'=> StepModel::class,
           'Note'=> NoteModel::class,
           'User'=> UserModel::class,
           'Viewer'=> ViewerModel::class,
         ];

        return parent::__construct([
            'name' => 'ViewerQuery',
            'fields' => [
              'viewer' => [
                  'type' => $this->typeResolver->get(ViewerType::class),
                  'args' => [
                    'token' => [
                                 'name' => 'token',
                                 'description' => 'auth token',
                                 'type' => Type::string()
                             ],

                    'lang' => [
                                 'name' => 'lang',
                                 'description' => 'language preference of viewer',
                                 'type' => Type::string()
                             ]
                                                     ],
                  'resolve' => function ($root, $args) {

                    if(isset($args['lang'])){
                      $root->setLang($args['lang']);
                    }
                    return $root;
                  },
                ],
                
                'node' => [
                    'type' => $this->typeResolver->get(NodeType::class),
                    'args' => [
                      'id' => [
                            'name' => 'id',
                            'description' => 'id of an Object',
                            'type' => Type::nonNull(Type::id())
                        ]
                    ],
                    'resolve' => function ($root, $args) {
                			$decoded = $this->decodeGlobalId($args['id']);
            					$index = $decoded['type'];
            					$m = $this->models[$index];
                			$model = $m::find($decoded['id']);
                			$model->relayType = ucwords($decoded['type']);
                			return $model;
                    }
                ],
                
	   ]
	]);
    }

}
