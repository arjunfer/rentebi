<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_model
{
    public function getActivity($id_user)
    {
        $query = "SELECT *
                  FROM activity
                  WHERE user_activity = $id_user
                  ORDER BY id_activity DESC";
        return $this->db->query($query)->result_array();
    }

    public function getNoNota()
    {
        $this->db->select('RIGHT(no_nota,3) as kode', FALSE);
        $this->db->order_by('id_nota', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('tb_nota');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }
        $kodemax = str_pad($kode, 3, "0", STR_PAD_LEFT);
        $kodejadi = 'SW' . date('ymd') . $kodemax;
        return $kodejadi;
    }

    public function getDetailNota($id_nota)
    {
        $query = "SELECT *
                  FROM tb_nota
                  JOIN mst_sepeda
                  ON mst_sepeda.id_sepeda = tb_nota.sepeda_id
                  WHERE tb_nota.id_nota = $id_nota
                  ";
        return $this->db->query($query)->row_array();
    }

    public function getDetailBiaya($id_nota)
    {
        $query = "SELECT *
                  FROM detail_nota
                  LEFT JOIN tb_nota
                  ON tb_nota.id_nota = detail_nota.nota_id
                  LEFT JOIN mst_biaya
                  ON mst_biaya.id_biaya = detail_nota.biaya_id
                  WHERE tb_nota.id_nota = $id_nota
                  ";
        return $this->db->query($query)->result_array();
    }

    public function getTotalDetail($id_nota)
    {
        $this->db->select_sum('sub_total');
        $this->db->where('nota_id', $id_nota);
        $query = $this->db->get('detail_nota');
        if ($query->num_rows() > 0) {
            return $query->row()->sub_total;
        } else {
            return NULL;
        }
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
