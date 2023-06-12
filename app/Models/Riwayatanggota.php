<?php

namespace App\Models;

use CodeIgniter\Model;

class Riwayatanggota extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'riwayat_anggota';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
	protected $allowedFields        = [
		'nama',
		'jabatan',
		'tahun',
		'keterangan',
	];

	// Dates
	protected $useTimestamps        = true;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';
}
