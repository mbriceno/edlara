<?php

class Subject extends Eloquent {
	//Guarding the subjectcode . so no one cant change it after created
    protected $guarded = array('id','subjectid');
    //making softdelete true. to enable trashing.
    protected $softDelete = true;
    public static $rules = array();
}