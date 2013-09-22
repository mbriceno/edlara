<?php

class Assessments extends Eloquent {
    protected $guarded = array('id','teacherid','studentid','subjectid','tutorialid');

    public static $rules = array();
}