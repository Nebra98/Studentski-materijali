<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{

	protected $fillable = ['user_id', 'category_id', 'doc_file', 'doc_name', 'user_name', 'description'];


	public function category()
	{
		return $this->belongsto('App\Category');
	}

}
