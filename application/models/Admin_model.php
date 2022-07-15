<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_model
{

    public function countUserAktif()
    {

        $query = $this->db->query(
            "SELECT COUNT(id_user) as jml_user
                               FROM mst_user
                               WHERE is_active = 1"
        );
        if ($query->num_rows() > 0) {
            return $query->row()->jml_user;
        } else {
            return 0;
        }
    }

    public function countUserTidakAktif()
    {

        $query = $this->db->query(
            "SELECT COUNT(id_user) as jml_user
                               FROM mst_user
                               WHERE is_active = 0"
        );
        if ($query->num_rows() > 0) {
            return $query->row()->jml_user;
        } else {
            return 0;
        }
    }

    public function countUserBulan()
    {

        $query = $this->db->query(
            "SELECT CONCAT(YEAR(date_created),'/',MONTH(date_created)) AS tahun_bulan, COUNT(*) AS count_bulan
                FROM mst_user
                WHERE CONCAT(YEAR(date_created),'/',MONTH(date_created))=CONCAT(YEAR(NOW()),'/',MONTH(NOW()))
                GROUP BY YEAR(date_created),MONTH(date_created);"
        );
        if ($query->num_rows() > 0) {
            return $query->row()->count_bulan;
        } else {
            return 0;
        }
    }

    public function countAllUser()
    {
        $query = $this->db->query(
            "SELECT COUNT(id_user) as count_all
                               FROM mst_user"
        );
        if ($query->num_rows() > 0) {
            return $query->row()->count_all;
        } else {
            return 0;
        }
    }

    public function getActivity($id_user)
    {
        $query = "SELECT *
                  FROM activity
                  WHERE user_activity = $id_user
                  ORDER BY id_activity DESC";
        return $this->db->query($query)->result_array();
    }

    public function getLaporan()
    {
        $query = "SELECT *
                  FROM tb_nota
                  LEFT JOIN tb_nota_selesai
                  ON tb_nota_selesai.nota_id_sewa = tb_nota.id_nota
                  ORDER BY tb_nota.id_nota DESC
                  ";
        return $this->db->query($query)->result_array();
    }

    public function getFilterLaporan($tanggal1, $tanggal2)
    {
        $query = "SELECT *
                  FROM tb_nota
                  LEFT JOIN tb_nota_selesai
                  ON tb_nota_selesai.nota_id_sewa = tb_nota.id_nota
                  WHERE DATE(tgl_nota) BETWEEN '$tanggal1' AND '$tanggal2'
                  ORDER BY tb_nota.id_nota DESC
                  ";
        return $this->db->query($query)->result_array();
    }
}
