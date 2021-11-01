<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
	protected $primaryKey = 'identifier';
	
	protected $fillable =
	[
		'identifier',
		'date',
		'completed'
	];

	protected $hidden = [];
}