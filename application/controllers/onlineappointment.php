<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class onlineappointment extends CI_Controller {

	public function __construct() {
    parent::__construct();
    $this->load->library('session');
    $this->load->helper('userperm');
    $this->load->helper('form');
    $this->load->helper('url');
		$this->load->model('onlineappointmentModel', '', TRUE);

	}

	public function index() {
		$data['title'] = "Manage Online Appointments";
		$message = array();

		$message['page'] = '1';
		if ( null !== $this->uri->segment('3') ) {
			$message['page'] = $this->uri->segment('3');
		}

		$message['kwd'] = '';
		if ( null !== $this->uri->segment('4') ) {
			$message['kwd'] = $this->uri->segment('4');
		}

		$message['count'] = $this->onlineappointmentModel->count($message['kwd']);
		$message['list'] = $this->onlineappointmentModel->fetch($message['page'], $message['kwd']);

		$message['username'] = $this->session->userdata('fname') . ' ' . $this->session->userdata('lname');

		$data['content'] = $this->load->view('onlineappointment/list', $message, TRUE);
		$this->load->view('page', $data);
	}
	public function get() {

    if (!$this->session->has_userdata('type') || !checkPerm($this->session->userdata('type'), 'a', 'v')) {
      noPerm(true);
    }

    $stream_clean = $this->security->xss_clean($this->input->raw_input_stream);
    $req = json_decode($stream_clean);
    if ($req->id) {
      $u = $this->onlineappointmentModel->get($req->id);
      if ($u) {
        $u->password = NULL;
        die(json_encode(array(
          'success' => TRUE,
          'message' => 'Action completed successfully!',
          'data' => $u
        )));
      } else {
        die(json_encode(array(
          'success' => FALSE,
          'message' => 'Patient does not exists!',
          'data' => NULL
        )));
      }
    }
  }


	public function update() {

    if (!$this->session->has_userdata('type') || !checkPerm($this->session->userdata('type'), 'o', 'u')) {
      noPerm(true);
    }

    $stream_clean = $this->security->xss_clean($this->input->raw_input_stream);
    $req = json_decode($stream_clean);
    if (isset($req->id) && isset($req->fname) && isset($req->lname) && isset($req->nic) && isset($req->age) && isset($req->add) && isset($req->gen)) {
      if (array_search($req->gen, array('0', '1')) !== FALSE) {
        $res = $this->onlineappointmentModel->update($req->id, array(
          'fname' => $req->fname,
          'lname' => $req->lname,
          'nic' => $req->nic,
          'age' => $req->age,
          'address' => $req->add,
          'gender' => $req->gen,
        ));
        if ($res) {
          die(json_encode(array(
            'success' => TRUE,
            'message' => 'Action completed successfully!',
            'data' => NULL
          )));
        }
      }
    }
    die(json_encode(array(
      'success' => FALSE,
      'message' => 'Incorrect parameters!',
      'data' => NULL
    )));
  }

	public function delete() {

    if (!$this->session->has_userdata('type') || !checkPerm($this->session->userdata('type'), 'p', 'd')) {
      noPerm(true);
    }

    $stream_clean = $this->security->xss_clean($this->input->raw_input_stream);
    $req = json_decode($stream_clean);
    if ($req->id) {

      $u = $this->onlineappointmentModel->delete($req->id);
      if ($u) {
        die(json_encode(array(
          'success' => TRUE,
          'message' => 'Action completed successfully!',
          'data' => NULL
        )));
      } else {
        die(json_encode(array(
          'success' => FALSE,
          'message' => 'Patient does not exists!',
          'data' => NULL
        )));
      }
    }
  }

}
?>
