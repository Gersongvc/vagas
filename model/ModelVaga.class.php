<?php

#inclui arquivo da classe de conexão
include_once '../model/modelConexao.class.php';

/**
 * Criado em <data de cricação>
 * Classe de CRUD com PDO para <nome do caso de uso>
 * @author <Nome do Autor> (<e-mail do autor>)
 * @version <versao da classe>
 */
class ModelVaga extends modelConexao {

    /**
     * Atributos da classe
     */
    private $id_vaga;
    private $uf;
    private $cidade;
    private $endereco;
    private $vagaspara;
    private $tipo;
    private $preco;
    private $alugado;
    private $observacoes;

    /**
     * Métodos get e sets das classes
     */
    function getId_vaga() {
        return $this->id_vaga;
    }

    function getUf() {
        return $this->uf;
    }

    function getCidade() {
        return $this->cidade;
    }

    function getEndereco() {
        return $this->endereco;
    }

    function getVagaspara() {
        return $this->vagaspara;
    }

    function getTipo() {
        return $this->tipo;
    }

    function getPreco() {
        return $this->preco;
    }

    function getAlugado() {
        return $this->alugado;
    }

    function getObservacoes() {
        return $this->observacoes;
    }

    function setId_vaga($id_vaga) {
        $this->id_vaga = $id_vaga;
    }

    function setUf($uf) {
        $this->uf = $uf;
    }

    function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    function setEndereco($endereco) {
        $this->endereco = $endereco;
    }

    function setVagaspara($vagaspara) {
        $this->vagaspara = $vagaspara;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    function setPreco($preco) {
        $this->preco = $preco;
    }

    function setAlugado($alugado) {
        $this->alugado = $alugado;
    }

    function setObservacoes($observacoes) {
        $this->observacoes = $observacoes;
    }

    /**
     * Método utilizado para <descrição>
     * @access public 
     * @param <tipo do parâmero> $<nome parâmetro> <descrição do parâmetro>
     * @return <tipo do retorno> <descrição do reorno>
     */
    function inserirVaga($uf, $cidade, $endereco, $vagaspara, $tipo, $preco, $alugado, $observacoes) {

        #setar os dados
        $this->setUf($uf);
        $this->setCidade($cidade);
        $this->setEndereco($endereco);
        $this->setVagaspara($vagaspara);
        $this->setTipo($tipo);
        $this->setPreco($preco);
        $this->setAlugado($alugado);
        $this->setObservacoes($observacoes);

        #montar a consulta
        $sql = "INSERT INTO tb_vaga(id_vaga, uf, cidade, endereco, vagaspara, tipo, preco, alugado, observacoes) VALUES "
                . "(null, :uf, :cidade, :endereco, :vagaspara, :tipo, :preco, :alugado, :observacoes)";

        #realizar a blidagem dos dados
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);
            $query->bindValue(':uf', $this->getUf(), PDO::PARAM_STR);
            $query->bindValue(':cidade', $this->getCidade(), PDO::PARAM_STR);
            $query->bindValue(':endereco', $this->getEndereco(), PDO::PARAM_STR);
            $query->bindValue(':vagaspara', $this->getVagaspara(), PDO::PARAM_STR);
            $query->bindValue(':tipo', $this->getTipo(), PDO::PARAM_STR);
            $query->bindValue(':preco', $this->getPreco(), PDO::PARAM_STR);
            $query->bindValue(':alugado', $this->getAlugado(), PDO::PARAM_STR);
            $query->bindValue(':observacoes', $this->getObservacoes(), PDO::PARAM_STR);
            $query->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function excluirVaga($id_vaga) {

        #setar os dados
        $this->setId_anunciante($id_vaga);

        #montar a consulta
        $sql = "DELETE FROM tb_vaga WHERE id_anunciante =:id_vaga";

        #realizar a blidagem dos dados
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);
            $query->bindValue(':id_vaga', $this->getId_vaga(), PDO::PARAM_INT);
            $query->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

}
