<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_m extends CI_Model {

    var $id;
    var $ip_address;
    var $username;
    var $password;
    var $salt;
    var $email;
    var $activation_code;
    var $forgotten_password_code;
    var $forgotten_password_time;
    var $remember_code;
    var $created_on;
    var $last_login;
    var $active;
    var $first_name;
    var $last_name;
    var $company;
    var $phone;
    var $user_id;
    // Ajax 
    var $table = 'users';
    var $column_order = array('id', 'first_name', 'last_name', 'email', 'phone', 'active'); //set column field database for datatable orderable
    var $column_search = array('id', 'first_name', 'last_name', 'email', 'phone', 'company'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('active' => 'desc', 'id' => 'desc'); // default order 

    public function __construct() {
        parent::__construct();
        $this->load->model("Ion_auth_model");
    }

    private function _get_datatables_query() {
        $this->db->from($this->table);
        $i = 0;
        foreach ($this->column_search as $item) { // loop column 
            if ($_POST['search']['value']) { // if datatable send POST for search
                if ($i === 0) { // first loop
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) { // here order processing
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function get_datatables() {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered() {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all() {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function get_object($id = null) {
        if (empty($id)) {
            $user = $this->Ion_auth_model->user()->result_array();
        } else {

            $user = $this->Ion_auth_model->user($id)->result_array();
        }
        $user = $this->_changeToObject($user);
        return $user[0];
    }

    public function get_object_list() {
        $users = $this->ion_auth->users()->result_array();
        $users = $this->_changeToObject($users);
        return $users;
    }

    public function _changeToObject($result_db = '') {
        $object_lista = array();
        foreach ($result_db as $key => $value) {
            $object = new Usuario_m();
            $object->id = $value['id'];
            $object->ip_address = $value['ip_address'];
            $object->username = $value['username'];
            $object->password = $value['password'];
            $object->salt = $value['salt'];
            $object->email = $value['email'];
            $object->activation_code = $value['activation_code'];
            $object->forgotten_password_code = $value['forgotten_password_code'];
            $object->forgotten_password_time = $value['forgotten_password_time'];
            $object->remember_code = $value['remember_code'];
            $object->created_on = $value['created_on'];
            $object->last_login = $value['last_login'];
            $object->active = $value['active'];
            $object->first_name = $value['first_name'];
            $object->last_name = $value['last_name'];
            $object->company = $value['company'];
            $object->phone = $value['phone'];
            $object->user_id = $value['user_id'];
            $object_lista[] = $object;
        }
        return $object_lista;
    }

    public function get_full_name() {
        return "$this->first_name $this->last_name";
    }

    // Metodos para trabalhar com os grupos
    public function get_groups($id) {
        $groups = $this->ion_auth->get_users_groups($id)->result();
        return $groups;
    }

    public function get_groups_all() {
        return $this->db->get("groups")->result_array();
    }

    public function remove_from_group($group_ids = false, $user_id = false) {
        return $this->Ion_auth_model->remove_from_group($group_ids, $user_id);
    }

    public function add_to_group($group_ids, $user_id = false) {
        return $this->Ion_auth_model->add_to_group($group_ids, $user_id);
    }

}
