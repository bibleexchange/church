<?php namespace App\Relay\Types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use App\Relay\Support\TypeResolver;
use GraphQLRelay\Relay;
use App\Relay\Support\Traits\GlobalIdTrait;
use App\Relay\Types\NodeType as Node;
use App\User as UserModel;

class NavHistoryType extends ObjectType {

use GlobalIdTrait;

 public function __construct(TypeResolver $typeResolver)
    {

        return parent::__construct([
            'name' => 'NavHistory',
            'description' => 'A users navigation history',
            'fields' => [
          	'id' => Relay::globalIdField(),
                'url' => [
                    'type' => Type::string(),
                    'description' => '',
                ],
                'title' => [
                    'type' => Type::string(),
                    'description' => '',
                ]
            ],
           'interfaces' => [$typeResolver->get(Node::class)]
        ]);
    }

       public static function modelFind($id,  $typeClass){
        	//$model = UserModel::navHistory();
        	//$model->relayType =  $typeClass;
        	//return $model;
       }

}
