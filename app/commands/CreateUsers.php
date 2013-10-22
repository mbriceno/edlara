<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class CreateUsersTable extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'createusers:create';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create Users';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function fire()
	{
		//

		$faker = Faker\Factory::create();
		$minimum = $this->option('minimum');
		for($is=1;$is<=$minimum;$is++){
			$first_name = $faker->firstname;
			$last_name = $faker->lastname;
			$email = $faker->safeEmail;
			$password="user123456";
			$usergroup = rand(1,3);
			$subjects = self::createSubjects();
			$user = Sentry::getUserProvider()->create(array(
			     'email' => $email,
			     'password' => $password,
			     'activated'=>'1',
			     'first_name' => $first_name,
			     'last_name' => $last_name,
				'created_at'=>self::randDate('10th January 2013',date('jS F o'))
			     ));

			// Find the group using the group id
			$adminGroup = Sentry::getGroupProvider()->findById($usergroup);
			$user->addGroup($adminGroup);
			if($usergroup == 2){
				$teacher = new Teacher;
				$teacher->user_id = $user->id;
				$teacher->email=$email;
				$teacher->extra = $subjects;
				$teacher->dob = self::randDate('10th January 1950',date('d-m-Y'));
				$teacher->created_at=self::randDate('10th January 2013',date('jS F o'));
				$teacher->save();
			}
			if($usergroup == 3){
				$student = new Student;
				$student->user_id = $user->id;
				$student->email=$email;
				$student->extra = $subjects;
				$student->dob = self::randDate('10th January 1995','10th January 2005');
				$student->created_at=self::randDate('10th January 2013',date('jS F o'));
				$student->save();
			}
		}
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			// array('IN', InputArgument::REQUIRED, 'An example argument.'),
		);

	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			array('minimum', null, InputOption::VALUE_OPTIONAL, 'Minimum Number of Users to Create', 5),
		);
	}
	public function createSubjects(){
		$subjects = array();
		for($i=1;$i<=55;$i++){

			$random = rand(0,1);
			if($random==1){
				$subjects[]=$i;
			}
		}
		return serialize($subjects);
	}
	public function randDate($min_date, $max_date) {
	    /* Gets 2 dates as string, earlier and later date.
	       Returns date in between them.
	    */

	    $min_epoch = strtotime($min_date);
	    $max_epoch = strtotime($max_date);

	    $rand_epoch = rand($min_epoch, $max_epoch);

	    return date('Y-m-d H:i:s', $rand_epoch);
	}
}