<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class CreateTutorials extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'createtutorials:create';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Generate Sample Tutorial Data';

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
		for($i=1;$i<=$minimum;$i++){
			$tutorial = new Tutorials;
			$tutorial->name = $faker->sentence;
			$tutorial->subjectid = rand(1,55);
			$tutorial->createdby =1;
			$tutorial->description=$faker->sentence(9);
			$tutorial->published=1;
			$tutorial->content = $faker->text(3000);
			$tutorial->created_at=self::randDate('10th January 2013',date('jS F o'));
			$tutorial->save();
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
			array('minimum', null, InputOption::VALUE_OPTIONAL, 'Generate This Minimum Number of Tutorials',5),
		);
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