<?php

class ExamController extends BaseController
{

	public function validateStudent($id,$eid,$hash){
        $tutorial =  Tutorials::findOrFail($id);
                        $sessionvar = "tutorial-".$tutorial->id;
                        $senc = Session::get($sessionvar);
                        try
                        {
                        $decrypted = Crypt::decrypt($hash);
                        }
                        catch(Exception $e){
                            //Catch Exception
                        }

                        if($senc == $hash && $decrypted == $sessionvar){
                            Session::put('examid',$eid);
                            Session::put('tutorialid',$id);
                            return Redirect::to('/tutorial-'.$id.'/exam');
                        }
                        else
                        {
                            return "Unauthorised Access";
                        }
		return;
	}
	public function viewExam($tid){
		return View::make('site.exam.do')->nest('header','main.header')->with('id',$tid);
	}
	public function doneExam($id,$tid){
		return;
	}
	public function markExam($aid,$eid){
        $assessment = Assessments::find($aid);
        $exam       = Exams::find($eid);
        $tutorial   = Tutorials::find($assessment->tutorialid);
        //APPLICATION LOGIC TO BE IMPLEMENTED
		return Redirect::to(URL::previous());
	}
	public function doExam($tid,$eid,$hash){

        $userid = Sentry::getUser()->id;
        $decryptedhash = Crypt::decrypt($hash);
        if($decryptedhash == 'tutorial-'.$tid){
            Session::put('halt_tutorial_except',0);
            Session::put('examid',0);
            $validator = Validator::make(Input::all(),[
                'related_tutorial'=>"required|unique:assessments,tutorialid,NULL,id,studentid,".$userid,
                'submitted_to'=>'required|exists:users,id',
                'subject'=>'required|exists:subjects,id',
                ]);
            if($validator->fails()){
                return "EXAM PAPER HAS BEEN MODIFIED or SUBMITTED AGAIN.Click here to go to <a href='".Setting::get('app.url')."'>HOME PAGE</a>. ANSWERS NOT ACCEPTED.";
            }
            $tutorial = Tutorials::findOrFail($tid);
            $exam = Exams::find($eid);
            $data = array();

            $assessment = new Assessments;
            $assessment->title = $tutorial->name.' Exam For '.$exam->title;
            $assessment->assessmenttype = "exam";
            $assessment->tutorialid = $tid;
            $assessment->studentid = Sentry::getUser()->id;
            $assessment->teacherid = $tutorial->createdby;
            $assessment->subjectid = $tutorial->subjectid;
            $assessment->save();

            $questions = $exam->totalquestions - 1;
            $input = Input::all();
            for($qc=1;$qc <= $questions;){
                Session::put('checkboxcount',1);
                $data['answers']['checkboxdata'][$qc][1]='';
                $data['answers']['checkboxdata'][$qc][2]='';
                $data['answers']['checkboxdata'][$qc][3]='';
                $data['answers']['checkboxdata'][$qc][4]='';
                foreach($input['checkbox_'.$qc] as $answer){
                    // var_dump($answer);
                    $qu = Session::get('checkboxcount',0);                    
                    $data['answers']['checkboxdata'][$qc][$qu]=$answer;
                    Session::put('checkboxcount',++$qu);
                }
                $qc++;
            }

            $answerdata = json_encode($data);
            $nassessment = DB::table('assessments')->orderby('id','desc')->first();
            $encryptedpath = 'questiondata';
            // var_dump(app_path().'/files/assessment/'.$nassessment->id.'/exam-'.$tid.'/');
            File::makeDirectory(app_path().'/files/assessment/'.$nassessment->id.'/exam-'.$eid ,0777,true);
            file_put_contents(app_path().'/files/assessment/'.$nassessment->id.'/exam-'.$exam->id.'/'.$encryptedpath.'.json',$answerdata);
            return Redirect::to('/');
            // var_dump($decryptedhash);

        }
        else {
            return "ACTION NOT AUTHORISED";
        }
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
