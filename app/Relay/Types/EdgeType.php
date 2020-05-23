<?php namespace App\Relay\Types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use App\Relay\Support\TypeResolver;
use GraphQLRelay\Relay;
use App\Relay\Support\Traits\GlobalIdTrait;
use App\Relay\Support\GraphQLGenerator;

class EdgeType extends ObjectType {

 public function __construct(TypeResolver $typeResolver, $nodeType)
    {

        $name = explode("\\", $nodeType);

        return parent::__construct([
           'name' => end($name) . 'Edge',
           'description' => "An edge in a connection",
           'fields' => [
            
             'typename' => [
                        'type' => Type::string(),
                        'description' => 'The item at the end of the edge',
                        'resolve' =>  function($root){
                          return $nodeType;
                        },
                    ],

              'node' => [
                        'type' => $typeResolver->get($nodeType),
                        'description' => 'The item at the end of the edge',
                        'resolve' =>  function($root){
                          return $root->node;
                        },
                    ],
              'cursor' => [
                        'type' => Type::nonNull(Type::string()),
                        'description' => 'A cursor for use in pagination',    
                        'resolve' =>  function($root){
                            return $root->cursor;
                          }
                    ],
            ],
           'interfaces' => []
        ]);

    }

}