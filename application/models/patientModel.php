<?php
class PatientModel extends CI_Model {
  public function __construct() {
    parent::__construct();
    // Your own constructor code
  }

  public function count() {
    $q = $this->db
      ->select('COUNT(*) as count')
      ->from('patient')
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

  public function fetch($page) {
    $q = $this->db
      ->select('id, fname, lname, nic, age')
      ->from('patient')
      ->limit(10, ($page - 1) * 10)
      ->get();
    if ($q->num_rows() > 0) {
      return $q->result();
    }
  }

  public function get($id) {
    $q = $this->db
      ->select('*')
      ->from('patient')
      ->where('id', $id)
      ->get();
    if ($q->num_rows() > 0) {
      return $q->result()[0];
    }
  }

  public function update($id, $set) {
    $q = $this->db
      ->where('id', $id)
      ->update('patient', $set);
    return $q;
  }

  public function insert($set) {
    $q = $this->db
      ->insert('patient', $set);
    return $q;
  }

  public function delete($id) {
    $q = $this->db
    ->delete('patient', array('id' => $id));
    return $q;
  }
}
?>