<?php namespace App\Relay\Types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use App\Relay\Support\TypeResolver;
use App\Relay\Support\GraphQLGenerator;
use GraphQLRelay\Relay;
use App\Relay\Types\NodeType;

class UserType extends ObjectType {

 public function __construct(TypeResolver $typeResolver)
    {

        return parent::__construct([
            'name' => 'User',
            'description' => '',
            'fields' => [
          	    'id' => Relay::globalIdField(),
                'name' => [
                    'type' => Type::string(),
                    'description' => '',
                ],
                'email' => [
                    'type' => Type::string(),
                    'description' => '',
                ],
                'nickname' => [
                    'type' => Type::string(),
                    'description' => '',
                ],
                'url' => [
                    'type' => Type::string(),
                    'description' => '',
                ],
             
              'notesCount' => ['type' => Type::int()]
            ],
           'interfaces' => [$typeResolver->get(NodeType::class)]
        ]);
    }

}