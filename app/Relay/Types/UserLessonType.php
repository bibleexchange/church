<?php namespace App\Relay\Types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use App\Relay\Support\TypeResolver;
use GraphQLRelay\Relay;
use App\Relay\Support\Traits\GlobalIdTrait;
use App\Relay\Support\GraphQLGenerator;
use App\Relay\Support\PaginatedCollection;

use App\Relay\Types\ActivityType;
use App\Relay\Types\NodeType;
use App\Relay\Types\BibleVerseType;
use App\Relay\Types\QuizType;

use App\Lesson as LessonModel;

class UserLessonType extends ObjectType {

use GlobalIdTrait;

 public function __construct(TypeResolver $typeResolver)
    {

  $defaultArgs = GraphQLGenerator::defaultArgs();
	
     $quizzesConnectionType = GraphQLGenerator::connectionType($typeResolver, QuizType::class);
        return parent::__construct([
            'name' => 'UserLesson',
            'description' => 'A lesson of a course.',
            'fields' => [
            	'id' => Relay::globalIdField(),
          		'verse' => ['type' => $typeResolver->get(BibleVerseType::class)],
          		'title' => ['type' => Type::string()],
          		'description' => ['type' => Type::string()],
          		'order_by' => ['type' => Type::int()],
          		'course_id' => ['type' => Type::int()],
          		'next' => ['type' => $typeResolver->get(LessonType::class)],
          		'previous' => ['type' => $typeResolver->get(LessonType::class)],
          		'created_at' => ['type' => Type::string()],
          		'updated_at' => ['type' => Type::string()],
	      		
            'activities' => [
                  'type' => $typeResolver->get(GraphQLGenerator::connectionType($typeResolver, ActivityType::class)),
                  'description' => 'The activities of this lesson.',
                  'args' =>  GraphQLGenerator::paginationArgs(),
                  'resolve' => function($root, $args, $resolveInfo){
                          return new PaginatedCollection($args, new $root->activities());
                    }
              ]


            ],
          'interfaces' => [$typeResolver->get(NodeType::class)]
        ]);
    }

}
