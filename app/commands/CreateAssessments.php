<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class CreateAssessments extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'createassessments:create';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create Assessments for Demo Purposes';

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
		$tutorials= objectToArray(DB::select(DB::raw('select id from tutorials')));
		$tutorials = array_dot($tutorials);
		$students = array_dot(objectToArray(DB::select(DB::raw('SELECT `user_id` as `id`  from `students`'))));
		$teachers = array_dot(objectToArray(DB::select(DB::raw('SELECT `user_id` as `id`  from `teachers`'))));
		$subjects = array_dot(objectToArray(DB::select(DB::raw('SELECT id from subjects'))));

		$minimum = $this->option('minimum');
		$assessmenttitle="This is a {title|heading|header} for Assessment.";
		$assessmentdesc = "This is a sample {data|words|description} for Assessment.";
		for($i=1;$i<=$minimum;$i++){
			$assessment = new Assessments;
			$assessment->title= self::spintax($assessmenttitle);
			$assessment->description=self::spintax($assessmentdesc);
			$assessment->assessmenttype="presentation";
			$assessment->tutorialid=rand(1,100);
			$assessment->teacherid=array_rand($teachers);
			$assessment->subjectid=rand(1,55);
			$assessment->studentid=array_rand($students);
			$assessment->marks = rand(75,100);
			$assessment->created_at=self::randDate('10th January 2013',date('jS F o'));
			$assessment->save();
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
			// array('example', InputArgument::REQUIRED, 'An example argument.'),
		);
	}

	/**
	 * @name randDate
	 */
	public function randDate($min_date, $max_date) {
  
    $min_epoch = strtotime($min_date);
    $max_epoch = strtotime($max_date);

    $rand_epoch = rand($min_epoch, $max_epoch);

    return date('Y-m-d H:i:s', $rand_epoch);
	}
	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			array('minimum', null, InputOption::VALUE_OPTIONAL, 'Minimum Number of Assessments to Create', 5),
		);
	}
	private function spintax($s) {
	    preg_match('#{(.+?)}#is',$s,$m);
	    if(empty($m)) return $s;

	    $t = $m[1];

	    if(strpos($t,'{')!==false){
	            $t = substr($t, strrpos($t,'{') + 1);
	    }

	    $parts = explode("|", $t);
	    $s = preg_replace("+{".preg_quote($t)."}+is", $parts[array_rand($parts)], $s, 1);

	    return self::spintax($s);
	}
}