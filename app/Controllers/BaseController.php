<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */

class BaseController extends Controller
{
	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = ['Auth', 'setting', 'Flasher'];

	/**
	 * Constructor.
	 *
	 * @param RequestInterface  $request
	 * @param ResponseInterface $response
	 * @param LoggerInterface   $logger
	 */
	public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.: $this->session = \Config\Services::session();
		session();
		
		$waktuSelesai = setting('App.waktu_selesai');
		$statusAcara = setting('App.status_acara');
		$today = date('Y-m-d H:i:s');

		if ($statusAcara == 1) {
			// waktu selesai to date
			$waktuSelesai = strtotime($waktuSelesai);
			$waktuSelesai = date('Y-m-d H:i:s', $waktuSelesai);

			// if todak >= waktu selesai then stop acara
			if ($today >= $waktuSelesai) {
				setting('App.status_acara', 2);
			}
		}
	}
}
