<?php
class AppointmentModel extends CI_Model {
  public function __construct() {
    parent::__construct();
    // Your own constructor code
  }

  public function count($keyword = '') {
    $q = $this->db
      ->select('COUNT(*) as count')
      ->from('appointment AS a')
      ->join('patient AS p', 'p.id = a.patient')
      ->join('user AS d', 'd.id = a.doc')
      ->like('p.fname', $keyword)
      ->or_like('p.lname', $keyword)
      ->or_like('d.fname', $keyword)
      ->or_like('d.lname', $keyword)
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
      ->select('a.id as id, a.room as room, CONCAT(p.fname, " ", p.lname) as patient, CONCAT(d.fname, " ", d.lname) as doc, a.time as time')
      ->from('appointment AS a')
      ->join('patient AS p', 'p.id = a.patient')
      ->join('user AS d', 'd.id = a.doc')
      ->limit(10, ($page - 1) * 10)
      ->like('p.fname', $keyword)
      ->or_like('p.lname', $keyword)
      ->or_like('d.fname', $keyword)
      ->or_like('d.lname', $keyword)
      ->order_by('a.time', 'DESC')
      ->get();
    if ($q->num_rows() > 0) {
      return $q->result();
    } else {
      return [];
    }
  }

  public function get($id) {
    $q = $this->db
      ->select('a.id as id, a.room as room, CONCAT(p.fname, " ", p.lname) as patient, p.id as patient_id, CONCAT(d.fname, " ", d.lname) as doc, d.id as doc_id, a.time as time, a.meds as meds')
      ->from('appointment AS a')
      ->join('patient AS p', 'p.id = a.patient')
      ->join('user AS d', 'd.id = a.doc')
      ->where('id', $id)
      ->get();
    if ($q->num_rows() > 0) {
      return $q->result()[0];
    }
  }

  public function update($id, $set) {
    $q = $this->db
      ->where('id', $id)
      ->update('appointment', $set);
    return $q;
  }

  public function insert($set) {
    $q = $this->db
      ->insert('appointment', $set);
    return $q;
  }

  public function delete($id) {
    $q = $this->db
    ->delete('appointment', array('id' => $id));
    return $q;
  }
}
?>