<?php

namespace App\Controllers;

use App\Models\CobaModel;

class Home extends BaseController
{
	protected $anggota;
	protected $agenda;
	protected $informasi;
	protected $webFile;
	protected $colCondition;

	public function __construct()
	{
		$this->anggota 		= new \App\Models\AnggotaModel();
		$this->agenda 		= new \App\Models\AgendaModel();
		$this->webFile 		= new \App\Models\WebfileModel();
		$this->informasi 	= new \App\Models\InfoModel();
		$this->colCondition = [
			'Sekretaris',
			'Sekretaris 2',
			'Bendahara',
			'Bendahara 2',
			'Komisi A',
			'Komisi A 1',
			'Komisi B',
			'Komisi B 1',
			'Komisi C',
			'Komisi C 1'
		];
	}

	public function index()
	{
		return view('home', [
			'agenda' => $this->agenda->orderBy('created_at', 'desc')->findAll(6),
		]);
	}

	public function about()
	{
		return view('about');
	}

	function agenda($id)
	{
		$agenda = $this->agenda->find($id);
		return view('agenda', [
			'agenda' => $agenda
		]);
	}

	public function download()
	{
		return view('downloads', [
			'webFile' => $this->webFile->findAll()
		]);
	}

	function informasi()
	{
		return view('informasi', [
			'informasi' => $this->informasi->findAll()
		]);
	}

	public function informasi_detail($num)
	{
		$img_src = [];
		$img_avaiable = true;
		$info = $this->informasi->find($num);

		$dom = new \DOMDocument();
		$dom->loadHTML($info['isi']);

		$image_tags = $dom->getElementsByTagName('img');

		foreach ($image_tags as $image_tag) {
			$img_src[] = $image_tag->getAttribute('src');
		}

		if (empty($img_src)) {
			$img_src[] = 'https://www.charlotteathleticclub.com/assets/camaleon_cms/image-not-found-4a963b95bf081c3ea02923dceaeb3f8085e1a654fc54840aac61a57a60903fef.png';
			$img_avaiable = false;
		}

		return view('informasi_detail', [
			'info' => $info,
			'img_src' => $img_src[0],
			'img_avaiable' => $img_avaiable
		]);
	}

	public function anggota()
	{
		$anggota = $this->removeEmptName($this->anggota->findAll());
		$anggota = array_map(
			function ($anggota) {
				$temp = [
					'key' => $anggota['jabatan'],
					'name' => $anggota['nama'],
					'jabatan' => $anggota['jabatan'],
				];

				if (strtolower($anggota['jabatan']) !== 'ketua') {
					if (strtolower($anggota['jabatan']) === 'wakil ketua') {
						$temp['parent'] = $this->anggota->where('jabatan', 'ketua')->first()['jabatan'];
					} elseif (str_contains(strtolower($anggota['jabatan']), 'sekretaris')) {
						$sk = explode(' ', strtolower($anggota['jabatan']));
						if (count($sk) === 1) {
							$temp['parent'] = $this->anggota->where('jabatan', 'wakil ketua')->first()['jabatan'];
						} else {
							$temp['parent'] = $this->anggota->where('jabatan', 'sekretaris')->first()['jabatan'];
						}
					} elseif (str_contains(strtolower($anggota['jabatan']), 'bendahara')) {
						$sk = explode(' ', strtolower($anggota['jabatan']));
						if (count($sk) === 1) {
							$temp['parent'] = $this->anggota->where('jabatan', 'wakil ketua')->first()['jabatan'];
						} else {
							$temp['parent'] = $this->anggota->where('jabatan', 'bendahara')->first()['jabatan'];
						}
					} elseif (strtolower($anggota['jabatan']) === 'ketua komisi') {
						$temp['parent'] = $this->anggota->where('jabatan', 'wakil ketua')->first()['jabatan'];
					} elseif (in_array(strtolower($anggota['jabatan']), ['komisi a', 'komisi b', 'komisi c'])) {
						$temp['parent'] = $this->anggota->where('jabatan', 'ketua komisi')->first()['jabatan'];
					} elseif (in_array(strtolower($anggota['jabatan']), ['komisi a 1', 'komisi b 1', 'komisi c 1'])) {
						if (strtolower($anggota['jabatan']) == 'komisi a 1') {
							$temp['parent'] = $this->anggota->where('jabatan', 'komisi a')->first()['jabatan'];
							$temp['jabatan'] = 'Komisi A';
						} elseif (strtolower($anggota['jabatan']) == 'komisi b 1') {
							$temp['parent'] = $this->anggota->where('jabatan', 'komisi b')->first()['jabatan'];
							$temp['jabatan'] = 'Komisi B';
						} elseif (strtolower($anggota['jabatan']) == 'komisi c 1') {
							$temp['parent'] = $this->anggota->where('jabatan', 'komisi c')->first()['jabatan'];
							$temp['jabatan'] = 'Komisi C';
						}
					}
				}
				return $temp;
			},
			$anggota
		);

		$anggota = array_values($anggota);

		return view('anggota', [
			'anggota' => json_encode($anggota),
			'colCondition' => $this->colCondition
		]);
	}

	protected function removeEmptName($array)
	{
		return array_filter(
			$array,
			function ($anggota) {
				return $anggota['nama'] !== '';
			}
		);
	}
}
