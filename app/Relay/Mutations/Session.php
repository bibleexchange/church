<?php namespace App\Relay\Mutations;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use App\Relay\Support\TypeResolver;
use GraphQLRelay\Relay;
use App\Relay\Types\ErrorType AS Error;
use App\Relay\Types\ViewerType;
use App\Relay\Types\NoteType;
use App\User as UserModel;
use App\Relay\Support\GraphQLGenerator;
use App\Relay\Support\Traits\GlobalIdTrait;
use App\Viewer;
use stdClass;

class Session {

    public static function create(TypeResolver $typeResolver){

      $defaultArgs = GraphQLGenerator::defaultArgs();

      return Relay::mutationWithClientMutationId([
          'name' => 'CreateSession',
          'inputFields' => [
        'email' => [
            'type' => Type::nonNull(Type::string())
        ],
        'password' => [
            'type' =>  Type::nonNull(Type::string())
        ]
          ],
          'outputFields' => [

            'error' => [
                'type' => $typeResolver->get(Error::class),
                'resolve' => function ($payload) {
                    return $payload['error'];
                }
            ],
            'token' => [
                'type' => Type::string(),
                'resolve' => function ($payload) {
                    return $payload['token'];
                }
            ],
            'viewer' => [
                'type' => $typeResolver->get(ViewerType::class),
                'resolve' => function ($payload) {

                    if($payload['viewer'] !== null){
                      return $payload['viewer'];
                    }else{
                      return null;
                    }


                }
            ]

          ],
          'mutateAndGetPayload' => function ($input) {
            $newAuth = UserModel::createToken($input['email'], $input['password']);

              return [
                  'error' => $newAuth->error,
                  'token' => $newAuth->token,
                  'viewer' => new Viewer($newAuth)
              ];
          }
      ]);
    }


    public static function delete(TypeResolver $typeResolver){

      return Relay::mutationWithClientMutationId([
          'name' => 'DeleteSession',
          'inputFields' => [
            'token' => [
                'type' => Type::nonNull(Type::string())
            ]
          ],
          'outputFields' => [

            'error' => [
                'type' => $typeResolver->get(Error::class),
                'resolve' => function ($payload) {
                    return $payload['error'];
                }
            ],
            'token' => [
                'type' => Type::string(),
                'resolve' => function ($payload) {
                    return $payload['token'];
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
            
            $auth = UserModel::failLogin();

              return [
                  'error' => $auth->error,
                  'token' => $auth->token,
                  'viewer' => new Viewer($auth)
              ];
          }
      ]);
    }


}
