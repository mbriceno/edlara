<?php

class TutorialsController extends BaseController {
    public function index($id){
        if($id == 0){
            return View::make('dashboard.tutorials.create')->with('id',$id);
        }
        else{
            return View::make('dashboard.tutorials.edit')->with('id',$id);
        }
    }

    public function update($id){
        if($id == 0){
            $validator = Validator::make(Input::all(),
                            array('title'=>'required|min:3|max:256',
                                  'description'=> 'max:1024',
                                  'tutorial'=>'required',
                                  'attachment'=>'mimes:jpeg,JPEG,jpg,JPG,PNG,png,bmp,BMP,gif,GIF,pdf,PDF'
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
                                  'tutorial'=>'required',
                                  'attachment'=>'mimes:jpeg,JPEG,jpg,JPG,PNG,png,bmp,BMP,gif,GIF,pdf,PDF'
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
                return View::make('dashboard.tutorials.view')->with('id',$id);
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
    public function attachmentHandler($id,$attachmentname,$mode){
        $tutorial = Tutorials::find($id);
        switch ($mode) {
            case 'delete':
                self::deleteAttachment($id,$attachmentname);
                return Redirect::to('/tutorial/edit/'.$id.'');
            case 'download':            
                return Response::download(app_path().'/attachments/tutorial-'.$id.'/'.$attachmentname);
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
        if(Input::get('published') == 'on'){
        $tutorial->published    =   1;
        }
        else
        {
        $tutorial->published    =   0;
        }
        Log::error(Input::get('published'));
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
            return Redirect::to(URL::previous());
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