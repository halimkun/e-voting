<?php

namespace App\Controllers;
use App\Models\CobaModel;
class Home extends BaseController
{
	public function index()
	{
		return view('home');
	}

	public function about()
	{
		return view('about');
	}
}
