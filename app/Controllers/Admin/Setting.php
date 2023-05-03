<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\GeneralModel;

class Setting extends BaseController
{
  private $GeneralModel;
  
  public function __construct()
  {
    $this->GeneralModel = new GeneralModel();
    helper('Flasher');
  }
  
	public function index()
	{
	  $validation = \Config\Services::validation();
		$data = [
		    'title' => 'SETTING',
		    'act' => 'setting',
		    'css' => ['sweetalert/sweetalert2.min'],
		    'js' => ['js/img_preview', 'sweetalert/sweetalert2.all.min', 'js/flasher'],
		    'data_sekolah' => $this->GeneralModel->first(),
		    'validation' => $validation
		  ];
		return view('admin/setting', $data);
	}
	
	public function edit()
	{
	  $nama_sekolah = $this->request->getPost('nama_sekolah');
	  $alamat_sekolah = $this->request->getPost('alamat_sekolah');
	  $email_sekolah = $this->request->getPost('email_sekolah');
	  $id_sekolah = $this->request->getPost('id_sekolah');
	  $logo_lama = $this->request->getPost('logo_lama');
	  $logo = $_FILES['logo'];
	  
	  $rules = [
      'nama_sekolah' => [
          'rules' => 'required|alpha_numeric_space'
        ],
      'alamat_sekolah' => [
          'rules' => 'required'
        ], 
      'email_sekolah' => [
          'rules' => 'required|valid_email'
        ]
	  ];
	  
	  if($logo['error'] == 0){
	    $rules['logo'] = [
	        'rules' => 'uploaded[logo]|max_size[logo,2048]|mime_in[logo,image/png,image/jpg,image/jpeg]|is_image[logo]'
	      ];
	  }
	  
	  if(!$this->validate($rules)){
	     return redirect()->to(base_url('/admin/setting'))->withInput();
	  }
	  
	  $data_edit = [
	    'nama_sekolah' => strtoupper(esc($nama_sekolah)),
	    'alamat_sekolah' => esc($alamat_sekolah),
	    'email_sekolah' => esc($email_sekolah)
	  ];
	 
	  if($logo['error'] == 0){
	    $logoName = $logo['name'];
	    $eks = $this->request->getFile('logo')->getClientExtension();
	    $logoName = 'logo.' . $eks;
	    $tmpName = $logo['tmp_name'];
	    if(unlink('img/' . $logo_lama)){
	      move_uploaded_file($tmpName , 'img/' .  $logoName);
	      $data_edit['logo_sekolah'] = $logoName; 
	    }
	  }
	  
	  if($this->GeneralModel->update($id_sekolah, $data_edit)){
	    setFlasher('Selamat!!', 'success', 'Data-berhasil-diubah!!');
	  }else{
	    setFlasher('Oupss..', 'error', 'Data-gagal-diubah!!');
	  }
	  
	  return redirect()->to(base_url('/admin/setting'));
	  
	}
	
}
