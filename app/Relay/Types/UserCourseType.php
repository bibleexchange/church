<?php namespace App\Relay\Types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use App\Relay\Support\TypeResolver;
use GraphQLRelay\Relay;
use App\Relay\Support\Traits\GlobalIdTrait;
use App\Relay\Support\GraphQLGenerator;

use App\Relay\Types\NodeType;
use App\Relay\Types\BibleVerseType;
use App\Relay\Types\LessonType;
use App\Relay\Types\UserType;
use App\Relay\Types\OwnerType;

class UserCourseType extends ObjectType {

use GlobalIdTrait;

 public function __construct(TypeResolver $typeResolver)
    {
	$defaultArgs = GraphQLGenerator::defaultArgs();
	$lessonsConnectionType = GraphQLGenerator::connectionType($typeResolver, LessonType::class);

        return parent::__construct([
            'name' => 'UserCourse',
            'description' => 'A user course.',
            'fields' => [
            	'id' => Relay::globalIdField(),
          		'verse' => ['type' => $typeResolver->get(BibleVerseType::class)],
          		'title' => ['type' => Type::string()],
          		'description' => ['type' => Type::string()],
              'public' => ['type' => Type::boolean()],
          		'config' => [
                'type' => Type::string(),
                'resolve' => function($root){
                  return $root->config;
                }
              ],
          		'owner' => ['type' => $typeResolver->get(OwnerType::class)],
          		'lessonsCount' => ['type' => Type::int()],
          		'created_at' => ['type' => Type::string()],
              'everything' => ['type' => Type::string()],
          		'updated_at' => ['type' => Type::string()],
              	'lessons' => [
                      'type' => $typeResolver->get($lessonsConnectionType),
                      'description' => 'The lessons of this course.',
                      'args' => $defaultArgs,
                      'resolve' => function($root, $args, $resolveInfo){
                          return $this->paginatedConnection($root->getLessons($args), $args);
                      }
                  ],
            ],
          'interfaces' => [$typeResolver->get(NodeType::class)]
        ]);
    }

}
