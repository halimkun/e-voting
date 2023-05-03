<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;

class Profile extends BaseController
{
  private $AdminModel;
  public function __construct()
  {
    $this->AdminModel = new AdminModel();
    helper('Flasher');
  }
  
	public function index()
	{
	  $id_admin = session()->get('login')['id'];
	  $validation = \Config\Services::validation();
		$data = [
		  'title' => 'MY PROFILE',
		  'css' => ['sweetalert/sweetalert2.min'],
		  'js' => ['js/img_preview', 'sweetalert/sweetalert2.all.min', 'js/flasher'],
		  'act' => 'profile',
		  'validation' => $validation,
		  'data_admin' => $this->AdminModel->where('id_admin', $id_admin)->first()
		];
		return view('admin/profile', $data);
	}
	
	public function editProfile()
	{
	  $id_admin = $this->request->getPost('id_admin');
	  $username = $this->request->getPost('username');
	  $nama = $this->request->getPost('nama');
	  $foto_lama = $this->request->getPost('foto_lama');
	  $foto = $this->request->getFile('foto_profile');
	  $rules = [
	    'username' => [
	      'rules' => 'required|alpha_numeric',
	      'errors' => [
	         'required' => 'Mohon isi bidang ini!!',
	         'alpha_numeric' => 'Username tidak boleh ada spasi dan karakter-karakter aneh!!'
	      ]
	     ],
	     'nama' => [
	      'rules' => 'required|alpha_space',
	      'errors' => [
	         'required' => 'Mohon isi bidang ini!!',
	         'alpha_space' => 'Nama tidak boleh ada angka dan karakter-karakter aneh!!'
	      ]
	     ]
	  ];
	  
	  if($foto->getError() == 0){
	    $rules['foto_profile'] = [
       'rules' => 'uploaded[foto_profile]|max_size[foto_profile,10000]|mime_in[foto_profile,image/png,image/jpg,image/jpeg]|is_image[foto_profile]',
       'errors' => [
           'uploaded' => 'Mohon untuk memilih gambar!!',
           'max_size' => 'Gambar yang anda pilih terlalu besar!!',
           'mime_in' => 'Mohon untuk memilih gambar!!',
           'is_image' => 'Mohon untuk memilih gambar!!'
         ]
	      ]; 
	  }
	  
	  // validation 
	  if(!$this->validate($rules)){
	    return redirect()->to(base_url('/admin/profile'))->withInput();
	  }
	  
	  // update data
	  $data_update = [
	    'username' => esc($username),
	    'nama' => esc($nama)
	  ];
	  
	  
	  if($foto->getError() == 0){
	    $file = $_FILES['foto_profile'];
      $namaGb = $file['name'];
      $tmpName = $file['tmp_name'];
      $eks = explode(".", $namaGb);
      $eks = end($eks);
      $namaGb = 'admin.' . $eks;
      unlink('img/' . $foto_lama);
      move_uploaded_file($tmpName , 'img/' .  $namaGb);
      $data_update['foto_profile'] = $namaGb;
	  }
	  
	  if($this->AdminModel->update($id_admin, $data_update)){
      setFlasher('Selamat!!', 'success', 'Data-berhasil-diubah!!');
	  }else{
	    setFlasher('Oupss', 'error', 'Data-gagal-diubah!!');
	  }
	  return redirect()->to(base_url('/admin/profile'));
	  
	}
	
	public function editPassword()
	{
	  $id_admin = $this->request->getPost('id_admin');
	  $password_lama = $this->request->getPost('password_lama');
	  $password_baru = $this->request->getPost('password_baru');
	  $konfirmasi_password = $this->request->getPost('konfirmasi_password');
	  $password_sistem = $this->AdminModel->where('id_admin', $id_admin)->first()->password;
	  
	  if(!$this->validate([
	      'password_lama' => [
	          'rules' => 'required'
	        ],
	      'password_baru' => [
	          'rules' => 'required'
	        ],
	      'konfirmasi_password' => [
	          'rules' => 'required'
	        ]
	    ])){
	      return redirect()->to(base_url('/admin/profile'))->withInput();
	    }
	  
	  if($konfirmasi_password != $password_baru){
	    session()->setFlashdata('info-ganti-password', 'konfirmasi password tidak sesuai');
	    return redirect()->to(base_url('/admin/profile'))->withInput();
	  }
	 
	  if(!password_verify($password_lama, $password_sistem)){
	    session()->setFlashdata('info-ganti-password', 'Password lama anda tidak sesuai!!');
	    return redirect()->to(base_url('/admin/profile'))->withInput();
	  }
	  $password_baru_hash = password_hash($password_baru, PASSWORD_DEFAULT);
	 
	  if($this->AdminModel->update($id_admin, ['password' => $password_baru_hash])){
	    setFlasher('Selamat!!', 'success', 'Password-berhasil-diubah!!');
	  }else{
	    setFlasher('Oupss', 'error', 'Password-gagal-diubah!!');
	  }
	  
	  return redirect()->to(base_url('/admin/profile'));
	  
	}
	
}
