<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

    	$this->call('JobsTableSeeder');

    	$this->call('BibleVersesTableSeeder');
    	$this->call('BibleDatabaseTableSeeder');

        $this->call('UsersTableSeeder');
		$this->call('UserRolesTableSeeder');
		$this->call('UserRoleUserTableSeeder');
		$this->call('UserPermissionsTableSeeder');
		$this->call('UserPermissionRoleTableSeeder');
		$this->call('UserCommentsTableSeeder');
		$this->call('UserNotificationsTableSeeder');

		$this->call('LibrariesTableSeeder');
		$this->call('LibraryBooksTableSeeder');
		$this->call('LibraryBookChaptersTableSeeder');
		$this->call('LibraryChapterSectionsTableSeeder');

		$this->call('ClassroomsTableSeeder');
		$this->call('ClassroomCoursesTableSeeder');
		$this->call('ClassroomCourseLessonsTableSeeder');
		$this->call('ClassromCourseLessonActivitiesTableSeeder');
		$this->call('ClassroomCourseLessonActivityTextsTableSeeder');

		$this->call('RecordingsTableSeeder');
        $this->call('MediasTableSeeder');
		$this->call('UrlShortsTableSeeder');
		$this->call('MinistriesTableSeeder');
		$this->call('TagsTableSeeder');
    }
}
