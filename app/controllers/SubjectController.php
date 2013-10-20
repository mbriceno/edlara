<?php

class SubjectController extends BaseController {
	function __construct() {
      $this->beforeFilter('csrf', array('on' => 'update'));
      $this->beforeFilter('csrf', array('on' => 'create'));
    }
	public function modder($dash,$id,$mode){
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
					$theme = Theme::uses('dashboard')->layout('default');
					$view =[
						'id'=>$id
					];					
					$theme->setTitle(Setting::get('system.adminsitename').' Subjects');
					$theme->breadcrumb()->add([
					    ['label'=>'Dashboard','url'=>Setting::get('system.dashurl')],
					    ['label'=>'Subjects','url'=>Setting::get('system.dashurl').'/subjects'],
					    ['label'=>$id,'url'=>Setting::get('system.dashurl').'/subject/edit/'.$id.'/update']
					]);
					return $theme->scope('subject.update',$view)->render();
				case 'view':
					$validator = Validator::make(['id'=>$id],
						['id'=>'required|exists:subjects,id']
						);
					if($validator->fails()){
						return Redirect::to(URL::previous());
					}
					$theme = Theme::uses('dashboard')->layout('default');
					$view =[
						'id'=>$id
					];					
					$theme->setTitle(Setting::get('system.adminsitename').' Subjects');
					$theme->breadcrumb()->add([
					    ['label'=>'Dashboard','url'=>Setting::get('system.dashurl')],
					    ['label'=>'Subjects','url'=>Setting::get('system.dashurl').'/subjects'],
					    ['label'=>$id,'url'=>Setting::get('system.dashurl').'/subject/edit/'.$id.'/update']
					]);
					return $theme->scope('subject.view',$view)->render();
				case 'create':	
					$theme = Theme::uses('dashboard')->layout('default');
					$view =[
						'id'=>0
					];					
					$theme->setTitle(Setting::get('system.adminsitename').' Subjects');
					$theme->breadcrumb()->add([
					    ['label'=>'Dashboard','url'=>Setting::get('system.dashurl')],
					    ['label'=>'Subjects','url'=>Setting::get('system.dashurl').'/subjects'],
					    ['label'=>$id,'url'=>Setting::get('system.dashurl').'/subject/edit/0/update']
					]);
					return $theme->scope('subject.create',$view)->render();		
				default:
					return "UNAUTHORISED METHOD";
					break;
			}
		}
		if(Request::getMethod()=='POST'){
			switch($mode){
				case 'update':
					self::update($id);
					return Redirect::to('/subjects');
				case 'create':
					if($id == 0){
					self::create();					
					return Redirect::to('/subjects');
					}					
					return Redirect::to(URL::previous());
				default:
					Log::error('UnAuthorised Access at Subjects Page.');
					return Redirect::to('dash');
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
