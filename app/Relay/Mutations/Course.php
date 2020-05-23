<?php namespace App\Relay\Mutations;

//use GraphQL\Type\Definition\EnumType;
//use GraphQL\Type\Definition\InterfaceType;
use GraphQL\Type\Definition\NonNull;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use App\Relay\Support\Traits\GlobalIdTrait;
use App\Relay\Support\TypeResolver;
use GraphQLRelay\Relay;
use App\Relay\Support\GraphQLGenerator;

use App\Relay\Types\BibleVerseType AS BibleVerse;
use App\Relay\Types\UserCourseType AS UserCourseType;
use App\Relay\Types\UserType AS UserType;
use App\Relay\Types\LessonType AS Lesson;
use App\Relay\Types\StepType AS Step;
use App\Relay\Types\NoteType;
use App\Relay\Types\ErrorType AS Error;
use App\BibleVerse as BibleVerseModel;

use App\Course as CourseModel;
use App\Lesson as LessonModel;
use App\Step as StepModel;
use App\Note as NoteModel;
use App\User as UserModel;
use App\Viewer as ViewerModel;

class Course {

  use GlobalIdTrait;

    public static function create(TypeResolver $typeResolver){

    $userCoursesConnectionType = GraphQLGenerator::connectionType($typeResolver, UserCourseType::class);

      return Relay::mutationWithClientMutationId([
          'name' => 'CourseCreate',
          'inputFields' => [
            'token' => [
                'type' =>   Type::nonNull(Type::string())
            ],
            'title' => [
                'type' => Type::string()
            ],
            'description' => [
                'type' =>  Type::string()
            ],
            'reference' => [
                'type' =>  Type::string()
            ],   
            'public' => [
                'type' =>  Type::boolean()
            ],
            'config' => [
                'type' =>  Type::string()
            ]
          ],
          'outputFields' => [
        'error' => [
            'type' => Type::string(),
            'resolve' => function ($payload) {
                return $payload['error'];
            }
        ],
        'code' => [
            'type' => Type::string(),
            'resolve' => function ($payload) {
                return $payload['code'];
            }
        ],

        'newCourseEdge' => [
            'type' =>  $typeResolver->get(UserCourseType::class),
            'resolve' => function ($payload) {
                return $payload['newCourseEdge'];
            }
        ],

        'courses' => [
                    'type' => $typeResolver->get($userCoursesConnectionType),
                    'description' => 'User Owned Courses',
                    'args' => array_merge(Relay::connectionArgs(), ['collection' => ['type' => Type::string()], 'filter' => ['type' => Type::string()], 'id' => ['type' => Type::string()] ]),
                    'resolve' => function($payload, $args, $resolveInfo){
                        $args['filter_by'] = ["title"];
                        $args['model'] = "courses";
                        return Self::paginatedConnection($payload['courses'], $args);
                    },
              ],

          ],
          'mutateAndGetPayload' => function ($input) {

            $user = UserModel::getAuth($input['token']);
            $userCan = $user->user->can('CREATE_COURSE', $input);

            if($userCan->can){
                $input['user_id'] = $user->user->id;
                $new = CourseModel::createFromArray(array_except($input,['id','token','clientMutationId']));
            }else{
                $new['error'] = $userCan->reason;
                $new['code'] = 500;
                $new['course'] = new CourseModel;
            }

            $new['courses'] = $user->user->courses;

            return [
                'error' => $new['error'],
                'code' => $new['code'],
                'newCourseEdge' => $new['course'],
                'courses'=>  $new['courses']
            ];
          }
      ]);

    }

    public static function destroy(TypeResolver $typeResolver){

         return Relay::mutationWithClientMutationId([
        'name' => 'CourseDestroy',
        'inputFields' => [
            'token' => [
                'type' => Type::string(),
            ],

            'id' => [
                'type' => Type::nonNull(Type::string())
            ]

        ],
        'outputFields' => [
      'error' => [
          'type' => Type::string(),
          'resolve' => function ($payload) {
              return $payload['error'];
          }
      ],
      'code' => [
          'type' => Type::string(),
          'resolve' => function ($payload) {
              return $payload['code'];
          }
      ],
      'course' => [
          'type' => $typeResolver->get(UserCourseType::class),
          'resolve' => function ($payload) {
              return $payload['course'];
          }
      ]
        ],
        'mutateAndGetPayload' => function ($input) {
            $user = UserModel::getAuth($input['token']);
            $input['id'] =  Relay::fromGlobalId($input['id'])['id'];
            $userCan = $user->user->can('DESTROY_COURSE', $input);

            if($userCan->can){
                $input['user_id'] = $user->user->id;
                $new = CourseModel::find($input['id']);
                CourseModel::destroy($input['id']);
            }else{
                $new['error'] = $userCan->reason;
                $new['code'] = 500;
                $new['course'] = CourseModel::find($input['id']);
            }

      return [
          'error' => $new['error'],
          'code' => $new['code'],
          'course' => $new['course'],
      ];
        }
    ]);
    }

  public static function update(TypeResolver $typeResolver){

    return Relay::mutationWithClientMutationId([
  	    'name' => 'CourseUpdate',
  	    'inputFields' => [
            'token' => [
                'type' => Type::string(),
            ],

  		'id' => [
  		    'type' => Type::nonNull(Type::string())
  		],
  		'title' => [
  		    'type' => Type::string()
  		],
  		'reference' => [
  		    'type' =>  Type::string()
  		],
  		'description' => [
  		    'type' =>  Type::string()
  		],
  		'public' => [
  		    'type' =>  Type::boolean()
  		],
  		'config' => [
  		    'type' =>  Type::string()
  		]

  	    ],
  	    'outputFields' => [
  		'error' => [
  		    'type' => Type::string(),
  		    'resolve' => function ($payload) {
  		        return $payload['error'];
  		    }
  		],
  		'code' => [
  		    'type' => Type::string(),
  		    'resolve' => function ($payload) {
  		        return $payload['code'];
  		    }
  		],
  		'course' => [
  		    'type' => $typeResolver->get(UserCourseType::class),
  		    'resolve' => function ($payload) {
  		        return $payload['course'];
  		    }
  		]
  	    ],
  	    'mutateAndGetPayload' => function ($input) {

            $user = UserModel::getAuth($input['token']);
            $input['id'] =  Relay::fromGlobalId($input['id'])['id'];
            $userCan = $user->user->can('UPDATE_COURSE', $input);

            if($userCan->can){
                $input['user_id'] = $user->user->id;
                $new = CourseModel::updateFromArray(array_except($input,['token','clientMutationId']));
            }else{
                $new['error'] = $userCan->reason;
                $new['code'] = 500;
                $new['course'] = CourseModel::find($input['id']);
            }

  		return [
  		    'error' => $new['error'],
  		    'code' => $new['code'],
   		    'course' => $new['course'],
  		];
  	    }
  	]);

  }

}
