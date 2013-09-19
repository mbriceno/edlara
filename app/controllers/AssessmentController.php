<?php

class AssessmentController extends BaseController {

	public function siteview($id){
		return View::make('dashboard.assessments.view');
	}
	public function dashview($id){
		return;
	}
	public function submit(){
		return;
	}
	public function submitview(){
		return View::make('site.assessment.new')->nest('header','main.header');
	}
	public function update(){
		return;
	}
	public function updateview($id){
		return View::make('site.assessment.update')->with('id',$id)->nest('header','main.header');
	}
	public function updatelist(){
		return View::make('site.assessments')->nest('header','main.header');
	}
}
