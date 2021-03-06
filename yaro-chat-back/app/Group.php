<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable=  [
		'name',
		'image'
	];

    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany( 'App\User' , 'group__friends' ,'group_id' , 'user_id');
    }
}
