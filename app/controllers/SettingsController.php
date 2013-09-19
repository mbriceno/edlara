<?php


class SettingsController extends BaseController{
	public function update(){
		 $validator = Validator::make(Input::all(),array(
		 	 'schoolname'=>'required|alpha|min:3|max:256'
		 	,'schoolnameabbr'=>'required|alpha|min:2|max:10'
		 	,'schooladdress'=>'required|min:4|max:512'
		 	,'logo'=>'required'
		 	,'adminsitename'=>'required|alpha|min:2|max:256'));
		 if($validator->fails()){
		 	Input::flash();
			return Redirect::to('/settings');
		 }
		 Config::set('schoolname',Input::get('schoolname'));
		 Config::set('schoolnameabbr',Input::get('schoolnameabbr'));
		 Config::set('schooladdress',Input::get('schooladdress'));
		 Config::set('logo',Input::get('logo'));
		 Config::set('adminsitename',Input::get('adminsitename'));
		return Redirect::to('/settings');
	}
}