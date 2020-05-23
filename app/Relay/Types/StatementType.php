<?php namespace App\Relay\Types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use App\Relay\Support\TypeResolver;
use App\Relay\Support\GraphQLGenerator;
use GraphQLRelay\Relay;

use App\Relay\Types\ActivityType;
use App\Relay\Types\UserType;
use App\Relay\Types\NodeType;

class StatementType extends ObjectType {

 public function __construct(TypeResolver $typeResolver)
    {
        return parent::__construct([
            'name' => 'Statement',
            'description' => 'Statement of a users Experience with an activity.',
            'fields' => [
          	   'id' => Relay::globalIdField(),
                'user' => ['type' => $typeResolver->get(UserType::class),'description' => 'user this experience belongs to.'],
                'verb' => ['type' => Type::string(),'description' => 'Action taken by user.'],
                'activity' => ['type' =>  $typeResolver->get(ActivityType::class),'description' => 'Activity action was taken upon by user.'],
            ],
           'interfaces' => [$typeResolver->get(NodeType::class)]
        ]);
    }

}