<?php
class UserModel extends CI_Model {
  public function __construct() {
    parent::__construct();
    // Your own constructor code
    $this->load->library('encrypt');
    $this->load->library('session');
    $this->load->helper('cookie');
  }
  
  public function login($u, $p, $r) {
    $q = $this->db
      ->select('id, lname, fname, type')
      ->from('user')
      ->where('username', $u)
      ->where('password', md5($p))
      ->get();
    if ($q->num_rows() > 0) {
      $r = $q->result();
      if (sizeof($r) > 0) {
        $this->session->set_userdata( array( 'fname' => $r[0]->fname, 'lname' => $r[0]->lname, 'type' => $r[0]->type ) );
        $token = $this->encrypt->encode($r[0]->id);
        set_cookie('auth', $token, 60*60*24);
        return true;
      } else {
        return false;
      }
    }
  }

  public function count() {
    $q = $this->db
      ->select('COUNT(*) as count')
      ->from('user')
      ->get();
    if ($q->num_rows() > 0) {
      $r = $q->result();
      if (sizeof($r) > 0) {
        return $r[0]->count;
      } else {
        return 0;
      }
    }
  }

  public function get($page) {
    $q = $this->db
      ->select('id, fname, lname, nic, type')
      ->from('user')
      ->limit(10, ($page - 1) * 10)
      ->get();
    if ($q->num_rows() > 0) {
      return $q->result();
    }
  }
}
?>