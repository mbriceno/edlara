<?php

class TutorialsController extends BaseController {
    public function index($id){
        if($id == 0){

            $theme = Theme::uses('dashboard')->layout('default');

            $view = array(
                'name' => 'Dashboard Tutorial',
                'id'=>$id
            );
            $theme->breadcrumb()->add([
                ['label'=>'Dashboard','url'=>Setting::get('system.dashurl')],
                ['label'=>'Tutorials','url'=>Setting::get('system.dashurl').'/tutorials'],
                ['label'=>$id,'url'=>Setting::get('system.dashurl').'/tutorial/0/edit']
            ]);
            $theme->appendTitle(' - New Tutorial');
            $theme->asset()->add('ckeditor','/js/ckeditor/ckeditor.js');
            $theme->asset()->container('footer')->add('boostrap-switch-js','/lib/bswitch/js/bootstrap-switch.min.js');
            $theme->asset()->add('bootstrap-switch', '/lib/bswitch/css/bootstrap-switch.css');
            $theme->asset()->add('bootstrap-switch-fonts', '/lib/bswitch/css/flat-ui-fonts.css',array('bootstrap-switch'));
            return $theme->scope('tutorial.create', $view)->render();
        }
        else{
            $theme = Theme::uses('dashboard')->layout('default');

            $view = array(
                'name' => 'Dashboard Tutorial',
                'id'=>$id
            );
            $theme->breadcrumb()->add([
                ['label'=>'Dashboard','url'=>Setting::get('system.dashurl')],
                ['label'=>'Tutorials','url'=>Setting::get('system.dashurl').'/tutorials'],
                ['label'=>$id,'url'=>Setting::get('system.dashurl').'/tutorial/'.$id.'/edit']
            ]);
            $theme->appendTitle(' - Edit Tutorial');
            $theme->asset()->container('datatable')->writeScript('inline-script','$(document).ready(function(){
    $(\'#attachments\').dataTable({
        "sDom": "<\'row\'<\'col-xs-5 col-sm-5 col-md-5\'l><\'col-xs-5 col-sm-5 col-md-5\'f>r>t<\'row\'<\'col-xs-5 col-sm-5 col-md-5\'i><\'col-xs-5 col-sm-5 col-md-5\'p>>",
            "oLanguage": {
            "sLengthMenu": "_MENU_ '.' Attachments per page"
            },
            "sPagination":"bootstrap"
       
    });
});');
            if(URL::previous()==Setting::get('system.dashurl').'/tutorial/edit/'.$id.'/presentation'){
                $theme->asset()->container('footer')->writeScript('inline-script',
                    ' $(\'html, body\').animate({
        scrollTop: $("#attachments").offset().top
    }, 2000);'
                    );
            }
            $theme->asset()->add('ckeditor','/js/ckeditor/ckeditor.js');
            $theme->asset()->container('footer')->add('boostrap-switch-js','/lib/bswitch/js/bootstrap-switch.min.js');
            $theme->asset()->add('bootstrap-switch', '/lib/bswitch/css/bootstrap-switch.css');
            $theme->asset()->add('bootstrap-switch-fonts', '/lib/bswitch/css/flat-ui-fonts.css',array('bootstrap-switch'));
            return $theme->scope('tutorial.edit', $view)->render();
        }
    }

    public function update($id){
        if($id == 0){
            $validator = Validator::make(Input::all(),
                            array('title'=>'required|min:3|max:256',
                                  'description'=> 'max:1024',
                                  'tutorial'=>'required'
                                ));
            $messages = array(
                'required' => 'The :attribute field is required.',
            );
            if ($validator->fails())
            {           
                    Input::flash();
                    return Redirect::to('tutorial/edit/'.$id)->withErrors($validator)->with('input',Input::get('published'));
            } 
            else
            {              

                if(Sentry::getUser()->inGroup(Sentry::findGroupByName('teachers'))){
                    $newid = self::createtutorial($id);
                    return Redirect::to('/tutorial/edit/'.$newid.''); 
                }
                Input::flash();
                // Log::error(Input::get('subject'));

                return Redirect::to('/tutorial/edit/'.$id.'')->withErrors($validator);
            }
        }
        else {
            $validator = Validator::make(Input::all(),
                            array('title'=>'required|min:3|max:256',
                                  'description'=> 'required|max:1024',
                                  'tutorial'=>'required'
                                ));
            $messages = array(
                'required' => 'The :attribute field is required.',
            );
            if ($validator->fails())
            {         
                Input::flash();
                // Log::error(Input::get('subject'));

                return Redirect::to('/tutorial/edit/'.$id.'')->withErrors($validator);
            } 
            else
            {       
                $tutorialcheck = Tutorials::find($id);
                if($tutorialcheck->createdby == Sentry::getUser()->id || Sentry::getUser()->inGroup(Sentry::findGroupByName('admin'))){
                    self::updatetutorial($id);
                    return Redirect::to('/tutorial/edit/'.$id.''); 
                }
                return Redirect::to(URL::previous());
                // Log::error(Input::get('subject'));
            }
        }
    }
    public function modder($mode,$id){
        $tutorial = Tutorials::find($id);
        switch ($mode) {
            case 'pub':
                $tutorial->published = 1;
                $tutorial->save();
                return Redirect::to('/tutorials/');
            case 'unpub':
                $tutorial->published = 0;
                $tutorial->save();
                return Redirect::to('/tutorials/');
            case 'view';
                $theme = Theme::uses('dashboard')->layout('default');
                $view = ['id'=>$id];
                $theme->breadcrumb()->add([
                ['label'=>'Dashboard','url'=>Setting::get('system.dashurl')],
                ['label'=>'Tutorials','url'=>Setting::get('system.dashurl').'/tutorials'],
                ['label'=>$id,'url'=>Setting::get('system.dashurl').'/tutorial/view/'.$id]
                ]);
                $theme->appendTitle(' - Tutorial View '.$id);
                $theme->asset()->container('footer')->add('boostrap-switch-js','/lib/bswitch/js/bootstrap-switch.min.js');
                $theme->asset()->add('bootstrap-switch', '/lib/bswitch/css/bootstrap-switch.css');
                $theme->asset()->add('bootstrap-switch-fonts', '/lib/bswitch/css/flat-ui-fonts.css',array('bootstrap-switch'));
                
                return $theme->scope('tutorial.view',$view)->render();
            case 'delete':
                $user = Sentry::getUser();
                // Find the Administrator group
                $admin = Sentry::findGroupByName('admin');

                // Check if the user is in the administrator group
                if ($user->inGroup($admin))
                {
                    $tutorial->delete();
                    return Redirect::to(URL::previous());
                }
                else
                {
                    // User is not in Administrator group
                    return View::make('access.notauthorised');
                }
        }
    }
    public function siteAttachmentHandler($id,$attachmentname){
        $tutorial = Tutorials::find($id);           
        
                return Response::download(app_path().'/attachments/tutorial-'.$id.'/'.$attachmentname);
    }
    public function siteAttachmentView($id,$attachmentname){
        $assessment = Tutorials::find($id);
        $attachpath = app_path().'/attachments/tutorial-'.$assessment->id.'/';
        $fixpath = $attachpath.$attachmentname;
        if(self::attachmentViewable($fixpath)==1){
            return View::make('site.attachment.tutorial')->nest('header','main.header')->with('attachment',$attachmentname)->with('id',$id)->with('type',pathinfo($fixpath,PATHINFO_EXTENSION));
        }
        elseif(self::attachmentViewable($fixpath)=='display'){
            return self::attachmentViewmaker($id,$attachmentname);
        }
        elseif(self::attachmentViewable($fixpath)==0) {
            return Response::download(app_path().'/attachments/tutorial-'.$id.'/'.$attachmentname);
        }   
    }
    private function attachmentViewmaker($id,$attachmentname){
        $tutorial = Tutorials::find($id);
        $attachpath = app_path().'/attachments/tutorial-'.$tutorial->id.'/';
        $fixpath = $attachpath.$attachmentname;
        if(self::attachmentViewable($fixpath)=='display'){
            $contents = File::get(app_path().'/attachments/tutorial-'.$id.'/'.$attachmentname);
            $response = Response::make($contents);
            $response->header('Content-Type','text/html');
            return $response;
        }
    }
    public function attachmentHandler($id,$attachmentname,$mode){
        $tutorial = Tutorials::find($id);
        switch ($mode) {
            case 'delete':
                self::deleteAttachment($id,$attachmentname);
                return Redirect::to('/tutorial/edit/'.$id.'');
            case 'download':            
                return Response::download(app_path().'/attachments/tutorial-'.$id.'/'.$attachmentname);
            break;
        }
    }
    private function attachmentViewable($filepath){
        //set a configuration value
        $allowed = array('jpeg','JPEG','jpg','JPG','PNG','png','pdf','PDF','GIF','gif');
        $display = ['html','HTML','htm'];
        $ext = pathinfo($filepath,PATHINFO_EXTENSION);
        // dd(in_array($ext, $allowed));
        if(in_array($ext,$allowed)){
            return 1;
        }
        elseif (in_array($ext,$display)){
            return 'display';
        }
        else {
            return 0;
        }
    }

    /*
     * Site
     */
    public function siteitemview($id){
        if (!Sentry::check()){
                //User is not Logged In        
                $currentURL=URL::current();
                $currentURL = substr($currentURL, 8);
                $cutLength = strrpos($currentURL, '.');
                $cutLength = $cutLength + 4;
                $currentURL = substr($currentURL,$cutLength);
                Session::put('url.intended',$currentURL);
                return View::make('site.tutoriallogin')->nest('header','main.header');
            }
        return View::make('site.tutorial')->with('id',$id)->nest('header','main.header');
    }
    public function sitelistview(){
        return View::make('site.tutorials')->nest('header','main.header');
    }



    /*
     * Private
     */
    private function updatetutorial($id){
        $tutorial = Tutorials::find($id);
        $tutorial->name         =   Input::get('title') ;
        $tutorial->description  =   Input::get('description');
        $tutorial->content      =   Input::get('tutorial');
        $examt = array();
        // Log::error(Input::get('examstruth'));
        if(Input::get('examstruth') == 'on'){
            $examt['true']=true;
            $checkexamssubmit = DB::select(DB::raw('SELECT COUNT(`id`) as `exists` FROM `exams` WHERE  `id` = '.Input::get('exams',0).''));
            // Log::warning($checkexamssubmit);
            if($checkexamssubmit){
                $examt['id']=Input::get('exams');
            }
            else {
                $examt['true']=false;
            }
        }
        else
        {
            $examt['true']=false;
        }
        $examt = serialize($examt);
        $tutorial->exams = $examt;
        unset($examt);
        if(Input::get('published') == 'on'){
        $tutorial->published    =   1;
        }
        else
        {
        $tutorial->published    =   0;
        }
        // Log::error(Input::get('examstruth'));
        // Log::error(Input::get('published'));
        if(Input::hasFile('attachment')){
            $files =  Input::file('attachment');
            foreach($files as $file){
                if($file){
                $name = $file->getClientOriginalName();
                $file->move(app_path().'/attachments/tutorial-'.$tutorial->id.'/',$name); 
                }
            }        
        }
        $tutorial->save();
    }

    private function createtutorial(){
        $user = Sentry::getUser();
        $userid = Sentry::getUser()->id;
        $teacher = Teacher::findOrFail($user->id);
        $ssubjects = $teacher->extra;
        $subjects = unserialize($ssubjects);
        $truth = self::subjectValidator($user->id,$subjects,Input::get('subject'));
        if($truth == 0){
            if(!Sentry::getUser()->inGroup(Sentry::findGroupByName('admin'))){                
                return Redirect::to(URL::previous());
            }
        }
        $tutorial = new Tutorials;
        $tutorial->name         =   Input::get('title');
        $tutorial->description  =   Input::get('description');
        $tutorial->content      =   Input::get('tutorial');
        $tutorial->createdby    =   Sentry::getUser()->id;
        $tutorial->subjectid    =   Input::get('subject');
        if(Input::get('published') == 'on'){
        $tutorial->published    =   1;
        }
        else
        {
        $tutorial->published    =   0;
        }
        $tutorial->save();
        $newtutorial = DB::table('tutorials')->orderby('id','desc')->first();  
        if(Input::hasFile('attachment')){
            $files =  Input::file('attachment');
            foreach($files as $file){
                if($file){
                $name = $file->getClientOriginalName();
                $file->move(app_path().'/attachments/tutorial-'.$newtutorial->id.'/',$name); 
                }
            }        
        }  
        $newid = $newtutorial->id;
        return $newid;
    }
    private function deleteAttachment($id,$attachment){
       File::delete(app_path().'/attachments/tutorial-'.$id.'/'.$attachment);
    }

    private function subjectValidator($id,$subjects,$subject){
        foreach($subjects as $s){
            if($s == $subject){
                return 1;
            }
        }
        return 0;
    }

}