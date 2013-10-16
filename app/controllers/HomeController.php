<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function index()
	{
		$theme = Theme::uses('site')->layout('default');
		$theme->setTitle('Home');
		
		// var_dump($tutorials);
		Cache::forget('latest_tr_slides');
		Cache::forget('tutorials');
		Cache::forget('latest_tutorials');
		Cache::forget('latest_tutes');
		Cache::forget('topstudents');
		Cache::forget('topstudentlist');
		$tutorialslides =  Cache::remember('latest_tr_slides',1,function(){
			$tutorials = Cache::remember('tutorials', 1, function()
			{
			    return DB::select(DB::raw('SELECT tutorialid FROM assessments GROUP BY tutorialid HAVING(COUNT(*)) ORDER BY COUNT(*) DESC LIMIT 5 ;'));
			});
			$out='';
			foreach ($tutorials as $tutorial_t){
				$out .= "<div style='text-align:justify;text-justify:inter-word;'>";
				$tutorial = Tutorials::find($tutorial_t->tutorialid);
				$string = $tutorial->content;
				$string = (strlen($string) > 753) ? substr($string,0,750).'...' : $string;
				$string = wordwrap($string,200,"<br>\n");
				$out .='<h2>'.$tutorial->name.'</h2>';
				$out .='<div style="display:inline-block;">
				<label class="label label-success">Subject
				</label>'.Subject::find($tutorial->subjectid)->subjectname.'&nbsp;&nbsp;&nbsp;&nbsp;<label class="label label-success">Grade</label> :- '.Subject::find($tutorial->subjectid)->grade.'</div>';
				$out .="&nbsp;<br>&nbsp;<br>".$string;
				$out .="&nbsp;<br><a class='btn btn-large' href='/tutorial/".$tutorial->id."/'>Read More ...</a>&nbsp;<br>&nbsp;<br>&nbsp;<br>";
				$out .='</div>';
			}
			return $out;
        });
		$latest_tutorials = Cache::remember('latest_tutorials',20,function(){
			$tutorials = Cache::remember('latest_tutes',20,function(){
				return DB::select(DB::raw('SELECT id from tutorials ORDER BY `created_at` DESC LIMIT 5;'));
			});
			$out ='';
			foreach ($tutorials as $tutorial_t){
				$out .= "<div style='text-align:justify;text-justify:inter-word;'>";
				$tutorial = Tutorials::find($tutorial_t->id);
				$string = $tutorial->content;
				$string = (strlen($string) > 753) ? substr($string,0,750).'...' : $string;
				$string = wordwrap($string,200,"<br>\n");
				$out.='<h2>'.$tutorial->name.'</h2>';
				$out.='<p style="display:inline-block;">
				<label class="label label-success">Subject
				</label>'.Subject::find($tutorial->subjectid)->subjectname.'&nbsp;&nbsp;&nbsp;&nbsp;<label class="label label-success">Grade</label> :- '.Subject::find($tutorial->subjectid)->grade.'</p>';
				$out.="&nbsp;<br>&nbsp;<br>".$string;
				$out.="&nbsp;<br><a class='btn btn-large' href='/tutorial/".$tutorial->id."/'>Read More ...</a>&nbsp;<br>&nbsp;<br>&nbsp;<br>";
				$out.='</div>';
			}
			return $out;
		});
		$topstudents = Cache::remember('topstudents',20,function(){
			$out='';
			$topstudentlist = Cache::remember('topstudentlist',20,function(){
				return DB::select(DB::raw('SELECT studentid as sid,AVG(marks) as average
				 FROM assessments WHERE `created_at` >= CURDATE() - INTERVAL 7 DAY  GROUP BY studentid ORDER BY average DESC LIMIT 0,5;'));
			});
			foreach ($topstudentlist as $student){
				$user = User::find($student->sid);
				$url = Gravatarer::make( [
                            'email' => $user->email, 
                            'size' => 200, 
                            'defaultImage' => 'mm',
                            'rating' => 'g',
                            ])->url();
				$out .= "<div style='height:260px;'>";
				$out .= "<img style='clear:left;' class='avatar' alt='".$user->email."' src='".$url."'/>
				<br><strong>Name:</strong>".$user->first_name.' '.$user->last_name.'';
				$out .= "<br><label class='label label-success'>Average Score</label> is ".(int)$student->average."";
				$out .= "</div>";			
			}
			return $out;
		});
		$add = [
		'tutorialslides'=>$tutorialslides,
		'latesttutorialslides'=>$latest_tutorials,
		'topstudents'=>$topstudents
		];
		return $theme->scope('index',$add)->content();
	}

}