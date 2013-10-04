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
        	    'name' => 'Dashboard Assessment Update',
                'id'=>$id
        	);
        	$theme->breadcrumb()->add([
        	    ['label'=>'Dashboard','url'=>Setting::get('system.dashurl')],
        	    ['label'=>'Assessments','url'=>Setting::get('system.dashurl').'/assessments'],
        	    ['label'=>$id,'url'=>Setting::get('system.dashurl').'/assessment/'.$id]
        	]);
        	$theme->appendTitle(' - Assessment Update');
                        $theme->asset()->container('datatable')->writeScript('inline-script','$(document).ready(function(){
                $(\'#attachments\').dataTable({
                    "sDom": "<\'row\'<\'col-xs-5 col-sm-5 col-md-5\'l><\'col-xs-5 col-sm-5 col-md-5\'f>r>t<\'row\'<\'col-xs-5 col-sm-5 col-md-5\'i><\'col-xs-5 col-sm-5 col-md-5\'p>>",
                        "oLanguage": {
                        "sLengthMenu": "_MENU_ '.' Attachments per page"
                        },
                        "sPagination":"bootstrap"
                   
                });
            });');
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
    public function examupdateget($id){

        if(Exams::find($id)){
            $theme = Theme::uses('dashboard')->layout('default');
            $view = array(
                'name' => 'Dashboard Assessment Update',
                'id'=>$id
            );
            $theme->breadcrumb()->add([
                ['label'=>'Dashboard','url'=>Setting::get('system.dashurl')],
                ['label'=>'Exams','url'=>Setting::get('system.dashurl').'/exams'],
                ['label'=>$id,'url'=>Setting::get('system.dashurl').'/exam/'.$id]
            ]);
            return $theme->scope('exam.update', $view)->render();
            // return View::make('dashboard.exams.edit')->with('id',$id);
        }
        return View::make('dashboard.exams.create')->with('id',0);
    }
}