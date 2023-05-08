<?php

namespace App\Models;

use CodeIgniter\Model;

class AnggotaModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'anggota';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 7894;
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
	protected $allowedFields        = [
		'nis', 'nama', 'jabatan', 'foto'
	];

	// Dates
	protected $useTimestamps        = true;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';
}
