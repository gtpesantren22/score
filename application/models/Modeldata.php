<?php
class Modeldata extends CI_Model
{
    function simpan($table, $data)
    {
        $this->db->insert($table, $data);
    }

    function getAll($table)
    {
        return $this->db->get($table);
    }

    function getBy($table, $where, $dtwhere)
    {
        $this->db->where($where, $dtwhere);
        return $this->db->get($table);
    }
    function getBy2($table, $where, $dtwhere, $where1, $dtwhere1)
    {
        $this->db->where($where, $dtwhere);
        $this->db->where($where1, $dtwhere1);
        return $this->db->get($table);
    }
    function getBy3($table, $where, $dtwhere, $where1, $dtwhere1, $where3, $dtwhere3)
    {
        $this->db->where($where, $dtwhere);
        $this->db->where($where1, $dtwhere1);
        $this->db->where($where3, $dtwhere3);
        return $this->db->get($table);
    }
    function getBy4($table, $where, $dtwhere, $where1, $dtwhere1, $where3, $dtwhere3, $where4, $dtwhere4)
    {
        $this->db->where($where, $dtwhere);
        $this->db->where($where1, $dtwhere1);
        $this->db->where($where3, $dtwhere3);
        $this->db->where($where4, $dtwhere4);
        return $this->db->get($table);
    }

    function getByOrd($table, $where, $dtwhere, $ordr, $ls)
    {
        $this->db->where($where, $dtwhere);
        $this->db->order_by($ordr, $ls);
        return $this->db->get($table);
    }
    function getOrd($table, $ordr, $ls)
    {
        $this->db->order_by($ordr, $ls);
        return $this->db->get($table);
    }

    function hapus($table, $where, $dtwhere)
    {
        $this->db->where($where, $dtwhere);
        $this->db->delete($table);
    }

    function ubah($table, $where, $dtwhere, $data)
    {
        $this->db->where($where, $dtwhere);
        $this->db->update($table, $data);
    }
}
