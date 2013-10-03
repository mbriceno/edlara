<?php

class HttpController extends BaseController {

	public function assessmentget(){

	}
	public function assessmentupdateget($id){		
        $assessment = Assessments::find($id);
        $user = User::find($assessment->teacherid);
        if(Sentry::getUser()->id == $user->id){
        	$theme = Theme::uses('dashboard')->layout('default');


        	$view = array(
        	    'name' => 'Dashboard Assessment Update'
        	);
        	$theme->breadcrumb()->add([
        	    ['label'=>'Dashboard','url'=>Setting::get('system.dashurl')],
        	    ['label'=>'Assessments','url'=>Setting::get('system.dashurl').'/assessments'],
        	    ['label'=>$id,'url'=>Setting::get('system.dashurl').'/assessment/'.$id]
        	]);
        	$theme->appendTitle(' - Assessment Update');
        	return $theme->scope('assessment.update', $view)->render();
            // return View::make('dashboard.assessments.update')->with('id',$id);
        }
        else
        {
            return "UPDATE NOT AUTHORISED";
        }
    
	}
	public function tutorialget(){

	}
	public function userget(){

	}
	public function examget(){

	}

}