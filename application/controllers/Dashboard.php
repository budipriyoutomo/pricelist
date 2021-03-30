<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This controller can be accessed
 * for all logged in users
 */
class Dashboard extends MY_Controller {

    protected $access = array('SuperAdmin','Admin', 'User');

	function __construct()
    {
        parent::__construct();

    }


	public function index()
	{

    $this->load->view('header');
		$this->load->view('index');
		$this->load->view('footer');

	}




}
