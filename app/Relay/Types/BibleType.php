<?php namespace App\Relay\Types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use App\Relay\Models\StarWarsData;
use App\Relay\Support\Traits\GlobalIdTrait;
use App\Relay\Support\TypeResolver;
use App\Relay\Support\Definition\RelayType;
use App\Relay\Support\GraphQLGenerator;

use App\Relay\Types\BibleBookType as BibleBook;
use App\Relay\Types\NodeType as Node;

use App\Bible AS BibleModel;
use GraphQLRelay\Relay;

class BibleType extends  ObjectType {

use GlobalIdTrait;

 public function __construct(TypeResolver $typeResolver)
    {

	$bibleBooksConnectionType = GraphQLGenerator::connectionType($typeResolver, BibleBookType::class);

        return parent::__construct([
            'name' => 'Bible',
            'description' => 'A version of the Holy Bible',
            'fields' => [
		'id' => Relay::globalIdField(),
		'abbreviation' => [
                    'type' => Type::string(),
                    'description' => '',
                ],
                'language' => [
                    'type' => Type::string(),
                    'description' => '',
                ],
                'version' => [
                    'type' => Type::string(),
                    'description' => 'The version of the Bible.',
                ],
                'info_text' => [
                    'type' => Type::string(),
                    'description' => '',
                ],
                'info_url' => [
                    'type' => Type::string(),
                    'description' => '',
                ],
                'publisher' => [
                    'type' => Type::string(),
                    'description' => '',
                ],
                'copyright' => [
                    'type' => Type::string(),
                    'description' => '',
                ],
                'copyright_info' => [
                    'type' => Type::string(),
                    'description' => '',
                ],
		'books' => [
                    'type' =>  $typeResolver->get($bibleBooksConnectionType),
                    'description' => 'The books of the Bible.',
            	    'args' => GraphQLGenerator::defaultArgs(),
            	    'resolve' => function($bible, $args, $resolveInfo){
                        return $this->paginatedConnection($bible->books, $args);
            	     }
                ]
		          ],
            'interfaces' => [$typeResolver->get(Node::class)]

        ]);
    }

 }
