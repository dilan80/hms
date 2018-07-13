<?php
class OnlineAppointmentModel extends CI_Model {
  public function __construct() {
    parent::__construct();
    // Your own constructor code
  }

  public function count($keyword = '') {
    $q = $this->db
      ->select('COUNT(*) as count')
      ->from('onlineappointment AS a')

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

  public function patients($keyword) {
    $q = $this->db
      ->select('id, CONCAT(fname, " ", lname) as name, nic')
      ->from('patient')
      ->limit(10)
      ->like('fname', $keyword)
      ->or_like('lname', $keyword)
      ->order_by('name', 'ASC')
      ->get();
    if ($q->num_rows() > 0) {
      return $q->result();
    }
  }

  public function doctors($keyword) {
    $q = $this->db
      ->select('id, CONCAT(fname, " ", lname) as name, spec')
      ->from('user')
      ->limit(10)
      ->where('type', 1)
      ->group_start()
      ->like('fname', $keyword)
      ->or_like('lname', $keyword)
      ->order_by('name', 'ASC')
      ->group_end()
      ->get();
    if ($q->num_rows() > 0) {
      return $q->result();
    }
  }

  public function fetch($page, $keyword = '') {
    $q = $this->db
      ->select('a.appointmentid as id, a.lname as lname,a.fname as fname, a.age as age, a.address as address, a.gender as gender, a.nic as nic, a.contact as contact, a.doc as doctor')
      ->from('onlineappointment AS a')

      ->limit(10, ($page - 1) * 10)
      ->like('a.appointmentid', $keyword)
      ->or_like('a.lname', $keyword)
      ->or_like('a.fname', $keyword)
      ->or_like('a.age', $keyword)
      ->or_like('a.address', $keyword)
      ->or_like('a.gender', $keyword)
      ->or_like('a.nic', $keyword)
      ->or_like('a.contact', $keyword)
      ->or_like('a.doc', $keyword)

      ->get();
    if ($q->num_rows() > 0) {
      return $q->result();
    } else {
      return [];
    }
  }

  public function get($id) {
    $q = $this->db
    ->select('a.appointmentid as id, a.lname as lname,a.fname as fname, a.age as age, a.address as address, a.gender as gender, a.nic as nic, a.contact as contact, a.doc as doctor')
    ->from('onlineappointment AS a')
    ->where('a.appointmentid', $id)
    ->get();
    if ($q->num_rows() > 0) {
      return $q->result()[0];
    }
  }
  public function update($id, $set) {
    $q = $this->db
      ->where('appointmentid', $id)
      ->update('onlineappointment', $set);
    return $q;
  }

  public function insert($set) {
    $q = $this->db
      ->insert('onlineappointment', $set);
    return $q;
  }

  public function delete($id) {
    $q = $this->db
    ->delete('onlineappointment', array('id' => $id));
    return $q;
  }
}
