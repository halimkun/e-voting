<?php

namespace App\Controllers\Admin;
use App\Models\CandidateModel;

use App\Controllers\BaseController;

class Kandidat extends BaseController
{
  private $CandidateModel;
  
  public function __construct()
  {
    $this->CandidateModel = new CandidateModel();
    helper('Flasher');
  }
  
	public function index()
	{
	  $validation =  \Config\Services::validation();
		$data = [
		  'title' => 'DATA KANDIDAT',
		  'act' => 'kandidat',
		  'css' => ['summernote/summernote.min', 'sweetalert/sweetalert2.min'],
		  'js' => ['summernote/summernote.min', 'js/img_preview', 'sweetalert/sweetalert2.all.min', 'js/flasher'],
		  'validation' => $validation,
		  'data_candidate' => $this->CandidateModel->getData(),
		  'no_urut_terakhir' => $this->CandidateModel->selectMax('no_urut', 'no_urut')->first()->no_urut
		];
		return view('admin/kandidat', $data);
	}
	
	public function view($id_candidate)
	{
	  $data = [
	    'title' => 'VIEW KANDIDAT',
	    'act' => 'kandidat',
	    'data_candidate' => $this->CandidateModel->getData($id_candidate)
	  ];
	  return view('admin/view-kandidat', $data);
	}
	
	public function add()
	{
	  if(!$this->validate([
	    'no_urut' => [
	        'rules' => 'required|is_unique[candidate.no_urut]',
	        'errors' => [
	            'required' => 'bidang harus diisi',
	            'is_unique' => 'no_urut telah digunakan'
	          ]
	      ],
	     'ketua' => [
	         'rules' => 'required|alpha_space',
	         'errors' => [
	             'required' => 'harap isi bidang',
	             'alpha_space' => 'nama tidak boleh mengandung angka'
	           ]
	       ],
	     'wakil' => [
	         'rules' => 'required|alpha_space',
	         'errors' => [
	             'required' => 'harap isi bidang',
	             'alpha_space' => 'nama tidak boleh mengandung angka'
	           ]
	       ],
	     'slogan' => [
	         'rules' => 'required',
	         'errors' => [
	             'required' => 'harap isi bidang',
	           ]
	       ],
	     'visi' => [
	         'rules' => 'required',
	         'errors' => [
	             'required' => 'visi tidak boleh kosong!!',
	           ]
	       ],
	     'misi' => [
	         'rules' => 'required',
	         'errors' => [
	             'required' => 'misi tidak boleh kosong!!',
	           ]
	       ],
	     'foto' => [
	         'rules' => 'uploaded[foto]|max_size[foto,10000]|mime_in[foto,image/png,image/jpg,image/jpeg]|is_image[foto]',
	         'errors' => [
	             'uploaded' => 'Mohon untuk memilih gambar!!',
	             'max_size' => 'Gambar yang anda pilih terlalu besar!!',
	             'mime_in' => 'Mohon untuk memilih gambar!!',
	             'is_image' => 'Mohon untuk memilih gambar!!'
	           ]
	       ]

	    ])){
	      return redirect()->to(base_url('admin/kandidat'))->withInput();
	    }
	  
    $file = $_FILES['foto'];
    $namaGb = $file['name'];
    $tmpName = $file['tmp_name'];
    $eks = explode(".", $namaGb);
    $eks = end($eks);
    $namaGb = 'candidate' . $this->request->getPost('no_urut') . '.' . $eks;
    move_uploaded_file($tmpName , 'img/candidate/' .  $namaGb);
    
	  $faker = \Faker\Factory::create('id_ID');
    $data_insert = [
      'id_candidate' => $faker->uuid(),
      'no_urut' => esc($this->request->getPost('no_urut')),
      'ketua' => strtoupper(esc($this->request->getPost('ketua'))),
      'wakil' => strtoupper(esc($this->request->getPost('wakil'))),
      'visi' => $this->request->getPost('visi'),
      'misi' => $this->request->getPost('misi'),
      'slogan' => esc($this->request->getPost('slogan')),
      'foto' => $namaGb
    ];
   
    $this->CandidateModel->insert($data_insert); 
    session()->setFlashdata('CRUD-Tambah', 'Selamat!!, Berhasil menambahkan data baru');
    return redirect()->to(base_url('admin/kandidat'));
	}
	
