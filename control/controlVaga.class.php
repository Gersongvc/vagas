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
 * Classe de controle do anunciante
 * @author Sérgio Lima (professor.sergiolima@gmail.com)
 * @version 1.0.0
 */
class ControlVaga extends ControlGeral {


    /**
     * Método utilizado validar os dados dos anunciantes cadastrados e invocar o método inserirAnunciante no model
     * @access public 
     * @param String $nome nome do anunciante
     * @param String $cpf CPF do anunciante
     * @param String $dtNascimento data de nascimento do anunciante
     * @param String $telefone telefone do anunciante
     * @return Boolean retorna TRUE se os dados forem salvos com sucesso
     */
    function inserir($uf, $cidade, $endereco, $vagaspara, $tipo, $preco, $alugado, $observacoes) {

        #invocar métódo  e passar parâmetros
        $objVaga = new modelVaga();
        
            #salvar no banco
            $resultado = $objVaga->inserirVaga($uf, $cidade, $endereco, $vagaspara, $tipo, $preco, $alugado, $observacoes);
            if ($resultado==true)
            {
                echo 'Salvo com Sucesso';
            }
            else
            {
                echo 'Erro ao salvar';
            }
        
    

}
}