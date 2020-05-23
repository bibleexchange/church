<?php namespace App\Relay\Mutations;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use App\Relay\Support\TypeResolver;
use GraphQLRelay\Relay;
use App\Relay\Types\ErrorType;
use App\Relay\Types\UserType;
use App\Relay\Types\NoteType;
use App\Relay\Types\ViewerType;
use App\User as UserModel;
use App\Viewer;

class User {

    public static function create(TypeResolver $typeResolver){

      return Relay::mutationWithClientMutationId([
    	    'name' => 'CreateUser',
    	    'inputFields' => [
          		'email' => [
          		    'type' => Type::nonNull(Type::string())
          		],
          		'password' => [
          		    'type' =>  Type::nonNull(Type::string())
          		]
          	    ],
          'outputFields' => [
          		'token' => [
          		    'type' => Type::string(),
          		    'resolve' => function ($payload) {
          		        return $payload['token'];
          		    }
          		],
            'error' => [
                'type' => $typeResolver->get(ErrorType::class),
                'resolve' => function ($payload) {
                    return $payload['error'];
                }
            ],
          		'viewer' => [
          		    'type' => $typeResolver->get(ViewerType::class),
          		    'resolve' => function ($payload) {
          		        return $payload['viewer'];
          		    }
          		]
          ],
          'mutateAndGetPayload' => function ($input) {
          		$newAuth = UserModel::signup($input['email'], $input['password']);

              if($newAuth->error->code === 200){

                $newAuth = UserModel::login($newAuth->user);

                return [
          		    'token' => $newAuth->token,
          		    'error' => $newAuth->error,
           		    'viewer' =>  new Viewer($newAuth)
          		];

            }else{


                return [
                  'token' => $newAuth->token,
                  'error' => $newAuth->error,
                  'viewer' =>  new Viewer($newAuth)
              ];

            }
          	    }
          	]);

    }

}
