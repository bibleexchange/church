<?php namespace App\Relay\Types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use App\Relay\Support\TypeResolver;
use GraphQLRelay\Relay;
use App\Relay\Support\GraphQLGenerator;
use App\Relay\Support\PaginatedCollection;

use App\Relay\Types\LessonType;
use App\Relay\Types\NodeType;
use App\Relay\Types\NoteType;
use App\Relay\Types\StatementType;

class ActivityType extends ObjectType {

 public function __construct(TypeResolver $typeResolver)
    {
        return parent::__construct([
            'name' => 'Activity',
            'description' => 'An activity of a lesson.',
            'fields' => [
          	  'id' => Relay::globalIdField(),
          		'lesson' => ['type' => $typeResolver->get(LessonType::class)],
          		'config' => ['type' => Type::string()],
          		'body' => ['type' => Type::string()],
          		'order_by' => ['type' => Type::int()],
          		'created_at' => ['type' => Type::string()],
          		'updated_at' => ['type' => Type::string()]
            ],
           'interfaces' => [$typeResolver->get(NodeType::class)]
        ]);
    }

}
