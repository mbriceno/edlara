<?php

class Assessment extends BaseController {

	public function siteview($id){
		return View::make('dashboard.assessments.view');
	}
	public function dashview($id){
		return;
	}
	public function update($id){

	}

}
