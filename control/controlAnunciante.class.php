<?php
#iniciar_sessao
#session_start();
#carregar as classes dinamicamente
include_once 'autoload.php';

#função para resolver problema de header
ob_start();

#define codificação
header('Content-Type: text/html; charset=UTF-8');

/**
 * Criado em 01/01/2015
 * Classe de controle do anunciante
 * @author Sérgio Lima (professor.sergiolima@gmail.com)
 * @version 1.0.0
 */
class ControlAnunciante extends ControlGeral {

    /**
     * Método utilizado para validar os dados dos anunciantes cadastrados e invocar o método consultarAnunciante no model
     * @access public 
     * @param Int $id id do anunciante
     * @param String $nome nome do anunciante
     * @return Array dados do anunciante
     */
    function consultarAnunciantes($nome, $telefone, $email) {

        $objAnunciante = new modelAnunciante();
        return $listaAnunciante = $objAnunciante->consultarAnunciante($nome, $telefone, $email);
    }

    /**
     * Método utilizado validar os dados dos anunciantes cadastrados e invocar o método inserirAnunciante no model
     * @access public 
     * @param String $nome nome do anunciante
     * @param String $cpf CPF do anunciante
     * @param String $dtNascimento data de nascimento do anunciante
     * @param String $telefone telefone do anunciante
     * @return Boolean retorna TRUE se os dados forem salvos com sucesso
     */
    function inserir($nome, $endereco, $telefone, $email, $senha, $confirmar) {

        #invocar métódo  e passar parâmetros
        $objAnunciante = new modelAnunciante();

        #verificar senha
        if ($senha == $confirmar) {
            #salvar no banco
            $resultado = $objAnunciante->inserirAnunciante($nome, $endereco, $telefone, $email, md5($senha));
            if ($resultado == true) {
                echo 'Salvo com Sucesso';
            } else {
                echo 'Erro ao salvar';
            }
        } else {
            echo 'As senhas devem ser iguais';
        }
    }
    
        function inserirCadastro($nome, $endereco, $telefone, $email, $senha, $confirmar) {

        #invocar métódo  e passar parâmetros
        $objAnunciante = new modelAnunciante();

        #verificar senha
        if ($senha == $confirmar) {
            #salvar no banco
            $resultado = $objAnunciante->inserirAnunciante($nome, $endereco, $telefone, $email, md5($senha));
            if ($resultado == true) {
                $_SESSION ['msg'] = 'Inserido com sucesso';
                header("location: ../view/modulo.php?modulo=login");
            } else {
                echo 'Erro ao salvar';
            }
        } else {
            echo 'As senhas devem ser iguais';
        }
    }

    /**
     * Método utilizado validar os dados dos anunciantes e invocar o método alterarAnunciante no model
     * @access public 
     * @param Int $id id do anunciante
     * @param String $nome nome do anunciante
     * @param String $cpf CPF do anunciante
     * @param String $dtNascimento data de nascimento do anunciante
     * @param String $telefone telefone do anunciante
     * @return Boolean retorna TRUE se os dados forem salvos com sucesso
     */
    function alterarAnunciante($id_anunciante, $nome, $endereco, $telefone, $email) {

        #invocar métódo  e passar parâmetros
        $objAnunciante = new modelAnunciante();

        if ($objAnunciante->alterarAnunciante($id_anunciante, $nome, $endereco, $telefone, $email) == true) {
            #se for alterado com sucesso mostrar a mensagem
            $_SESSION['msg'] = "Alterado com sucesso!";
            #redirecionar
            header("location: ../view/modulo.php?modulo=anunciante&menu=consultar");
        } else {
            $_SESSION['msg'] = "Erro ao alterar!";
            #redirecionar
            header("location: ../view/modulo.php?modulo=anunciante&menu=consultar");
        }
    }

    /**
     * Método utilizado para validar os dados dos anunciantes e invocar o método excluirAnunciante no model
     * @access public 
     * @param Int $id id do anunciante
     * @return Boolean retorna TRUE se os dados for excluído sucesso
     */
    function excluirAnunciante($id_anunciante) {

        #invocar métódo  e passar parâmetros
        $objAnunciante = new modelAnunciante();

        #invocar métódo  e passar parâmetros
        if ($objAnunciante->excluirAnunciante($id_anunciante) == true) {
            #se for excluído com sucesso mostrar a mensagem e redirecionar
            $_SESSION['msg'] = "Excluído com sucesso!";
            header("location: ../view/modulo.php?modulo=anunciante&menu=consultar");
        } else {
            $_SESSION['msg'] = "Erro ao excluir!";
            header("location: ../view/modulo.php?modulo=anunciante&menu=consultar");
        }
    }

    /**
     * Método utilizado validar os dados dos anunciantes e invocar o método alterarAnunciante no model
     * @access public 
     * @param Int $id id do anunciante
     * @param String $nome nome do anunciante
     * @param String $cpf CPF do anunciante
     * @param String $dtNascimento data de nascimento do anunciante
     * @param String $telefone telefone do anunciante
     * @return Boolean retorna TRUE se os dados forem salvos com sucesso
     */
    function validarAnunciante($email, $senha) {

        #invocar métódo  e passar parâmetros
        $objAnunciante = new modelAnunciante();

        if ($objAnunciante->validarAnunciante($email, $senha) == true) {
            #Anunciante validado
            #Criar sessão
            $_SESSION['email'] = $email;
            $_SESSION['liberado'] = 'true';

            #redirecionar
            header("location: ../view/modulo.php?modulo=principal");
        } else {
            $_SESSION['liberado'] = null;
            $_SESSION['msg'] = "E-mail ou senha invalido";

            #redirecionar
            header("location: ../view/modulo.php?modulo=login");
        }
    }

}
