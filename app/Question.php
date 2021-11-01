<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
	protected $fillable =
	[
		'question',
		'answer',
		'fact',
		'quiz',
		'time'
	];

	protected $hidden = [];
}