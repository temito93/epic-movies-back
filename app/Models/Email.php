<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
	use HasFactory;

	protected $fillable = [
		'email',
		'email_verified_at',
		'user_id',
		'primary',
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
