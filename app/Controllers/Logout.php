<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Logout extends BaseController
{
	public function index()
	{
		//
	}
	
	public function admin()
	{
	  session()->remove('login');
	  return redirect()->to(base_url('/login/admin'));
	}
}
