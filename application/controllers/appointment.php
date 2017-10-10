<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class appointment extends CI_Controller {

	public function __construct() {
    parent::__construct();
    $this->load->helper('userperm');
    $this->load->library('session');
    $this->load->helper('form');
    $this->load->helper('url');
    $this->load->helper('date');
		$this->load->model('appointmentModel', '', TRUE);
	}
	
	public function index() {
		$data['title'] = "Manage Appointments";
    $message = array();

    $message['page'] = '1';
    if ( null !== $this->uri->segment('3') ) {
      $message['page'] = $this->uri->segment('3');
    }

    $message['kwd'] = '';
    if ( null !== $this->uri->segment('4') ) {
      $message['kwd'] = $this->uri->segment('4');
    }
    
    $message['count'] = $this->appointmentModel->count($message['kwd']);
    $message['list'] = $this->appointmentModel->fetch($message['page'], $message['kwd']);

    $message['username'] = $this->session->userdata('fname') . ' ' . $this->session->userdata('lname');
    
		$data['content'] = $this->load->view('appointment/list', $message, TRUE);
		$this->load->view('page', $data);
  }

  public function patients() {
    $keyword = '';
    if ( null !== $this->uri->segment('3') ) {
      $keyword = $this->uri->segment('3');
    }
    $array = $this->appointmentModel->patients($keyword);
    header('Content-Type: application/json');
    die(json_encode($array));
  }

  public function doctors() {
    $keyword = '';
    if ( null !== $this->uri->segment('3') ) {
      $keyword = $this->uri->segment('3');
    }
    $array = $this->appointmentModel->doctors($keyword);
    header('Content-Type: application/json');
    die(json_encode($array));
  }
  
  public function get() {

    if (!$this->session->has_userdata('type') || !checkPerm($this->session->userdata('type'), 'a', 'v')) {
      noPerm(true);
    }

    $stream_clean = $this->security->xss_clean($this->input->raw_input_stream);
    $req = json_decode($stream_clean);
    if ($req->id) {
      $u = $this->appointmentModel->get($req->id);
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

    if (!$this->session->has_userdata('type') || !checkPerm($this->session->userdata('type'), 'a', 'u')) {
      noPerm(true);
    }

    $stream_clean = $this->security->xss_clean($this->input->raw_input_stream);
    $req = json_decode($stream_clean);
    if (isset($req->id) && isset($req->patient) && isset($req->doc) && isset($req->rmn) && isset($req->time) && isset($req->meds)) {
      $res = $this->appointmentModel->update($req->id, array(
        'patient' => $req->patient,
        'doc' => $req->doc,
        'room' => $req->rmn,
        'time' => $req->time,
        'meds' => $req->meds
      ));
      if ($res) {
        die(json_encode(array(
          'success' => TRUE,
          'message' => 'Action completed successfully!',
          'data' => NULL
        )));
      }
    }
    die(json_encode(array(
      'success' => FALSE,
      'message' => 'Incorrect parameters!',
      'data' => NULL
    )));
  }

  public function insert() {

    if (!$this->session->has_userdata('type') || !checkPerm($this->session->userdata('type'), 'a', 'i')) {
      noPerm(true);
    }

    $stream_clean = $this->security->xss_clean($this->input->raw_input_stream);
    $req = json_decode($stream_clean);
    if (isset($req->patient) && isset($req->doc) && isset($req->rmn) && isset($req->time) && isset($req->meds)) {
      $res = $this->appointmentModel->insert(array(
        'patient' => $req->patient,
        'doc' => $req->doc,
        'room' => $req->rmn,
        'time' => $req->time,
        'meds' => $req->meds
      ));
      if ($res) {
        die(json_encode(array(
          'success' => TRUE,
          'message' => 'Action completed successfully!',
          'data' => NULL
        )));
      }
    }
    die(json_encode(array(
      'success' => FALSE,
      'message' => 'Incorrect parameters!',
      'data' => NULL
    )));
  }

  public function delete() {

    if (!$this->session->has_userdata('type') || !checkPerm($this->session->userdata('type'), 'a', 'd')) {
      noPerm(true);
    }

    $stream_clean = $this->security->xss_clean($this->input->raw_input_stream);
    $req = json_decode($stream_clean);
    if ($req->id) {
      if ($this->session->userdata('id') == $req->id) {
        die(json_encode(array(
          'success' => FALSE,
          'message' => 'You cannot delete yourself!',
          'data' => NULL
        )));
      }
      $u = $this->appointmentModel->delete($req->id);
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
