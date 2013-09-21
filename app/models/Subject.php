<?php

class Subject extends Eloquent {
	
    protected $guarded = array('id');
    //making softdelete true. to enable trashing.
    protected $softDelete = true;
    public static $rules = array();
}