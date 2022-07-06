<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    

	protected $fillable = ['user_id', 'name', 'cover_image'];

	public function documents()
	{
		return $this->hasMany('App\Document');
	}

}
	