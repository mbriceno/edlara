<?php

class HomeController extends BaseController {


	public function index()
	{
		$theme = Theme::uses('site')->layout('default');
		$theme->setTitle('Home');
		
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
			$out ='';
			if($tutorials == null) {
				return $out;
			}
			foreach ($tutorials as $tutorial_t){
				$out .= "<div>";
				$tutorial = Tutorials::find($tutorial_t->tutorialid);
				$string = $tutorial->content;
				$string = (strlen($string) > 753) ? substr($string,0,750).'...' : $string;
				$string = wordwrap($string,200,"<br>\n");
				$out .='<h2 class="title">'.$tutorial->name.'</h2>';
				$out .='<label class="label label-success">Subject
				</label>'.Subject::find($tutorial->subjectid)->subjectname.'&nbsp;&nbsp;&nbsp;&nbsp;
				<label class="label label-success">Grade</label> :- '.Subject::find($tutorial->subjectid)->grade;
				$out .="&nbsp;<br>&nbsp;<br>".$string;
				$out .="&nbsp;<br><a class='btn btn-large' href='/tutorial/".$tutorial->id."/'>Read More ...</a>&nbsp;<br>&nbsp;<br>&nbsp;<br>";
				$out .='</div>';
			}
				return $out;
			});
$latest_tutorials = Cache::remember('latest_tutorials',20,function(){
	$tutorials = Cache::remember('latest_tutes',20,function(){
		return DB::select(DB::raw('SELECT id from tutorials WHERE published= 1 ORDER BY `created_at` DESC LIMIT 5;'));
	});
	$out ='';
	if($tutorials == null){
		return $out;
	}
	foreach ($tutorials as $tutorial_t){
		$tutorial = Tutorials::find($tutorial_t->id);
		$string = $tutorial->content;
		$string = preg_replace("/<img[^>]+\>/i", "", $string); 
		$images = self::getTutorialImages($tutorial->content);
		if($images == null) {
			// continue;
		}
		$string = (strlen($string) > 753) ? substr($string,0,750).'...' : $string;
		$string = wordwrap($string,200,"<br>\n");
		$out .= "<div>";
		$out .='<h2 class="title">'.$tutorial->name.'</h2>';
		$out .='<p style="display:inline-block;">
		<label class="label label-success">Subject
		</label>'.Subject::find($tutorial->subjectid)->subjectname.'&nbsp;&nbsp;&nbsp;&nbsp;<label class="label label-success">Grade</label> :- '.Subject::find($tutorial->subjectid)->grade.'</p>';
		$out .="&nbsp;<br>&nbsp;<br>".$string;
		$out .="<img src='".$images[rand(0,count($images)-1)]."' class='' style='height:100%;'/>";
		$out .="&nbsp;<br><a class='btn btn-large' href='/tutorial/".$tutorial->id."/'>Read More ...</a>&nbsp;<br>&nbsp;<br>&nbsp;<br>";
		$out .='</div>';
	}
	return $out;
});
$topstudents = Cache::remember('topstudents',20,function(){
	$out='';
	$topstudentlist = Cache::remember('topstudentlist',20,function(){
		return DB::select(DB::raw('SELECT studentid as sid,AVG(marks) as average
			FROM assessments WHERE `created_at` >= CURDATE() - INTERVAL 7 DAY  GROUP BY studentid ORDER BY average DESC LIMIT 0,5;'));
	});
	if($topstudentlist == null){
		return $out;
	}
	
	foreach ($topstudentlist as $student){
		$user = User::find($student->sid);
		$url = Gravatarer::make( [
			'email' => $user->email, 
			'size' => 200, 
			'defaultImage' => 'mm',
			'rating' => 'g',
			])->url();
		$out .= "<div>";
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
private function getTutorialImages($content) {
	$HTMLDOM = new DOMDocument();
	$HTMLDOM->loadHTML($content);
	$arrContentImages = array();

	foreach ($HTMLDOM->getElementsByTagName("img") as $objImage) {
		$arrContentImages[] = $objImage->getAttribute("src");

	}

	return (!empty($arrContentImages)) ? $arrContentImages : false;

}
}