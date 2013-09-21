<?php

class SubjectController extends BaseController {
	public function modder($id,$mode){
		if(Request::getMethod() == 'GET'){
			switch ($mode) {
				case 'delete':
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
					self::create();
					return Redirect::to(URL::previous());
				default:
					return "UNAUTHORISED METHOD";
			}
		}
	}
	private function update($id){		
	}
	private function create(){
	}
	private function delete($id){
	}

}
