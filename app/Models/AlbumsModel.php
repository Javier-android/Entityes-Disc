<?php namespace App\Models;

use CodeIgniter\Model;

class GenresModel extends Model
{
	protected $table = 'albums';
	protected $returnType = "App\Entities\Album";
	protected $allowedFields = ['name'];
	protected $allowedFields = ['author'];
	protected $allowedFields = ['genre_id'];
}