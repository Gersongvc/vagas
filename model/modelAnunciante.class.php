<?php

#inclui arquivo da classe de conexão
include_once '../model/modelConexao.class.php';

/**
 * Criado em <data de cricação>
 * Classe de CRUD com PDO para <nome do caso de uso>
 * @author <Nome do Autor> (<e-mail do autor>)
 * @version <versao da classe>
 */
class ModelAnunciante extends modelConexao {

    /**
     * Atributos da classe
     */
    private $id_anunciante;
    private $nome;
    private $endereco;
    private $telefone;
    private $email;
    private $senha;

    /**
     * Métodos get e sets das classes
     */
    public function getId_anunciante() {
        return $this->id_anunciante;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getEndereco() {
        return $this->endereco;
    }

    public function getTelefone() {
        return $this->telefone;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function setId_anunciante($id_anunciante) {
        $this->id_anunciante = $id_anunciante;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setEndereco($endereco) {
        $this->endereco = $endereco;
    }

    public function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    /**
     * Método utilizado para <descrição>
     * @access public 
     * @param <tipo do parâmero> $<nome parâmetro> <descrição do parâmetro>
     * @return <tipo do retorno> <descrição do reorno>
     */
    function consultarAnunciante($nome, $telefone, $email) {

#setar os dados
        $this->setNome($nome);
        $this->setTelefone($telefone);
        $this->setEmail($email);

//        echo $this->getNome();
//        echo $this->getTelefone();
//        echo $this->getEmail();
//        
//        break;
#montar a consultar (where true serve para selecionar todos os registros)
        $sql = "SELECT * FROM tb_anunciante WHERE TRUE";


#verificar se foi passado algum valor de <parâmetro>   
        if ($this->getNome() != null) {
            $sql.= " and nome like :nome";
        }

        if ($this->getTelefone() != null) {
            $sql.= " and telefone=:telefone";
        }

        if ($this->getEmail() != null) {
            $sql.= " and email=:email";
        }
#executa consulta e controi um array com o resultado da consulta
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);

#verificar se foi passado algum valor de :<nome campo> 
            if ($this->getNome() != null) {
                $query->bindValue(':nome', "%" . $this->getNome() . "%", PDO::PARAM_STR);
            }

            if ($this->getTelefone() != null) {
                $query->bindValue(':telefone', $this->getTelefone(), PDO::PARAM_STR);
            }

            if ($this->getEmail() != null) {
                $query->bindValue(':email', $this->getEmail(), PDO::PARAM_STR);
            }

            $query->execute();
            $this->resultado = $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $e->getMessage();

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
    function inserirAnunciante($nome, $endereco, $telefone, $email, $senha) {

        #setar os dados
        $this->setNome($nome);
        $this->setEndereco($endereco);
        $this->setTelefone($telefone);
        $this->setEmail($email);
        $this->setSenha($senha);

        #montar a consulta
        $sql = "INSERT INTO tb_anunciante(id_anunciante, nome, endereco, telefone, email, senha)"
                . " VALUES (null,:nome,:endereco,:telefone,:email,:senha)";

        #realizar a blidagem dos dados
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);
            $query->bindValue(':nome', $this->getNome(), PDO::PARAM_STR);
            $query->bindValue(':endereco', $this->getEndereco(), PDO::PARAM_STR);
            $query->bindValue(':telefone', $this->getTelefone(), PDO::PARAM_STR);
            $query->bindValue(':email', $this->getEmail(), PDO::PARAM_STR);
            $query->bindValue(':senha', $this->getSenha(), PDO::PARAM_STR);
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
    public function alterarAnunciante($id_anunciante, $nome, $endereco, $telefone, $email) {

        #setar os dados
        $this->setId_anunciante($id_anunciante);
        $this->setNome($nome);
        $this->setEndereco($endereco);
        $this->setTelefone($telefone);
        $this->setEmail($email);
        #montar a consulta
        $sql = "UPDATE  tb_anunciante  SET  nome=:nome, endereco=:endereco, telefone=:telefone, email=:email WHERE id_anunciante=:id_anunciante";

        #realizar a blidagem dos dados
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);
            $query->bindValue(':id_anunciante', $this->getId_anunciante(), PDO::PARAM_INT);
            $query->bindValue(':nome', $this->getNome(), PDO::PARAM_STR);
            $query->bindValue(':endereco', $this->getEndereco(), PDO::PARAM_STR);
            $query->bindValue(':telefone', $this->getTelefone(), PDO::PARAM_STR);
            $query->bindValue(':email', $this->getEmail(), PDO::PARAM_STR);
            $query->execute();
            return true;
        } catch (PDOException $e) {
 echo $e->getMessage();
 break;
            return false;
        }
    }

    /**
     * Método utilizado para <descrição>
     * @access public 
     * @param <tipo do parâmero> $<nome parâmetro> <descrição do parâmetro>
     * @return <tipo do retorno> <descrição do reorno>
     */
    public function excluirAnunciante($id_anunciante) {

        #setar os dados
        $this->setId_anunciante($id_anunciante);

        #montar a consulta
        $sql = "DELETE FROM tb_anunciante WHERE id_anunciante =:id_anunciante";

        #realizar a blidagem dos dados
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);
            $query->bindValue(':id_anunciante', $this->getId_anunciante(), PDO::PARAM_INT);
            $query->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

}
