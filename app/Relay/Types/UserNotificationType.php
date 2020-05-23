<?php namespace App\Relay\Types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use App\Relay\Support\TypeResolver;
use GraphQLRelay\Relay;
use App\Relay\Support\Traits\GlobalIdTrait;

use App\Relay\Types\UserType as User;
use App\Relay\Types\NodeType as Node;

use App\Notification as NotificationModel;

class UserNotificationType extends ObjectType {

use GlobalIdTrait;

 public function __construct(TypeResolver $typeResolver)
    {

       return parent::__construct([
            'name' => 'UserNotification',
            'description' => 'A notification',
            'fields' => [
          	 'id' => Relay::globalIdField(),
               ,
		'sender' => [
			'type' => $typeResolver->get(User::class)
			'description' => 'sender_id'
		],
		'user' => [
			'type' => $typeResolver->get(User::class)
			'description' => 'user_id'
		],
		'type' => [
			'type' => Type::string(),
			'description' => 'The type'
		],
		'subject' => [
			'type' => Type::string(),
			'description' => 'The subject'
		],
		'body' => [
			'type' => Type::string(),
			'description' => 'body'
		],
		'object_id' => [
			'type' => Type::int(),
			'description' => 'object_id token'
		],
		'object_type' => [
			'type' => Type::string(),
			'description' => 'object_type of the user'
		],
		'sent_at' => [
			'type' => Type::string(),
			'description' => 'sent_at of the user'
		]
            ],
           'interfaces' => [$typeResolver->get(Node::class)]
        ]);
    }

       public static function modelFind($id,  $typeClass){
        	$model = NotificationModel::find($id);
        	$model->relayType =  $typeClass;
        	return $model;
       }

}
