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
            self::newtutorial($id);
        }
        else {
            self::updatetutorial($id);
        }
    }

    private function newtutorial($id){
        $validator = Validator::make(Input::all(),
                            array('id'=>'required',
                                  'title'=>'required|min:3|max:256|alpha',
                                  'description'=> 'max:1024|alpha',
                                  'content'=>'required',
                                  'attachment'=>'mime:jpeg,png,bmp,pdf|size:10240'
                                ));
        $messages = array(
            'required' => 'The :attribute field is required.',
        );
        if ($validator->fails())
        {           
            Input::flash();
            return Redirect::to('tutorial/edit/'.$id)->withErrors($validator);
        } 
        else
        {              
                return Redirect::to('/');
        }
        return;
    }
    private function updatetutorial($id){

        return;
    }


}