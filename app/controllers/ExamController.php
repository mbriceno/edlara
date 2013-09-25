<?php

class ExamController extends BaseController
{

	public function validateStudent($id,$hash){
		return;
	}
	public function viewExam($id,$tid){
		return;
	}
	public function doneExam($id,$tid){
		return;
	}
	public function markExam($id,$tid,$aid){
		return;
	}
	public function doExam($id,$tid){
		return;
	}
	public function createExam(){
        $rules = array();
        $rules['questioncount'] = 'required|integer|min:5|max:100';
        $rules['title']='required|min:6|max:1024';
        $messages = array();
        $questioncount = Input::get('questioncount');

        for($qc = 1;$qc <=$questioncount; $qc++){
            $rules['question_'.$qc] = 'required|min:4|max:1024';
            $rules['checkbox_'.$qc] = 'required';
            $rules['checkbox_'.$qc.'_1']='required|min:1|max:1024';
            $rules['checkbox_'.$qc.'_2']='required|min:1|max:1024';
            $rules['checkbox_'.$qc.'_3']='required|min:1|max:1024';
            $rules['checkbox_'.$qc.'_4']='required|min:1|max:1024';
        }
        for($qc = 1;$qc <=$questioncount; $qc++){
            $messages['question_'.$qc.'.required'] = 'Question '.$qc." is required";
            $messages['checkbox_'.$qc.'_1'.'.required']='The value for '.$qc.' Checkbox 1 is missing.';
            $messages['checkbox_'.$qc.'_2'.'.required']='The value for '.$qc.' Checkbox 2 is missing.';
            $messages['checkbox_'.$qc.'_3'.'.required']='The value for '.$qc.' Checkbox 3 is missing.';
            $messages['checkbox_'.$qc.'_4'.'.required']='The value for '.$qc.' Checkbox 4 is missing.';
        }
        $validator = Validator::make(Input::all(),$rules,$messages);
        if($validator->fails()){
            Input::flash();
            // return Redirect::to('/exam/edit/0')->withErrors($validator)->withInput();
            return View::make('dashboard.exams.create')->with('errors',$validator->getMessageBag())->with('id',0);
        }


        $input = Input::all();

        $exam = New Exams;
        $exam->title = Input::get('title');
        $exam->subjectid = Input::get('subject');
        $exam->createdby = Sentry::getUser()->id;

        $exam->save();

        $newexam = DB::table('exams')->orderby('id','desc')->first();
        $data= array();
        $data['id']=12;
        $data['title'] ="Test";
        $data['subjectid']=4;


        $data = array();
        for($question =1;$question <= $questioncount;){
        	// $data['questiondata']['question'][$question]['answers'] = 'answers';
            // echo $input['question_'.$question].'<br>';
            // var_dump($input['checkbox_'.$question]);
            // echo "'<br>';";
        	$data['questiondata']['questions'][$question] = $input['question_'.$question];
            for($checkbox=1;$checkbox <=4;$checkbox++){
            	$data['questiondata']['question'][$question]['checkboxdata'][$checkbox] = $input['checkbox_'.$question.'_'.$checkbox];
            	// echo $input['checkbox_'.$question.'_'.$checkbox].'<br>';
            }
            // var_dump($input['checkbox_'.$question]);
            if(is_array($input['checkbox_'.$question])){
                if(isset($input['checkbox_'.$question][0]) && $input['checkbox_'.$question][0] > 0 && $input['checkbox_'.$question][0] <= 4)
                $data['questiondata']['question'][$question]['answers'][0]=$input['checkbox_'.$question][0];
                if(isset($input['checkbox_'.$question][1]))
                $data['questiondata']['question'][$question]['answers'][1]=$input['checkbox_'.$question][1];
                if(isset($input['checkbox_'.$question][2]))
                $data['questiondata']['question'][$question]['answers'][2]=$input['checkbox_'.$question][2];
                if(isset($input['checkbox_'.$question][3]))
                $data['questiondata']['question'][$question]['answers'][3]=$input['checkbox_'.$question][3];
                if(isset($input['checkbox_'.$question][4]))
                $data['questiondata']['question'][$question]['answers'][4]=$input['checkbox_'.$question][4];
            }            
            else {
            	$data['questiondata']['question'][$question]['answers'] = $input['checkbox_'.$question][0];
            }
            $question++;
        }
        // var_dump($data);
        $encoded = json_encode($data);
        echo $encoded;
        $encryptedpath = Crypt::encrypt('questiondata');
        File::makeDirectory(app_path().'/files/exam-'.$newexam->id);
        file_put_contents(app_path().'/files/exam-'.$newexam->id.'/'.$encryptedpath.'.json',$encoded);
        $newexame = Exams::find($newexam->id);
        $newexame->hash = $encryptedpath;
        $newexame->totalquestions = $question-1;
        $newexame->save();
	}
	public function updateExam($id){
        $rules = array();
        $rules['questioncount'] = 'required|integer|min:5|max:100';
        $rules['title']='required|min:6|max:1024';
        $messages = array();
        $questioncount = Input::get('questioncount');
        var_dump($questioncount);
        for($qc = 1;$qc <=$questioncount; $qc++){
            $rules['question_'.$qc] = 'required|min:4|max:1024';
            $rules['checkbox_'.$qc] = 'required';
            $rules['checkbox_'.$qc.'_1']='required|min:1|max:1024';
            $rules['checkbox_'.$qc.'_2']='required|min:1|max:1024';
            $rules['checkbox_'.$qc.'_3']='required|min:1|max:1024';
            $rules['checkbox_'.$qc.'_4']='required|min:1|max:1024';
        }
        for($qc = 1;$qc <=$questioncount; $qc++){
            $messages['question_'.$qc.'.required'] = 'Question '.$qc." is required";
            $messages['checkbox_'.$qc.'_1'.'.required']='The value for '.$qc.' Checkbox 1 is missing.';
            $messages['checkbox_'.$qc.'_2'.'.required']='The value for '.$qc.' Checkbox 2 is missing.';
            $messages['checkbox_'.$qc.'_3'.'.required']='The value for '.$qc.' Checkbox 3 is missing.';
            $messages['checkbox_'.$qc.'_4'.'.required']='The value for '.$qc.' Checkbox 4 is missing.';
        }
        $validator = Validator::make(Input::all(),$rules,$messages);
        if($validator->fails()){
            Input::flash();
            // return Redirect::to('/exam/edit/0')->withErrors($validator)->withInput();
            return View::make('dashboard.exams.create')->with('errors',$validator->getMessageBag())->with('id',0);
        }


        $input = Input::all();

        $exam = Exams::find($id);
        $exam->title = Input::get('title');
        $exam->subjectid = Input::get('subject');
        $exam->createdby = Sentry::getUser()->id;

        $data= array();


        $data = array();
        for($question =1;$question <= $questioncount;){
            // $data['questiondata']['question'][$question]['answers'] = 'answers';
            // echo $input['question_'.$question].'<br>';
            // var_dump($input['checkbox_'.$question]);
            // echo "'<br>';";
            $data['questiondata']['questions'][$question] = $input['question_'.$question];
            for($checkbox=1;$checkbox <=4;$checkbox++){
                $data['questiondata']['question'][$question]['checkboxdata'][$checkbox] = $input['checkbox_'.$question.'_'.$checkbox];
                // echo $input['checkbox_'.$question.'_'.$checkbox].'<br>';
            }
            // var_dump($input['checkbox_'.$question]);
            if(is_array($input['checkbox_'.$question])){
                if(isset($input['checkbox_'.$question][0]) && $input['checkbox_'.$question][0] > 0 && $input['checkbox_'.$question][0] <= 4)
                $data['questiondata']['question'][$question]['answers'][0]=$input['checkbox_'.$question][0];
                if(isset($input['checkbox_'.$question][1]))
                $data['questiondata']['question'][$question]['answers'][1]=$input['checkbox_'.$question][1];
                if(isset($input['checkbox_'.$question][2]))
                $data['questiondata']['question'][$question]['answers'][2]=$input['checkbox_'.$question][2];
                if(isset($input['checkbox_'.$question][3]))
                $data['questiondata']['question'][$question]['answers'][3]=$input['checkbox_'.$question][3];
                if(isset($input['checkbox_'.$question][4]))
                $data['questiondata']['question'][$question]['answers'][4]=$input['checkbox_'.$question][4];
            }            
            else {
                $data['questiondata']['question'][$question]['answers'] = $input['checkbox_'.$question][0];
            }
            $question++;
        }
        // var_dump($data);
        $encoded = json_encode($data);
        echo $encoded;
        $encryptedpath = Crypt::encrypt('questiondata');
        file_put_contents(app_path().'/files/exam-'.$exam->id.'/'.$encryptedpath.'.json',$encoded);
        
        $exam->hash = $encryptedpath;
        $exam->totalquestions = $question;
        $exam->save();
		return $encoded;
	}
	private function prepareExam(){
		return;
	}
}
