<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class appointment extends CI_Controller {

	public function __construct() {
    parent::__construct();

    $this->load->library('session');
    if ($this->session->has_userdata('id') && $this->session->has_userdata('fname') && $this->session->has_userdata('lname') && $this->session->has_userdata('type') && $this->session->userdata('type') === '0') {
      
    } else {
      header("HTTP/1.1 401 Unauthorized");
      $data['content'] = $this->load->view('error', array('title' => '401 Unauthorized', 'msg' => 'The request has failed authentication'), TRUE);
      die($this->load->view('page', $data, TRUE));
      exit;
    }

    $this->load->helper('form');
    $this->load->helper('url');
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
