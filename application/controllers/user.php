<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class user extends CI_Controller {

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
		$this->load->model('userModel', '', TRUE);
	}
	
	public function index() {
		$data['title'] = "Manage User Accounts";
    $message = array();

    $message['page'] = '1';
    if ( null !== $this->uri->segment('3') ) {
      $message['page'] = $this->uri->segment('3');
    }

    $message['kwd'] = '';
    if ( null !== $this->uri->segment('4') ) {
      $message['kwd'] = $this->uri->segment('4');
    }
    
    $message['count'] = $this->userModel->count($message['kwd']);
    $message['list'] = $this->userModel->fetch($message['page'], $message['kwd']);

    $message['username'] = $this->session->userdata('fname') . ' ' . $this->session->userdata('lname');
    
		$data['content'] = $this->load->view('user/list', $message, TRUE);
		$this->load->view('page', $data);
  }
  
  public function get() {
    $stream_clean = $this->security->xss_clean($this->input->raw_input_stream);
    $req = json_decode($stream_clean);
    if ($req->id) {
      $u = $this->userModel->get($req->id);
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
          'message' => 'User does not exists!',
          'data' => NULL
        )));
      }
    }
  }

  public function update() {
    $stream_clean = $this->security->xss_clean($this->input->raw_input_stream);
    $req = json_decode($stream_clean);
    if (isset($req->id) && isset($req->u) && isset($req->fnm) && isset($req->lnm) && isset($req->typ) && isset($req->nic) && isset($req->age) && isset($req->add) && isset($req->gen)) {
      if (array_search($req->typ, array('0', '1', '2', '3')) !== FALSE && array_search($req->gen, array('0', '1')) !== FALSE) {
        $res = $this->userModel->update($req->id, array(
          'username' => $req->u,
          'fname' => $req->fnm,
          'lname' => $req->lnm,
          'type' => $req->typ,
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

  public function insert() {
    $stream_clean = $this->security->xss_clean($this->input->raw_input_stream);
    $req = json_decode($stream_clean);
    if (isset($req->p) && isset($req->u) && isset($req->fnm) && isset($req->lnm) && isset($req->typ) && isset($req->nic) && isset($req->age) && isset($req->add) && isset($req->gen)) {
      if (array_search($req->typ, array('0', '1', '2', '3')) !== FALSE && array_search($req->gen, array('0', '1')) !== FALSE) {
        $res = $this->userModel->insert(array(
          'username' => $req->u,
          'password' => $req->p,
          'fname' => $req->fnm,
          'lname' => $req->lnm,
          'type' => $req->typ,
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
      $u = $this->userModel->delete($req->id);
      if ($u) {
        die(json_encode(array(
          'success' => TRUE,
          'message' => 'Action completed successfully!',
          'data' => NULL
        )));
      } else {
        die(json_encode(array(
          'success' => FALSE,
          'message' => 'User does not exists!',
          'data' => NULL
        )));
      }
    }
  }
}
