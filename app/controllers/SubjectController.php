<?php

class SubjectController extends BaseController {
	function __construct() {
      $this->beforeFilter('csrf', array('on' => 'update'));
      $this->beforeFilter('csrf', array('on' => 'create'));
    }
	public function modder($id,$mode){
		if(Request::getMethod() == 'GET'){
			switch ($mode) {
				case 'delete':
					$validator = Validator::make(['id'=>$id],
						['id'=>'required|exists:subjects,id']
						);
					if($validator->fails()){
						return Redirect::to(URL::previous());
					}
					self::delete($id);
					return Redirect::to(URL::previous());
				case 'update':
					$validator = Validator::make(['id'=>$id],
						['id'=>'required|exists:subjects,id']
						);
					if($validator->fails()){
						return Redirect::to(URL::previous());
					}
					return View::make('dashboard.subjects.edit')->with('id',$id);
				case 'view':
					$validator = Validator::make(['id'=>$id],
						['id'=>'required|exists:subjects,id']
						);
					if($validator->fails()){
						return Redirect::to(URL::previous());
					}
					return View::make('dashboard.subjects.view')->with('id',$id);				
				default:
					return "UNAUTHORISED METHOD";
					break;
			}
		}
		if(Request::getMethod()=='POST'){
			switch($mode){
				case 'update':
					self::update($id);
					return Redirect::to(URL::previous());
				case 'create':
					if($id == 0){
					self::create();					
					return Redirect::to(URL::previous());
					}					
					return Redirect::to(URL::previous());
				default:
					return "UNAUTHORISED METHOD";
			}
		}
	}
	private function update($id){	
		$subject = Subject::findOrFail($id);
		$subject->subjectname = Input::get('name');
		$subject->subjectcode = Input::get('code');
		$subject->grade 	  = Input::get('grade');
		$subject->save();	
	}
	private function create(){
		$subject = new Subject;
		$subject->subjectname = Input::get('name');
		$subject->subjectcode = Input::get('code');
		$subject->grade 	  = Input::get('grade');
		$subject->save();
	}
	private function delete($id){
		$subject =  Subject::find($id);
		$subject->delete();
	}

}
