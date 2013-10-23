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
		DB::table('tutorials')->delete();
		$faker = Faker\Factory::create();
		$minimum = $this->option('minimum');
		$tutorialcontent = "This {was|is|an|a} {interesting|creative|important} {article|spintax|text|randomtext|generatedtext}
		{and|or} it is absolutely {best|good|betterone} This {was|is|an|a} {interesting|creative|important} {article|spintax|text|randomtext|generatedtext}
		{and|or} it is absolutely {best|good|betterone} This {was|is|an|a} {interesting|creative|important} {article|spintax|text|randomtext|generatedtext}
		{and|or} it is absolutely {best|good|betterone} This {was|is|an|a} {interesting|creative|important} {article|spintax|text|randomtext|generatedtext}
		{and|or} it is absolutely {best|good|betterone} This {was|is|an|a} {interesting|creative|important} {article|spintax|text|randomtext|generatedtext}
		{and|or} it is absolutely {best|good|betterone} This {was|is|an|a} {interesting|creative|important} {article|spintax|text|randomtext|generatedtext}
		{and|or} it is absolutely {best|good|betterone} This {was|is|an|a} {interesting|creative|important} {article|spintax|text|randomtext|generatedtext}
		{and|or} it is absolutely {best|good|betterone} This {was|is|an|a} {interesting|creative|important} {article|spintax|text|randomtext|generatedtext}
		{and|or} it is absolutely {best|good|betterone} This {was|is|an|a} {interesting|creative|important} {article|spintax|text|randomtext|generatedtext}
		{and|or} it is absolutely {best|good|betterone} This {was|is|an|a} {interesting|creative|important} {article|spintax|text|randomtext|generatedtext}
		{and|or} it is absolutely {best|good|betterone} This {was|is|an|a} {interesting|creative|important} {article|spintax|text|randomtext|generatedtext}
		{and|or} it is absolutely {best|good|betterone} This {was|is|an|a} {interesting|creative|important} {article|spintax|text|randomtext|generatedtext}
		{and|or} it is absolutely {best|good|betterone} ";
		$tutorialtitle="This is a {title|heading|header}.";
		$tutorialdesc = "This is a sample {data|words|description}";
		for($i=1;$i<=$minimum;$i++){
			$tutorial = new Tutorials;
			$tutorial->name = self::spintax($tutorialtitle);
			$tutorial->subjectid = rand(1,55);
			$tutorial->createdby =$this->option('user');
			$tutorial->description=self::spintax($tutorialdesc);
			$tutorial->published=1;
			$tutorial->content = self::spintax($tutorialcontent);
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
			array('user',null,InputOption::VALUE_OPTIONAL,'Genereate Tutorials for this user',1),
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
	 * @name SpinTax
	 * @var str Text containing our {spintax|spuntext}
	 * @return str Text with random spintax selections
	 */
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