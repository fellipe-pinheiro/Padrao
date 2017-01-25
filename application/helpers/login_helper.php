<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// Necessario estar logado no sistema
// Direcionar para pagina de logim
// Apos logar ir para pagina solicitada antes
function restrito_logado() {
    $CI = & get_instance();
    if (!$CI->ion_auth->logged_in()) {
        $CI->session->set_userdata(array('redirecionar' => current_url()));
        redirect('Login');
    }
}

// Necessario estar no(s) grupo(s)
// TODO mostrar messagem que e necessario estar no grupo solicitado 
// TODO opção para voltar para pagina anterior
function restrito_grupo($group) {
    restrito_logado();
    $CI = & get_instance();
    if (!$CI->ion_auth->in_group($group)) {
        $CI->session->set_userdata(array('redirecionar' => current_url()));
        $CI->session->set_userdata(array('restrito_grupo' => $group));
        redirect('usuario/restrito_grupo', 'refresh');
    }
}

// Verificar se esta logado
function esta_logado() {
    $CI = & get_instance();
    if ($CI->ion_auth->logged_in()) {
        return TRUE;
    } else {
        return FALSE;
    }
}

function get_dados_usuario($atributo) {
    $CI = & get_instance();
    $user = $CI->ion_auth->user()->row();
    return $user->$atributo;
}
