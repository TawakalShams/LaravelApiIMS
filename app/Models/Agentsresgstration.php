<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agentsresgstration extends Model
{
	use HasFactory;
	protected $table = 'agentsregstration';
	// public    $primarykey='agentid';
	public $timestamps = false;
	protected $primaryKey = 'agentid';
	protected $fillable = [
		'fullName',
		'email',
		'role',
		'password',
		'dob',
		'address',
		'branch',
		'phone',
		'created_by',
	];
}
