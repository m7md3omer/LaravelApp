<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // the default table name
    protected $table = 'posts';
    // the default id variable for table items 
    public $primaryKey = 'id'; 
    // (default true) to create created_at and updated_at columns in the database
    public $timestamps = true;

    // every post belongs to a user
    public function user(){
        return $this->belongsTo('App\User');
    }
}
