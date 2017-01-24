<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sistema extends CI_Controller {

    public function __construct() {
        parent::__construct();
        init_layout();
        set_layout('titulo', 'Sistema');
    }

    public function index() {
        set_layout('conteudo', load_content("Sistema/index"));
        load_layout();
    }

}
