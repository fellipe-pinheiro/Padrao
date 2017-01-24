<h1>Acesso restrito</h1>
<?php
if (!empty($this->session->userdata("restrito_grupo"))) {
    print "<h4>Restrito aos grupos:</h4>";
    print "<ul>";
    foreach ($this->session->userdata("restrito_grupo") as $value) {
        print "<li>$value</li>";
    }
    print "</ul>";
}
?>
<button class="btn btn-primary" onclick="window.history.back();">Voltar</button>