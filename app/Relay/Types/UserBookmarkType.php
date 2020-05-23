<?php namespace App\Relay\Types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use App\Relay\Support\TypeResolver;
use GraphQLRelay\Relay;
use App\Relay\Support\Traits\GlobalIdTrait;

use App\Relay\Types\UserType as User;
use App\Relay\Types\NodeType as Node;

use App\Bookmark as BookmarkModel;

class UserBookmarkType extends ObjectType {

use GlobalIdTrait;

 public function __construct(TypeResolver $typeResolver)
    {

       return parent::__construct([
            'name' => 'UserBookmark',
            'description' => 'A bookmark',
            'fields' => [
          	'id' => Relay::globalIdField(),
		'url' => [
			'type' => Type::string(),
			'description' => 'The url bookmarked.'
		],
		'user' => [
			'type' => $typeResolver->get(User::class),
			'description' => 'User relationship. Creator of this bookmark.'
		],
		'created_at' => [
			'type' => Type::string(),
			'description' => 'When bookmark was created.'
		],
		'updated_at' => [
			'type' => Type::string(),
			'description' => 'When bookmark was last updated.'
		]
            ],
           'interfaces' => [$typeResolver->get(Node::class)]
        ]);
    }

       public static function modelFind($id,  $typeClass){
        	$model = BookmarkModel::find($id);
        	$model->relayType =  $typeClass;
        	return $model;
       }

}
