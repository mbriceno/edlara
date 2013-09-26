<?php


class SettingsController extends BaseController{
	function __construct(){ 
		$this->beforeFilter('csrf', array('on' => 'update'));
      	$this->beforeFilter('admin', array('on' => 'update'));
	}
	public function update(){
		 $validator = Validator::make(Input::all(),array(
		 	 'schoolname'=>'required|min:3|max:256'
		 	,'schoolnameabbr'=>'required|alpha|min:2|max:10'
		 	,'schooladdress'=>'required|min:4|max:512'
		 	,'logo'=>'required'
		 	,'adminsitename'=>'required|min:2|max:256',
		 	'systemurl'=>'required|url|active_url',
		 	'url'=>'url|required'));
		 if($validator->fails()){
		 	Input::flash();
			return Redirect::to('/settings')->withErrors($validator);
		 }
		 $schoolname = Input::get('schoolname');
		 Setting::set('system.schoolname',$schoolname);
		 Setting::set('system.schoolnameabbr',Input::get('schoolnameabbr'));
		 Setting::set('system.schooladdress',Input::get('schooladdress'));
		 Setting::set('system.logo_src',Input::get('logo'));
		 Setting::set('system.adminsitename',Input::get('adminsitename'));
		 Setting::set('app.url',Input::get('url'));
		 Setting::set('app.captcha',Input::get('captcha'));
		 Setting::set('system.dashurl',Input::get('systemurl'));
		return View::make('dashboard.settings');
	}
}