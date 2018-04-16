<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

# Fornece uma interface para a criaçao de objetos e deixa que as subclasses decidam quais classes instanciar
# Um produto e' especializado e suas especialidades tem seus objetos criados atraves das classes fabricas de objetos, com metodos comuns.

# A Essencia do padrao Factory e ter uma fabrica para cada tipo de produto.
# -- Fabrica EmpresaOnibusInterestadual para Produto PassagemOnibusInterestadual
# E em cada fabrica ter o metodo para criar o objeto.
#
# Esse padrao permite a criaçao de produtos sem conhecer os detalhes de como o produto sera criado;


# produto
abstract class Passagem {

    private $origem;
    private $destino;
    private $hora_partida;

    public function nova ($origem = null, $destino = null, DateTime $hora_partida = null) {
        $this->origem = $origem;
        $this->destino = $destino;
        $this->hora_partida = $hora_partida;
    }

    public function __get($name)
    {
        return isset($this->{$name}) ? $this->{$name} : false;
    }

    public abstract function exibeDetalhes();

}

# Especialidades

# Produto Concreto
class PassagemOnibusInterestadual extends Passagem {

    public function __construct($origem = null, $destino = null, DateTime $hora_partida = null) {
        parent::nova($origem, $destino, $hora_partida);
    }

    public function exibeDetalhes()
    {
        echo "Passagem de onibus Interestadual\n";
        echo "Saindo de {$this->__get('origem')}, para {$this->__get('destino')}, Data/Hora: {$this->__get('hora_partida')->format('d/m/Y H:i:s')}\n";

    }
}


# Fabricas

abstract class Empresa {
    public abstract function emitePassagem($origem, $destino, DateTime $hora_partida);
}

# Fabrica concreta
class EmpresaOnibusInterestadual extends Empresa {

    public function emitePassagem($origem, $destino, DateTime $hora_partida)
    {
        return new PassagemOnibusInterestadual($origem, $destino, $hora_partida);
    }
}

# Utilizaçao no app

class App {
    public function __construct()
    {
        $viacaoFreitas = new EmpresaOnibusInterestadual();
        $passagem = $viacaoFreitas->emitePassagem('Praia Grande', 'Sao Paulo', new DateTime());
        $passagem->exibeDetalhes();
    }
}

new App;