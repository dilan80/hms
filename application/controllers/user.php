<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class user extends CI_Controller {

	public function __construct() {
    parent::__construct();

    $this->load->library('session');

    if ($this->session->has_userdata('fname') && $this->session->has_userdata('lname') && $this->session->has_userdata('type') && $this->session->userdata('type') === '0') {
      
    } else {
      header("HTTP/1.1 401 Unauthorized");
      $data['content'] = $this->load->view('error', array('title' => '401 Unauthorized', 'msg' => 'The request has failed authentication'), TRUE);
      die($this->load->view('page', $data, TRUE));
      exit;
    }

		$this->load->helper('form');
		$this->load->model('userModel', '', TRUE);
	}
	
	public function index() {
		$data['title'] = "Manage User Accounts";
    $message = array();

    $message['page'] = '1';
    if ( null !== $this->uri->segment('3') ) {
      $message['page'] = $this->uri->segment('3');
    }
    
    $message['count'] = $this->userModel->count();
    $message['list'] = $this->userModel->get($message['page']);
    
		$data['content'] = $this->load->view('user/list', $message, TRUE);
		$this->load->view('page', $data);
	}
}
