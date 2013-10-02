<?php

class DashboardController extends BaseController
{
	public function dash(){

        $theme = Theme::uses('dashboard')->layout('dash');

        $view = array(
            'name' => 'Dashboard Home'
        );
        $theme->breadcrumb()->add([
            ['label'=>'Dashboard','url'=>Setting::get('system.dashurl')]
        ]);
        $theme->appendTitle(' - Dashboard');
        
        return $theme->scope('home', $view)->render();
	}
	
	public function teachers(){
		$theme = Theme::uses('dashboard')->layout('default');
		$view = array(
		    'name' => 'Dashboard Teachers'
		);
		$theme->breadcrumb()->add([
		    ['label'=>'Dashboard','url'=>Setting::get('system.dashurl')],
		    ['label'=>'Teachers','url'=>Setting::get('system.dashurl').'/teachers']
		]);
		$theme->setTitle(Setting::get('system.adminsitename').' - Assessments');
		$theme->setType('Assessments');
        $theme->asset()->container('datatable')->writeScript('inline-script','$(document).ready(function(){
    $(\'.datatable\').dataTable({
        "sDom": "<\'row\'<\'col-xs-5 col-sm-5 col-md-5\'l><\'col-xs-5 col-sm-5 col-md-5\'f>r>t<\'row\'<\'col-xs-5 col-sm-5 col-md-5\'i><\'col-xs-5 col-sm-5 col-md-5\'p>>",
            "oLanguage": {
            "sLengthMenu": "_MENU_ '.Session::get('records','records').'per page"
            },
            "sPagination":"bootstrap"
       
    });
});        ');
		$theme->asset()->writeStyle('inline-style','
		        @media only screen and (max-width: 760px),(min-device-width: 768px) and (max-device-width: 1024px)  
		        { 
		            td:nth-of-type(1):before { content: "#ID :- "; }
		            td:nth-of-type(2):before { content: "First Name :- "; }
		            td:nth-of-type(3):before { content: "Last Name :- "; }
		            td:nth-of-type(4):before { content: "Date of Birth :- "; }
		            td:nth-of-type(5):before { content: "Status :- "; }
		            td:nth-of-type(6):before { content: "Actions :- "; }
		        }');

		Session::put('records','Teachers');
		return $theme->scope('teachers', $view)->render();

	}

	public function assessments(){
		$theme = Theme::uses('dashboard')->layout('default');
        $view = array(
            'name' => 'Dashboard Assessments'
        );
        $theme->breadcrumb()->add([
            ['label'=>'Dashboard','url'=>Setting::get('system.dashurl')],
            ['label'=>'Assessments','url'=>Setting::get('system.dashurl').'/assessments']
        ]);
        $theme->setTitle(Setting::get('system.adminsitename').' - Assessments');
        $theme->setType('Assessments');
        $theme->asset()->container('datatable')->writeScript('inline-script','$(document).ready(function(){
    $(\'.datatable\').dataTable({
        "sDom": "<\'row\'<\'col-xs-5 col-sm-5 col-md-5\'l><\'col-xs-5 col-sm-5 col-md-5\'f>r>t<\'row\'<\'col-xs-5 col-sm-5 col-md-5\'i><\'col-xs-5 col-sm-5 col-md-5\'p>>",
            "oLanguage": {
            "sLengthMenu": "_MENU_ '.Session::get('records','records').'per page"
            },
            "sPagination":"bootstrap"
       
    });
});        ');
        $theme->asset()->writeStyle('inline-style','
                @media only screen and (max-width: 760px),(min-device-width: 768px) and (max-device-width: 1024px)  
                { 
                    td:nth-of-type(1):before { content: "#ID :- "; }
                    td:nth-of-type(2):before { content: "Name :- "; }
                    td:nth-of-type(3):before { content: "Related Tutorial :- "; }
                    td:nth-of-type(4):before { content: "Subject :- "; }
                    td:nth-of-type(5):before { content: "Grade :- "; }
                    td:nth-of-type(6):before { content: "Submitted To :- "; }
                    td:nth-of-type(7):before { content: "Submission Date :- "; }
                    td:nth-of-type(8):before { content: "Submitted By :- "; }
                }');

        Session::put('records','Assessments');
        return $theme->scope('assessments', $view)->render();
	}

	public function users(){
		$theme = Theme::uses('dashboard')->layout('default');

        $view = array(
            'name' => 'Dashboard Users'
        );
        $theme->breadcrumb()->add([
            ['label'=>'Dashboard','url'=>Setting::get('system.dashurl')],
            ['label'=>'Users','url'=>Setting::get('system.dashurl').'/users']
        ]);
        $theme->appendTitle(' - Users');
        $theme->asset()->container('datatable')->writeScript('inline-script','$(document).ready(function(){
    $(\'.datatable\').dataTable({
        "sDom": "<\'row\'<\'col-xs-5 col-sm-5 col-md-5\'l><\'col-xs-5 col-sm-5 col-md-5\'f>r>t<\'row\'<\'col-xs-5 col-sm-5 col-md-5\'i><\'col-xs-5 col-sm-5 col-md-5\'p>>",
            "oLanguage": {
            "sLengthMenu": "_MENU_ '.Session::get('records','records').'per page"
            },
            "sPagination":"bootstrap"
       
    });
});        ');
        $theme->asset()->writeStyle('inline-style','
                @media only screen and (max-width: 760px),(min-device-width: 768px) and (max-device-width: 1024px)  
                { 
                    td:nth-of-type(1):before { content: "#ID :- "; }
                    td:nth-of-type(2):before { content: "First Name :- "; }
                    td:nth-of-type(3):before { content: "Last Name :- "; }
                    td:nth-of-type(4):before { content: "Joined Date :- "; }
                    td:nth-of-type(5):before { content: "Last Login :- "; }
                    td:nth-of-type(6):before { content: "Activation:- "; }
                    td:nth-of-type(7):before { content: "Actions :- "; }
                }');
        Session::put('records','Users');
        return $theme->scope('users', $view)->render();
	}
	public function settings(){
		
        $theme = Theme::uses('dashboard')->layout('default');

        $view = array(
            'name' => 'Dashboard Settings'
        );
        $theme->breadcrumb()->add([
            ['label'=>'Dashboard','url'=>Setting::get('system.dashurl')],
            ['label'=>'Settings','url'=>Setting::get('system.dashurl').'/settings']
        ]);
        $theme->appendTitle(' - Settings');
        $theme->asset()->container('datatable')->writeScript('inline-script','$(document).ready(function(){
    $(\'.datatable\').dataTable({
        "sDom": "<\'row\'<\'col-xs-5 col-sm-5 col-md-5\'l><\'col-xs-5 col-sm-5 col-md-5\'f>r>t<\'row\'<\'col-xs-5 col-sm-5 col-md-5\'i><\'col-xs-5 col-sm-5 col-md-5\'p>>",
            "oLanguage": {
            "sLengthMenu": "_MENU_ '.Session::get('records','records').'per page"
            },
            "sPagination":"bootstrap"
       
    });
});        ');
        // Session::flush('activedash');
        return $theme->scope('settings', $view)->render();

	}

	public function exams(){
		$theme = Theme::uses('dashboard')->layout('default');
        $view = array(
            'name' => 'Dashboard Assessments'
        );
        $theme->breadcrumb()->add([
            ['label'=>'Dashboard','url'=>Setting::get('system.dashurl')],
            ['label'=>'Exams','url'=>Setting::get('system.dashurl').'/exams']
        ]);
        $theme->setTitle(Setting::get('system.adminsitename').' - Exams');
        $theme->setType('Exams');$theme->asset()->container('datatable')->writeScript('inline-script','$(document).ready(function(){
    $(\'.datatable\').dataTable({
        "sDom": "<\'row\'<\'col-xs-5 col-sm-5 col-md-5\'l><\'col-xs-5 col-sm-5 col-md-5\'f>r>t<\'row\'<\'col-xs-5 col-sm-5 col-md-5\'i><\'col-xs-5 col-sm-5 col-md-5\'p>>",
            "oLanguage": {
            "sLengthMenu": "_MENU_ '.Session::get('records','records').'per page"
            },
            "sPagination":"bootstrap"
       
    });
});        ');
        $theme->asset()->writeStyle('inline-style','
                @media only screen and (max-width: 760px),(min-device-width: 768px) and (max-device-width: 1024px)  
                { 
                    td:nth-of-type(1):before { content: "#ID :- "; }
                    td:nth-of-type(2):before { content: "Title :- "; }
                    td:nth-of-type(3):before { content: "Subject :- "; }
                    td:nth-of-type(4):before { content: "Grade :- "; }
                    td:nth-of-type(5):before { content: "Actions :- "; }
                }');

        Session::put('records','Exams');
        return $theme->scope('exams', $view)->render();
	}
	public function tutorials(){
		 $theme = Theme::uses('dashboard')->layout('default');
        $view = array(
            'name' => 'Dashboard Tutorials'
        );
        $theme->breadcrumb()->add([
            ['label'=>'Dashboard','url'=>Setting::get('system.dashurl')],
            ['label'=>'Tutorials','url'=>Setting::get('system.dashurl').'/tutorials']
        ]);
        $theme->setTitle(Setting::get('system.adminsitename').' Tutorials');
        $theme->setType('Tutorials');$theme->asset()->container('datatable')->writeScript('inline-script','$(document).ready(function(){
    $(\'.datatable\').dataTable({
        "sDom": "<\'row\'<\'col-xs-5 col-sm-5 col-md-5\'l><\'col-xs-5 col-sm-5 col-md-5\'f>r>t<\'row\'<\'col-xs-5 col-sm-5 col-md-5\'i><\'col-xs-5 col-sm-5 col-md-5\'p>>",
            "oLanguage": {
            "sLengthMenu": "_MENU_ '.Session::get('records','records').'per page"
            },
            "sPagination":"bootstrap"
       
    });
});        ');
        $theme->asset()->writeStyle('inline-style','
                @media only screen and (max-width: 760px),(min-device-width: 768px) and (max-device-width: 1024px)  
                { 
                    td:nth-of-type(1):before { content: "#ID :- "; }
                    td:nth-of-type(2):before { content: "Title :- "; }
                    td:nth-of-type(3):before { content: "Subject :- "; }
                    td:nth-of-type(4):before { content: "Grade :- "; }
                    td:nth-of-type(5):before { content: "Created Date :- "; }
                    td:nth-of-type(6):before { content: "Modified Date :- "; }
                    td:nth-of-type(7):before { content: "Created By :- "; }
                    td:nth-of-type(8):before { content: "Published :- "; }
                    td:nth-of-type(9):before { content: "Actions :- "; }
                }');

        Session::put('records','Tutorials');
        return $theme->scope('tutorials', $view)->render();
	}
	public function students(){
		$theme = Theme::uses('dashboard')->layout('default');
        $view = array(
            'name' => 'Dashboard Students'
        );
        $theme->breadcrumb()->add([
            ['label'=>'Dashboard','url'=>Setting::get('system.dashurl')],
            ['label'=>'Tutorials','url'=>Setting::get('system.dashurl').'/students']
        ]);
        $theme->setTitle(Setting::get('system.adminsitename').' Students');
        $theme->setType('Students');
        $theme->asset()->container('datatable')->writeScript('inline-script','$(document).ready(function(){
    $(\'.datatable\').dataTable({
        "sDom": "<\'row\'<\'col-xs-5 col-sm-5 col-md-5\'l><\'col-xs-5 col-sm-5 col-md-5\'f>r>t<\'row\'<\'col-xs-5 col-sm-5 col-md-5\'i><\'col-xs-5 col-sm-5 col-md-5\'p>>",
            "oLanguage": {
            "sLengthMenu": "_MENU_ '.Session::get('records','records').'per page"
            },
            "sPagination":"bootstrap"
       
    });
});        ');
        $theme->asset()->writeStyle('inline-style','
                @media only screen and (max-width: 760px),(min-device-width: 768px) and (max-device-width: 1024px)  
                { 
                    td:nth-of-type(1):before { content: "#ID :- "; }
                    td:nth-of-type(2):before { content: "Title :- "; }
                    td:nth-of-type(3):before { content: "Subject :- "; }
                    td:nth-of-type(4):before { content: "Grade :- "; }
                    td:nth-of-type(5):before { content: "Created Date :- "; }
                    td:nth-of-type(6):before { content: "Modified Date :- "; }
                    td:nth-of-type(7):before { content: "Created By :- "; }
                    td:nth-of-type(8):before { content: "Published :- "; }
                    td:nth-of-type(9):before { content: "Actions :- "; }
                }');

        Session::put('records','Students');
        return $theme->scope('students', $view)->render();
	}
}
