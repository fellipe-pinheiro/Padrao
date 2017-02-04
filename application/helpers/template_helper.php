<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Enviar email usando template existente
 *
 * @param   string|array    $para       destinatario
 * @param   string          $template   view/template/email/
 * @param   array           $view_data  dados para prencher o template
 * @param   string          $assunto    assunto do email
 * @param   string|array    $cc         Copia congunta
 * @param   string|array    $co         Copia oculta
 * @return  bollean
 */
function email_send($para, $template, $view_data, $assunto = null, $cc = null, $co = null) {
    $CI = & get_instance();
    if (empty($para) || empty($template) || empty($view_data)) {
        return NULL;
    }

    if (empty($assunto))
        $assunto = "Notificação OrcaSistemas";

    $CI->load->library('email');

    $CI->email->from('notificacao@orcasistemas.com.br', 'Notificação OrcaSistemas');
    $CI->email->to($para);
    $CI->email->subject($assunto);
    if (!empty($cc))
        $this->email->cc($cc);
    if (!empty($co))
        $this->email->bcc($co);

    $message = $CI->load->view("template/email/" . $template, array('view_data' => $view_data), true);
    $CI->email->message($message);

    $send = $CI->email->send();

    return $send;
}
