<?php defined('BASEPATH') OR exit('No direct script access allowed');

32/**
  ├─┬ Level 1
  │ ├── 0 : Admin
  │ ├── 1 : Doc
  │ ├── 2 : Nurse
  │ └── 3 : Attendent
  ├─┬ Level 2
  │ ├── u : User
  │ ├── p : Patient
  │ └── a : Appointment
  └─┬ Level 3
    ├── v : View
    ├── i : Insert
    ├── u : Update
    └── d : Delete
  */

function checkPerm($u = null, $p = null, $f = null) {
  $PERM = array(
    '0' => array(
      'u' => array('v', 'i', 'u', 'd'),
      'p' => array('v', 'i', 'u', 'd'),
      'a' => array('v', 'i', 'u', 'd')
    ),
    '1' => array(
      'u' => null,
      'p' => array('v', 'i', 'u'),
      'a' => array('v', 'u')
    ),
    '2' => array(
      'u' => null,
      'p' => array('v', 'i'),
      'a' => array('v', 'i', 'u', 'd')
    ),
    '3' => array(
      'u' => null,
      'p' => array('v', 'i'),
      'a' => array('v', 'i')
    )
  );
  if ($f == null) {
    if (null !== $PERM[$u][$p]){
      return true;
    } else {
      return false;
    }
  } else {
    if (null !== $PERM[$u][$p] && in_array($f, $PERM[$u][$p])){
      return true;
    } else {
      return false;
    }
  }
}

function noPerm($json = false) {
  header("HTTP/1.1 401 Unauthorized");
  if ($json) {
    die(json_encode(array(
      'success' => FALSE,
      'message' => 'Unauthorized request',
      'data' => NULL
    )));
  } else {
    $CI = &get_instance();
    $data['content'] = $CI->load->view('error', array('title' => '401 Unauthorized', 'msg' => 'The request has failed authentication'), TRUE);
    die($CI->load->view('page', $data, TRUE));
  }
  exit;
}
?>
