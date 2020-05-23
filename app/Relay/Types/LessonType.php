<?php namespace App\Relay\Types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use App\Relay\Support\TypeResolver;
use GraphQLRelay\Relay;
use App\Relay\Support\Traits\GlobalIdTrait;
use App\Relay\Support\GraphQLGenerator;
use App\Relay\Support\PaginatedCollection;

use App\Relay\Types\NodeType;
use App\Relay\Types\ActivityType;

use App\Lesson as LessonModel;

class LessonType extends ObjectType {

use GlobalIdTrait;

 public function __construct(TypeResolver $typeResolver)
    {
        return parent::__construct([
            'name' => 'Lesson',
            'description' => 'A lesson of a course.',
            'fields' => [
            	'id' => Relay::globalIdField(),
          		'title' => ['type' => Type::string()],
          		'description' => ['type' => Type::string()],
          		'order_by' => ['type' => Type::int()],
          		'course_id' => ['type' => Type::int()],
          		'next' => ['type' => $typeResolver->get(LessonType::class)],
          		'previous' => ['type' => $typeResolver->get(LessonType::class)],
          		'created_at' => ['type' => Type::string()],
          		'updated_at' => ['type' => Type::string()],
  	      		'activitiesCount' => ['type' => Type::int()],
            'activities' => [
                  'type' => $typeResolver->get(GraphQLGenerator::connectionType($typeResolver, ActivityType::class)),
                  'description' => 'The activities of this lesson.',
                  'args' =>  GraphQLGenerator::paginationArgs(),
                  'resolve' => function($root, $args, $resolveInfo){
                      $args['skip_order_by'] = 'true';

                          return new PaginatedCollection($args, $root->activities()->orderBy('activities.order_by','ASC'));
                    }
              ]

            ],
          'interfaces' => [$typeResolver->get(NodeType::class)]
        ]);
    }

}
