<?php namespace App\Relay\Types;

use GraphQL\Type\Definition\ObjectType;
use App\Relay\Support\TypeResolver;
use App\Relay\Support\GraphQLGenerator;
use GraphQLRelay\Relay;
use GraphQL\Type\Definition\Type;

use App\Relay\Types\ResultInfoType;

class ConnectionType extends ObjectType {

 public function __construct(TypeResolver $typeResolver, $nodeType)
    {
      $connection = Relay::connectionType([
	      'nodeType' => $typeResolver->get($nodeType),
	      'connectionFields' => [
      		'info' => ['type' => $typeResolver->get(ResultInfoType::class)]
	      ]
	    ]);

        return parent::__construct([
            'name' => $connection->config['name'],
            'description' => $connection->config['description'],
            'fields' => $connection->config['fields'],
           'interfaces' => []
        ]);

    }

}