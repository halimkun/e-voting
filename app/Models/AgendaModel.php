<?php

namespace App\Models;

use CodeIgniter\Model;

class AgendaModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'agenda';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 5849;
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
	protected $allowedFields        = [
		'mulai', 'selesai', 'acara', 'keterangan', 'foto'
	];

	// Dates
	protected $useTimestamps        = true;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';
}
