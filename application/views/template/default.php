<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>{titulo}</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {header}
    </head>
    <body>
        {menu}
        <div class="container" style="margin-top: 40px;">
            <!--Breadcrumb-->
            <div class="row">
                {breadcrumb}
            </div>
            <!--Conteudo-->
            <div class="row">
                {conteudo}
            </div>
        </div>
    </body>
</html>
