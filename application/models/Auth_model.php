<?php

class Auth_model extends CI_Model
{
    private $_table = "user";
    const SESSION_KEY = 'id_user';

    public function rules()
    {
        return [
            [
                'field' => 'username',
                'label' => 'Username or Email',
                'rules' => 'required'
            ],
            [
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required|max_length[255]'
            ]
        ];
    }

    public function login($username, $password)
    {
        $this->db->where('username', $username);
        $query = $this->db->get($this->_table);
        $user = $query->row();

        if (!$user) {
            return FALSE;
        }

        if (!password_verify($password, $user->password)) {
            return FALSE;
        }

        if ($user->aktif === 'T') {
            return FALSE;
        }

        $this->session->set_userdata([self::SESSION_KEY => $user->id_user]);

        return $this->session->has_userdata(self::SESSION_KEY);
    }

    public function current_user()
    {
        if (!$this->session->has_userdata(self::SESSION_KEY)) {
            return null;
        }

        $id_user = $this->session->userdata(self::SESSION_KEY);
        $query = $this->db->get_where($this->_table, ['id_user' => $id_user]);
        return $query->row();
    }

    public function logout()
    {
        $this->session->unset_userdata(self::SESSION_KEY);
        return !$this->session->has_userdata(self::SESSION_KEY);
    }

    // private function _update_last_login($id)
    // {
    //     $data = [
    //         'last_login' => date("Y-m-d H:i:s"),
    //     ];

    //     return $this->db->update($this->_table, $data, ['id' => $id]);
    // }

    function cekUser($str)
    {
        $this->db->where('username', $str);
        $this->db->from('user');
        return $this->db->get();
    }

    function tambah($table, $data)
    {
        $this->db->insert($table, $data);
    }
}
