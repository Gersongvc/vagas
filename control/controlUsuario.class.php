<?php
#iniciar_sessao
session_start();

#carregar as classes dinamicamente
include_once 'autoload.php';

#função para resolver problema de header
ob_start();

#define codificação
header('Content-Type: text/html; charset=UTF-8');

/**
 * Criado em 01/01/2015
 * Classe de controle do usuario
 * @author Sérgio Lima (professor.sergiolima@gmail.com)
 * @version 1.0.0
 */
class ControlUsuario extends ControlGeral {

    /**
     * Método utilizado para validar os dados dos usuarios cadastrados e invocar o método consultarUsuario no model
     * @access public 
     * @param String $nome nome do usuario
     * @return Array dados do usuario
     */
    function consultar($nome_usuario) {

        #invocar métódo  e passar parâmetros
        $objUsuario = new modelUsuario();
        return $listaUsuario = $objUsuario->consultarUsuario($id_usuario, $nome_usuario);
        var_dump($listaUsuario);
    }

    /**
     * Método utilizado validar os dados dos usuarios cadastrados e invocar o método inserirUsuario no model
     * @access public 
     * @param String $nome nome do usuario
      * @return Boolean retorna TRUE se os dados forem salvos com sucesso
     */
    function inserir($nome_usuario) {

        #invocar métódo  e passar parâmetros
        $objUsuario = new modelUsuario();

        #se for válido invocar o método de iserir
        if ($objUsuario->inserirUsuario($nome_usuario) == true) {
            #se for inserido com sucesso mostrar a mensagem
            $_SESSION['msg'] = "Inserido com sucesso!";
            #redirecionar
            header("location: ../view/modulo.php?modulo=usuario&menu=consultar");
        } else {
            $_SESSION['msg'] = "Erro ao inserir!";
            #redirecionar
            header("location: ../view/modulo.php?modulo=usuario&menu=consultar");
        }
    }

    /**
     * Método utilizado validar os dados dos usuarios e invocar o método alterarUsuario no model
     * @access public 
     * @param Int $id id do usuario
     * @return Boolean retorna TRUE se os dados forem salvos com sucesso
     */
    function alterar($id_usuario, $nome_usuario) {

        #invocar métódo  e passar parâmetros
        $objUsuario = new modelUsuario();

        if ($objUsuario->alterarUsuario($id_usuario, $nome_usuario) == true) {
            #se for alterado com sucesso mostrar a mensagem
            $_SESSION['msg'] = "Alterado com sucesso!";
            #redirecionar
            header("location: ../view/modulo.php?modulo=usuario&menu=consultar");
        } else {
            $_SESSION['msg'] = "Erro ao alterar!";
            #redirecionar
            header("location: ../view/modulo.php?modulo=usuario&menu=consultar");
        }
    }

    /**
     * Método utilizado para validar os dados dos usuarios e invocar o método excluirUsuario no model
     * @access public 
     * @param Int $id id do usuario
     * @return Boolean retorna TRUE se os dados for excluído sucesso
     */
    function excluir($id) {

        #invocar métódo  e passar parâmetros
        $objUsuario = new modelUsuario();

        #invocar métódo  e passar parâmetros
        if ($objUsuario->excluirUsuario($id_usuario) == true) {
            #se for excluído com sucesso mostrar a mensagem e redirecionar
            $_SESSION['msg'] = "Excluído com sucesso!";
            header("location: ../view/modulo.php?modulo=usuario&menu=consultar");
        } else {
            $_SESSION['msg'] = "Erro ao excluir!";
            header("location: ../view/modulo.php?modulo=usuario&menu=consultar");
        }
    }
}
