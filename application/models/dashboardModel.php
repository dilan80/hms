<?php

  /**
   *
   */
  class DashboardModel extends CI_Model
  {
    public function __construct() {
      parent::__construct();
      // Your own constructor code
    }

    public function usercount() {
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

    public function patientcount($keyword) {
      $q = $this->db
        ->select('COUNT(*) as count')
        ->from('patient')
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

    public function appointmentcount($keyword = '') {
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

  }


?>
