<?php

class Student extends Eloquent {
    protected $guarded = array();

    public static $rules = array();
    
    //Setting UserID as primary key
    protected $primaryKey="user_id";    
    
}