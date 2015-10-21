<?php

#inclui arquivo da classe de conexão
include_once '../model/modelConexao.class.php';

/**
 * Criado em <data de cricação>
 * Classe de CRUD com PDO para <nome do caso de uso>
 * @author <Nome do Autor> (<e-mail do autor>)
 * @version <versao da classe>
 */
class ModelUsuario extends modelConexao {

    /**
     * Atributos da classe
     */
    private $id_usuario;
    private $nome_usuario;

    /**
     * Métodos get e sets das classes
     */
    public function getId_usuario() {
        return $this->id_usuario;
    }

    public function getNome_usuario() {
        return $this->nome_usuario;
    }

    public function setId_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    public function setNome_usuario($nome_usuario) {
        $this->nome_usuario = $nome_usuario;
    }

    public function consultarUSuario($nome_usuario) {

        #setar os dados
        $this->setNome_usuario($nome_usuario);

        #montar a consultar (where true serve para selecionar todos os registros)
        $sql = "select * from tb_usuario where true";

        #verificar se foi passado algum valor de <parâmetro>   
        if ($this->getNome_usuario() != null) {
            $sql.= " and nome_usuario=:nome_usuario";
        }

        #executa consulta e controi um array com o resultado da consulta
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);

            #verificar se foi passado algum valor de :<nome campo> 
            if ($this->getNome_usuario() != null) {
                $query->bindValue(':nome_usuario', $this->getNome_usuario(), PDO::PARAM_SRT);
            }
            $query->execute();
            $this->resultado = $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {

            $this->resultado = null;
        }
        return $this->resultado;
    }

    /**
     * Método utilizado para <descrição>
     * @access public 
     * @param <tipo do parâmero> $<nome parâmetro> <descrição do parâmetro>
     * @return <tipo do retorno> <descrição do reorno>
     */
    function inserirUsuario($nome_usuario) {

        #setar os dados
        $this->setId_usuario(null);
        $this->setNome_usuario($nome_usuario);


        #montar a consulta
        $sql = "INSERT INTO tb_usuario(id_usuario,nome_usuario) VALUES (null,:nome_usuario)";

        #realizar a blidagem dos dados
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);
            $query->bindValue(':nome_usuario', $this->getNome_usuario(), PDO::PARAM_STR);
            $query->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    /**
     * Método utilizado para <descrição>
     * @access public 
     * @param <tipo do parâmero> $<nome parâmetro> <descrição do parâmetro>
     * @return <tipo do retorno> <descrição do reorno>
     */
    function alterarUsuario($id_usuario, $nome_usuario) {

        #setar os dados
        $this->setId_usuario($id_usuario);
        $this->setNome_usuario($nome_usuario);

        #montar a consulta
        $sql = "UPDATE tb_usuario SET nome_usuario = :nome_usuario WHERE id_usuario = :id_usuario";

        #realizar a blidagem dos dados
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);
            $query->bindValue(':id_usuario', $this->getId_usuario(), PDO::PARAM_INT);
            $query->bindValue(':nome_usuario', $this->getNome_usuario(), PDO::PARAM_SRT);
            $query->execute();
            return true;
        } catch (PDOException $e) {

            return false;
        }
    }

    /**
     * Método utilizado para <descrição>
     * @access public 
     * @param <tipo do parâmero> $<nome parâmetro> <descrição do parâmetro>
     * @return <tipo do retorno> <descrição do reorno>
     */
    function excluirUsuario($id_usuario) {

        #setar os dados
        $this->setId_usuario($id_usuario);

        #montar a consulta
        $sql = "DELETE FROM tb_usuario WHERE id_usuario = :id_usuario";

        #realizar a blidagem dos dados
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);
            $query->bindValue(':id_usuario', $this->getId_usuario(), PDO::PARAM_INT);
            $query->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

}
