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
        $this->session->set_userdata( array( 'id' => $r[0]->id, 'fname' => $r[0]->fname, 'lname' => $r[0]->lname, 'type' => $r[0]->type ) );
        $token = $this->encrypt->encode($r[0]->id);
        set_cookie('auth', $token, 60*60*24);
        return true;
      } else {
        return false;
      }
    }
  }

  public function count($keyword = '') {
    $q = $this->db
      ->select('COUNT(*) as count')
      ->from('user')
      ->like('fname', $keyword)
      ->or_like('lname', $keyword)
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

  public function fetch($page, $keyword = '') {
    $q = $this->db
      ->select('id, fname, lname,username, nic, type, age, gender')
      ->from('user')
      ->limit(10, ($page - 1) * 10)
      ->like('fname', $keyword)
      ->or_like('lname', $keyword)
      ->order_by('fname', 'ASC')
      ->get();
    if ($q->num_rows() > 0) {
      return $q->result();
    }
  }

  public function get($id) {
    $q = $this->db
      ->select('*')
      ->from('user')
      ->where('id', $id)
      ->get();
    if ($q->num_rows() > 0) {
      return $q->result()[0];
    }
  }

  public function update($id, $set) {
    $q = $this->db
      ->where('id', $id)
      ->update('user', $set);
    return $q;
  }

  public function insert($set) {
    $q = $this->db
      ->insert('user', $set);
    return $q;
  }

  public function delete($id) {
    $q = $this->db
    ->delete('user', array('id' => $id));
    return $q;
  }
}
?>
