<?php

class ApiController extends BaseController
{

	public function index(){

		$encryptedkey = Crypt::encrypt("joomla");
		Config::set('session.driver','native');
		Session::put('api_key',$encryptedkey);
		
		return Response::json(array('status'=>'OK','_token'=>$encryptedkey));
	}

	public function start(){		
		Config::set('session.driver','native');
		$api_key = Session::get('api_key');
		return Response::json(array('status'=>'OK','_token'=>$api_key));
	
	}


	public function tutorials()
	{
		return Tutorials::all();
	}
	public function exams()
	{
		return Exams::all();
	}
	public function exam($id){
		$exam = Exams::findOrFail($id);
		$examdata = File::get(app_path().'/files/exam-'.$id.'/'.$exam->hash.'.json');
		return $examdata;
	}
}
