<?php

#carrega as classes automaticamente
include_once 'autoload.php';

#verifica qual modulo e qual e qual menu é o escolhido
$modulo = $_GET["modulo"];
$menu = $_GET["menu"];

switch ($modulo) {

    #modulo login
    case 'login':
        include 'index.php';
        break;

    #modulo anunciante
    case 'anunciante':
        switch ($menu) {

            #menu Consultar
            case 'consultar':
                include 'consultarAnunciante.php';
                break;

            #menu inserir 
            case 'cadastrar':
                include 'inserirAnunciante.php';
                break;

            #menu alterar
            case 'alterar':
                include 'alterarAnunciante.php';
                break;
        }
        break;

    #modulo vagas
    case 'vagas':
        switch ($menu) {
            #menu consultar
            case 'consultar':
                include 'consultarVaga.php';
                break;
            #menu inserir
            case 'inserir':
                include 'inserirVaga.php';
                break;
        }
        break;

//    case '<nome modulo>':
//        switch ($menu) {
//            #menu consultar
//            case 'consultar':
//                include '<nome da view>.php';
//                break;
//            #menu inserir
//            case 'inserir':
//                include '<nome da view>.php';
//                break;
//        }
//        break;

    default:
        #menu padrão
        include 'principal.php';
        break;
}