	public function hapus($id_candidate)
	{
	  $foto = $this->request->getPost('foto');
	  $this->CandidateModel->delete($id_candidate);
	  unlink('img/candidate/' . $foto);
    setFlasher('Selamat!!', 'success', 'Data-berhsail-dihapus!!');
	  return redirect()->to(base_url('/admin/kandidat'));
	}
	
	public function edit($id_candidate)
	{
	  $validation =  \Config\Services::validation();
	  $data = [
	    'title' => 'EDIT KANDIDAT',
	    'act' => 'kandidat',
	    'css' => ['summernote/summernote.min'],
	    'js' => ['summernote/summernote.min', 'js/img_preview'],
	    'data_candidate' => $this->CandidateModel->getData($id_candidate),
	    'validation' => $validation
	  ];
	  return view('admin/edit-kandidat', $data);
	}
	
	public function update($id_candidate)
	{
	  $file = $this->request->getFile('foto');
	 // dd($file);
	  $rule = [
	    'ketua' => [
	         'rules' => 'required|alpha_space',
	         'errors' => [
	             'required' => 'harap isi bidang',
	             'alpha_space' => 'nama tidak boleh mengandung angka'
	           ]
	       ],
	     'wakil' => [
	         'rules' => 'required|alpha_space',
	         'errors' => [
	             'required' => 'harap isi bidang',
	             'alpha_space' => 'nama tidak boleh mengandung angka'
	           ]
	       ],
	     'slogan' => [
	         'rules' => 'required',
	         'errors' => [
	             'required' => 'harap isi bidang',
	           ]
	       ],
	     'visi' => [
	         'rules' => 'required',
	         'errors' => [
	             'required' => 'visi tidak boleh kosong!!',
	           ]
	       ],
	     'misi' => [
	         'rules' => 'required',
	         'errors' => [
	             'required' => 'misi tidak boleh kosong!!',
	           ]
	       ],
	  ];
	  
	  if($file->getError() == 0){
	    $rule['foto'] = [
         'rules' => 'uploaded[foto]|max_size[foto,10000]|mime_in[foto,image/png,image/jpg,image/jpeg]|is_image[foto]',
         'errors' => [
             'uploaded' => 'Mohon untuk memilih gambar!!',
             'max_size' => 'Gambar yang anda pilih terlalu besar!!',
             'mime_in' => 'Mohon untuk memilih gambar!!',
             'is_image' => 'Mohon untuk memilih gambar!!'
           ]
	      ];
	  }
	  
	  if(!$this->validate($rule)){
	    return redirect()->to(base_url('admin/kandidat/edit/' . $id_candidate))->withInput();
	  }
	  
	  $no_urut = $this->request->getPost('no_urut');
	  $data_update = [
      'ketua' => strtoupper(esc($this->request->getPost('ketua'))),
      'wakil' => strtoupper(esc($this->request->getPost('wakil'))),
      'visi' => $this->request->getPost('visi'),
      'misi' => $this->request->getPost('misi'),
      'slogan' => esc($this->request->getPost('slogan')),
	  ];
	  
	  if($file->getError() == 0){
	    $foto_lama = $this->CandidateModel->getData($id_candidate)->foto;
	    unlink('img/candidate/' . $foto_lama);
	    $nama_baru = $_FILES['foto']['name'];
	    $tmp_name = $file->getTempName();
	    $eks = $file->getClientExtension();
	    $nama_baru = 'candidate' . $no_urut . '.' . $eks;
	    move_uploaded_file($tmp_name, 'img/candidate/' . $nama_baru);
	    $data_update['foto'] = $nama_baru;
	  }
	  
	  if($this->CandidateModel->update($id_candidate, $data_update)){
	    setFlasher('Selamat!!', 'success', 'Data-berhasil-diupdate!!');
	  }else{
	    setFlasher('Oupss..', 'error', 'Data-gagal-diupdate!!');
	  }
	  
	  return redirect()->to(base_url('admin/kandidat'));
	  
	}
	
}
