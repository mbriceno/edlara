<?php

class PresentationController extends BaseController
{

	public function view($dash,$tid){
		$theme = Theme::uses('dashboard')->layout('default');

        $view = array(
            'name' => 'Dashboard Home',
            'tutorialid'=>$tid,
        );
        $theme->breadcrumb()->add([
            ['label'=>'Dashboard','url'=>Setting::get('system.dashurl')]
        ]);
        $theme->appendTitle(' - Dashboard');
        
        $theme->asset()->add('jquery','/js/jquery-2.0.2.min.js');
        $theme->asset()->add('ckeditor','/js/ckeditor/ckeditor.js');
        $theme->asset()->add('ckeditor-jquery','/js/ckeditor/adapters/jquery.js');
        return $theme->scope('tutorial.presentation', $view)->render();
	}
	public function create($dash,$tid){
		$title = Input::get('title',rand(5, 250000));
        if($title ==''){
            $title=rand(5, 250000);
        }
		$presentation = Input::get('presentationc');
        if(!is_dir(app_path().'/attachments/tutorial-'.$tid.'/')){
            File::makeDirectory(app_path().'/attachments/tutorial-'.$tid.'/');
        }
		file_put_contents(app_path().'/attachments/tutorial-'.$tid.'/'.$title.'.html', $presentation);
		return Redirect::to('/tutorial/edit/'.$tid);
	}
}
