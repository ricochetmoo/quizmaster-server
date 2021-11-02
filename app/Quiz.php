<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{	
	protected $fillable =
	[
		'identifier',
		'date',
		'completed'
	];

	protected $hidden = [];
}