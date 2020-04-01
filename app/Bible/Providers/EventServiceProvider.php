<?php namespace App\Bible\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Bible\Events\UserWasRegistered;
use App\Bible\Events\UserHasConfirmedEmail;
use App\Bible\Events\UserRequestedPasswordReset;
use App\Bible\Events\NoteWasPublished;
use App\Bible\Events\UserHasUpdatedProfile;
use App\Bible\Events\UserAskedForRegistrationConfirmation;
use App\Bible\Events\UserPasswordWasChanged;
use App\Bible\Events\UserAmenedObject;
use App\Bible\Events\CourseWasCreated;
use App\Bible\Events\StudyWasCreated;

class EventServiceProvider extends ServiceProvider {

	/**
	 * The event handler mappings for the application.
	 *
	 * @var array
	 */
	protected $listen = [
		
		UserWasRegistered::class => [
			\App\Handlers\Events\SendRegistrationConfirmation::class,
		],

		UserHasConfirmedEmail::class => [
			\App\Handlers\Events\SendWelcome::class,
		],
		
		UserAskedForRegistrationConfirmation::class => [
			\App\Handlers\Events\ResendRegistrationConfirmation::class,
		],
			
		UserRequestedPasswordReset::class => [
			\App\Handlers\Events\SendPasswordReset::class,
		],
		
		UserPasswordWasChanged::class => [
			\App\Handlers\Events\UserPasswordWasChangedHandler::class,
		],

		/*
		 * UserHasUpdatedProfile::class => [
			
		],
		
			
		LessonWasCreated::class => [
			
		],
		
		StudyWasCreated::class => [
			
		],
		*/
		CourseWasCreated::class => [
			\App\Handlers\Events\NotifyFollowersOfCourse::class,
		],
		NoteWasPublished::class => [
			\App\Handlers\Events\NotifyAdminOfNote::class,
		],
		UserAmenedObject::class => [
			\App\Handlers\Events\NotifyFollowersOfAmen::class,
		],
			
	];
	
}
