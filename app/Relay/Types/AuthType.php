<?php namespace App\Relay\Types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use App\Relay\Support\TypeResolver;
use GraphQLRelay\Relay;
use App\Relay\Support\Traits\GlobalIdTrait;
use App\Relay\Support\GraphQLGenerator;

use App\Relay\Types\ErrorType;

use App\Note as NoteModel;

class AuthType extends ObjectType {

   public function __construct(TypeResolver $typeResolver)
      {
          return parent::__construct([
              'name' => 'Auth',
              'description' => 'Authentication information for user',
              'fields' => [
              		'error' => ['type' => $typeResolver->get(ErrorType::class)],
              		'auth' => ['type' => Type::boolean()],
                  'type' => ['type' => Type::string()]
              ],
             'interfaces' => []
          ]);
      }

  }
