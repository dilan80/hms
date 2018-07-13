<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class patient extends CI_Controller {

	public function __construct() {
    parent::__construct();

    $this->load->library('session');
    $this->load->helper('userperm');
    $this->load->helper('form');
    $this->load->helper('url');
		$this->load->model('patientModel', '', TRUE);
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

    $message['count'] = $this->patientModel->count($message['kwd']);
    $message['list'] = $this->patientModel->fetch($message['page'], $message['kwd']);

    $message['username'] = $this->session->userdata('fname') . ' ' . $this->session->userdata('lname');

		$data['content'] = $this->load->view('patient/list', $message, TRUE);
		$this->load->view('page', $data);
  }

  public function get() {

    if (!$this->session->has_userdata('type') || !checkPerm($this->session->userdata('type'), 'p', 'v')) {
      noPerm(true);
    }

    $stream_clean = $this->security->xss_clean($this->input->raw_input_stream);
    $req = json_decode($stream_clean);
    if ($req->id) {
      $u = $this->patientModel->get($req->id);
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

    if (!$this->session->has_userdata('type') || !checkPerm($this->session->userdata('type'), 'p', 'u')) {
      noPerm(true);
    }

    $stream_clean = $this->security->xss_clean($this->input->raw_input_stream);
    $req = json_decode($stream_clean);
    if (isset($req->id) && isset($req->rmn) && isset($req->grd) && isset($req->fnm) && isset($req->lnm) && isset($req->nic) && isset($req->age) && isset($req->add) && isset($req->gen)) {
      if (array_search($req->gen, array('0', '1')) !== FALSE) {
        $res = $this->patientModel->update($req->id, array(
          'fname' => $req->fnm,
          'lname' => $req->lnm,
          'nic' => $req->nic,
          'gurdian' => $req->grd,
          'room' => $req->rmn,
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

  public function insert() {

    if (!$this->session->has_userdata('type') || !checkPerm($this->session->userdata('type'), 'p', 'i')) {
      noPerm(true);
    }

    $stream_clean = $this->security->xss_clean($this->input->raw_input_stream);
    $req = json_decode($stream_clean);
    if (isset($req->rmn) && isset($req->grd) && isset($req->fnm) && isset($req->lnm) && isset($req->nic) && isset($req->age) && isset($req->add) && isset($req->gen)) {
      if (array_search($req->gen, array('0', '1')) !== FALSE) {
        $res = $this->patientModel->insert(array(
          'fname' => $req->fnm,
          'lname' => $req->lnm,
          'nic' => $req->nic,
          'gurdian' => $req->grd,
          'room' => $req->rmn,
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

      $u = $this->patientModel->delete($req->id);
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
