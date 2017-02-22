<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        init_layout();
        set_layout('titulo', 'Home',FALSE);
        restrito_logado();
    }

    public function index() {
        set_layout('conteudo', load_content('home/index',NULL));
        load_layout();
    }
    
}
