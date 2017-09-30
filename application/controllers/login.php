<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class login extends CI_Controller {

	public function __construct() {
    parent::__construct();
		$this->load->helper('form');
		$this->load->model('userModel', '', TRUE);
		$this->load->helper('url');
	}
	
	public function index() {
		$data['title'] = "Sign In";
		$message = array();

		var_dump(get_cookie('auth'));
		
		if ($this->input->post('u') && $this->input->post('p')) {
			if (trim($this->input->post('u')) === '' || trim($this->input->post('p')) === '') {
				$message = array('typ' => 'ERR', 'msg' => 'Username or password cannot be empty.');
			}
			if (!$this->userModel->login($this->input->post('u'), $this->input->post('p'), $this->input->post('r'))){
				$message = array('typ' => 'ERR', 'msg' => 'Username or password incorrect.');
			} else {
				redirect('user/');
			}
		}
		$data['content'] = $this->load->view('login', $message, TRUE);
		$this->load->view('page', $data);
	}
}
