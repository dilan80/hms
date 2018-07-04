<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class dashboard extends CI_Controller {

	public function __construct() {
    parent::__construct();
    $this->load->library('session');
    $this->load->helper('userperm');
    $this->load->helper('form');
    $this->load->helper('url');
		$this->load->model('dashboardModel', '', TRUE);

	}

	public function index() {
		$data['title'] = "Manage Patients";
		$message = array();

		$message['page'] = '1';
		if ( null !== $this->uri->segment('3') ) {
			$message['page'] = $this->uri->segment('3');
		}

		$message['kwd'] = '';
		if ( null !== $this->uri->segment('4') ) {
			$message['kwd'] = $this->uri->segment('4');
		}
    $message['ucount'] = $this->dashboardModel->usercount($message['kwd']);
		$message['pcount'] = $this->dashboardModel->patientcount($message['kwd']);
		$message['acount'] = $this->dashboardModel->appointmentcount($message['kwd']);

    $message['username'] = $this->session->userdata('fname') . ' ' . $this->session->userdata('lname');
		$data['content'] = $this->load->view('dashboard/list', $message, TRUE);
		$this->load->view('page', $data);
  }

}
?>
