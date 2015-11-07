<?php

#iniciar_sessao
#session_start();
#função para resolver problema de header
ob_start();

#define codificação
header('Content-Type: text/html; charset=UTF-8');

/**
 * Criado em 01/01/2015
 * Classe de controle geral
 * @author Sérgio Lima (professor.sergiolima@gmail.com)
 * @version 1.0.0
 */
class ControlGeral {

    /**
     * Método utilizado para transforma para para o formato brasileiro
     * @access public 
     * @param Date $data data no formato americado (Y-m-d)
     * @return Date data no formato brasileiro (d/m/Y)
     */
    function dataBrasileiro($data) {

        if ($data == null) {
            return '';
        } else {
            return date('d/m/Y', strtotime($data));
        }
    }

    /**
     * Método utilizado para transforma para para o formato americado
     * @access public 
     * @param Date $data data no formato brasileiro (d/m/Y) 
     * @return Date data no formato americano (Y-m-d)
     */
    function dataAmericano($data) {

        if ($data == null) {
            return '';
        } else {
            return date('Y-m-d)', strtotime($data));
        }
    }

    /**
     * Método utilizado para transforma para validar e-mail
     * @access public 
     * @param String $email e-mail a ser validado
     * @return Boolean retorna TRUE se o e-mail for válido
     */
    public static function validarEmail($email) {
        return preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $email);
    }

    /**
     * Método utilizado para mostrar mensagens do sistema
     * @access public 
     * @param String $msg mensagem a ser exibida
     */
    function alerta($msg) {
        $alerta = '';
        if (!empty($msg)) {
            $alerta = '<div class="alert alert-info">';
            $alerta.='<button type="button" class="close" data-dismiss="alert">×</button>';
            $alerta.='<strong>Informação: </strong>' . $msg . '</div>';
            echo $alerta;
        }
        unset($_SESSION['msg']);
    }

    /**
     * Método utilizado para mostrar o menu do sistema
     * @access public 
     * @param String $nomeSistema nome do sistema a ser exibido
     */
    function menu($nomeSistema = 'Temos Vagas') {
        echo' <!--Static navbar -->';
        echo' <nav class = "navbar navbar-default">';
        echo' <div class = "container-fluid">';
        echo' <div class = "navbar-header">';
        echo' <button type = "button" class = "navbar-toggle collapsed" data-toggle = "collapse" data-target = "#navbar" aria-expanded = "false" aria-controls = "navbar">';
        echo' <span class = "sr-only"></span>';
        echo' <span class = "icon-bar"></span>';
        echo' <span class = "icon-bar"></span>';
        echo' <span class = "icon-bar"></span>';
        echo' </button>';
        echo' <a class = "navbar-brand" href = "modulo.php?modulo=principal">' . $nomeSistema . '</a>';
        echo' </div>';
        echo'  <div id = "navbar" class = "navbar-collapse collapse">';
        echo' <ul class = "nav navbar-nav">';
        echo' <li class = "active"><a href = "modulo.php?modulo=principal">Principal</a></li>';

        #menu Anunciante
        echo' <li class = "dropdown">';
        echo'  <a href = "#" class = "dropdown-toggle" data-toggle = "dropdown" role = "button" aria-haspopup = "true" aria-expanded = "false">Anunciante<span class = "caret"></span></a>';
        echo'  <ul class = "dropdown-menu">';
        echo' <li><a href = "modulo.php?modulo=anunciante&menu=consultar"><i class="icon-large icon-search"></i>Consultar</a></li>';
        echo'  <li><a href = "modulo.php?modulo=anunciante&menu=cadastrar">Inserir</a></li>';
        echo' </ul>';
        echo' </li>';

        #menu usuário
        echo' <li class = "dropdown">';
        echo'  <a href = "#" class = "dropdown-toggle" data-toggle = "dropdown" role = "button" aria-haspopup = "true" aria-expanded = "false">Vagas<span class = "caret"></span></a>';
        echo'  <ul class = "dropdown-menu">';
        echo' <li><a href = "modulo.php?modulo=vagas&menu=consultar"><i class="icon-large icon-search"></i>Consultar</a></li>';
        echo'  <li><a href = "modulo.php?modulo=vagas&menu=inserir">Inserir</a></li>';
        echo' </ul>';
        echo' </li>';

        echo' </ul>';
        echo'<ul class="nav navbar-nav navbar-right">';
        echo'<li class="dropdown">';
        echo' <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">' . $_SESSION['email'] . ' <span class="caret"></span></a>';
        echo'<ul class="dropdown-menu">';
        echo'<li><a href="../view/modulo.php?modulo=login">Sair</a></li>';
        echo' </ul>';
        echo'</li>';
        echo'</ul>';
        echo' </div><!--/.nav-collapse -->';
        echo' </div><!--/.container-fluid -->';
        echo' </nav>';
    }

    function validarSessao() {
        if ($_SESSION['liberado'] == null) {
            header("location: ../view/modulo.php?modulo=login");
        }
    }

    function destruirSessao(){
        $_SESSION['email'] = null;
        $_SESSION['liberado'] = null;
    }
    
}
