<?php

class HttpController extends BaseController {

	public function assessmentget(){

	}
	public function assessmentupdateget($dash,$id){		
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
            });$(document).ready(function(){
                $(\'#questionfail\').dataTable({
                    "sDom": "<\'row\'<\'col-xs-5 col-sm-5 col-md-5\'l><\'col-xs-5 col-sm-5 col-md-5\'f>r>t<\'row\'<\'col-xs-5 col-sm-5 col-md-5\'i><\'col-xs-5 col-sm-5 col-md-5\'p>>",
                        "oLanguage": {
                        "sLengthMenu": "_MENU_ '.' Failures per page"
                        },
                        "sPagination":"bootstrap"
                   
                });
            });');
            $theme->asset()->container('footer')->writeScript('inline-script','$(document).ready(function(){
                $("#examsheader").hide();
                $("div#exams").hide();
                $("div#examslock").hide();
                $(".hidequestions").hide();
                $(".hidequestions").click(function(){
                    $("div#exams").hide(2000);
                     $(\'html, body\').animate({
                        scrollTop: $("#top").offset().top
                    }, 2000);
                    $("#examsheader").hide(1200);
                    $("#examslock").hide(1200);
                    $(".hidequestions").hide(1000);
                    $("#showquestions").show(1000);
                });
                $("#showquestions").click(function(){
                    $("div#exams").show(2000);
                    $("div#examslock").show(100);
                    $(\'html, body\').animate({
                        scrollTop: $("#examslock").offset().top
                    }, 2000);
                    $("#examsheader").show(1000);
                    $(".hidequestions").show(1000);
                    $("#showquestions").hide(1000);
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
    public function examupdateget($dash,$id){

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
        }

        
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
        return $theme->scope('exam.create', $view)->render();
    }
}