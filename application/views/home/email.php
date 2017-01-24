<?php

$this->load->library('email');
$config['protocol'] = 'smtp';
$config['smtp_host'] = 'ssl://smtp.gmail.com';
$config['smtp_port'] = '465';
$config['smtp_timeout'] = '7';
$config['smtp_user'] = 'fellipe6900@gmail.com';
$config['smtp_pass'] = '**';
$config['charset'] = 'utf-8';
$config['newline'] = "\r\n";
$config['mailtype'] = 'text'; // or html
$config['validation'] = TRUE; // bool whether to validate email or not      

$this->email->initialize($config);

$this->email->from('fellipe6900@gmail.com', 'myname');
$this->email->to('fellipe6900@gmail.com');

$this->email->subject('Email Test');
$this->email->message('Testing the email class.');

var_dump($this->email->send());

print $this->email->print_debugger();
