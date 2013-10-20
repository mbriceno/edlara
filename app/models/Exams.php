<?php

class Exams extends Eloquent
{
 	protected $guarded = array('id');
    protected $table = "exams";
    protected $hidden = ["hash"];
    public static $rules = array();
	

}
