<?php
use Purekid\Mongodm\Model;

class Results extends Model 
{

    static $collection = "resultset1";

    /** use specific config section **/
    public static $config = 'default';

    /** specific definition for attributes, not necessary! **/
    protected static $attrs = array(

         // 1 to 1 reference
        'book_fav' => array('model'=>'Purekid\Mongodm\Test\Model\Book','type'=>'reference'),
         // 1 to many references
        'books' => array('model'=>'Purekid\Mongodm\Test\Model\Book','type'=>'references'),
        // you can define default value for attribute
        'age' => array('default'=>16,'type'=>'integer'),
        'money' => array('default'=>20.0,'type'=>'double'),
        'hobbies' => array('default'=>array('love'),'type'=>'array'),
        'born_time' => array('type'=>'timestamp'),
        'family'=>array('type'=>'object')

    );

}