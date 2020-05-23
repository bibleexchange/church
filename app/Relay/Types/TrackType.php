<?php namespace App\Relay\Types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use App\Relay\Support\TypeResolver;
use GraphQLRelay\Relay;
use App\Relay\Support\GraphQLGenerator;
use App\Relay\Support\PaginatedCollection;
use App\Relay\Types\NodeType;
use App\Relay\Types\CourseType;
use App\Relay\Types\LessonType;
use App\Relay\Types\StatementType;
use App\Relay\Types\OwnerType;

use App\Note as NoteModel;

class TrackType extends ObjectType {

 public function __construct(TypeResolver $typeResolver)
    {

        return parent::__construct([
            'name' => 'Track',
            'description' => 'A track.',
            'fields' => [
               'id' => Relay::globalIdField(),
       		   'course' => ['type' => $typeResolver->get(CourseType::class)],
       		   'user' => ['type' => $typeResolver->get(OwnerType::class)],
               'activity' => ['type' => $typeResolver->get(ActivityType::class)],
               'lesson' => ['type' => $typeResolver->get(LessonType::class)],
               'lessonStatements' => [
                    'type' => GraphQLGenerator::resolveConnectionType($typeResolver, StatementType::class),
                    'description' => 'User experience with currentLesson.',
                    'args' => GraphQLGenerator::paginationArgs(),
                    'resolve' => function($root, $args, $resolveInfo){
                          return new PaginatedCollection($args, $root->lesson->statements());

                    },
                  ]

            ],
           'interfaces' => [$typeResolver->get(NodeType::class)]
        ]);
    }

}
