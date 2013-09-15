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
                            array('title'=>'required|min:3|max:256|alpha',
                                  'description'=> 'max:1024|alpha',
                                  'tutorial'=>'required',
                                  'published'=>'required',
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
                    $newid = self::createtutorial($id);
                    return Redirect::to('/tutorial/edit/'.$newid.''); 
            }
        }
        else {
            $validator = Validator::make(Input::all(),
                            array('title'=>'required|min:3|max:256|alpha',
                                  'description'=> 'required|max:1024|alpha',
                                  'tutorial'=>'required',
                                  'published'=>'required',
                                  'attachment'=>'mimes:jpeg,JPEG,jpg,JPG,PNG,png,bmp,BMP,gif,GIF,pdf,PDF'
                                ));
            $messages = array(
                'required' => 'The :attribute field is required.',
            );
            if ($validator->fails())
            {         
                Input::flash();
                Log::error(Input::get('published'));
                return Redirect::to('/tutorial/edit/'.$id.'')->withErrors($validator)->with('input',Input::all());
            } 
            else
            {       
                self::updatetutorial($id);
                Log::error(Input::get('published'));
                return Redirect::to('/tutorial/edit/'.$id.''); 
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
        }
    }
    private function updatetutorial($id){
        $tutorial = Tutorials::find($id);
        $tutorial->name         =   Input::get('title') ;
        $tutorial->description  =   Input::get('description');
        $tutorial->content      =   Input::get('tutorial');
        if(Input::get('published') == 'on'){
            $pub = 1;
        }
        else
        {
            $pub =0;
        }
        $tutorial->published    =   $pub;
        if(Input::hasFile('attachment')){
                    $name = Input::file('attachment')->getClientOriginalName();
                   Input::file('attachment')->move(app_path().'/attachments/tutorial-'.$id.'/',$name);  
        }
        $tutorial->save();
    }

    private function createtutorial(){
        $tutorial = new Tutorials;
        $tutorial->name         =   Input::get('title');
        $tutorial->description  =   Input::get('description');
        $tutorial->content      =   Input::get('tutorial');

        if(Input::hasFile('attachment')){
                    $name = Input::file('attachment')->getClientOriginalName();
                   Input::file('attachment')->move(app_path().'/attachments/tutorial-'.$id.'/',$name);                    
        }
        $tutorial->save();
        $tutorial = DB::table('tutorials')->orderby('id','desc')->first();      
        $newid = $tutorial->id;
        return $newid;
    }


}