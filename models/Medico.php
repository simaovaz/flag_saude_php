<?php


class Medico {


    private $nome;
    private $id_medico;
    private $id_servico;
    private $id_especialidade;
    private $morada;
    private $telefone;

    public function __construct(string $nome,int $id_medico, int $id_especialidade, int $id_servico, string $morada, string $telefone){
        $this->nome =$nome;
        $this->id_medico= $id_medico;
        $this->id_especialidade= $id_especialidade;
        $this->id_servico= $id_servico;
        $this->morada= $morada;
        $this->telefone= $telefone;
    }
   

    public function getNome (){
        return $this-> nome;
    }
    public function getIdMedico (){
        return $this-> id_medico;
    }
    public function getIdEspecialidade (){
        return $this-> id_especialidade;
    }
    public function getMorada (){
        return $this-> morada;
    }
    public function getTelefone (){
        return $this-> telefone;
    }
    public function getIdServico (){
        return $this-> id_servico;
    }

    public function setNome(string $nome) : void 
    {
        if(strlen($nome)>2){
            $this->nome= $nome;
        }
        
    }
    public function setIdServico(int $novo_id_servico) :void
    {
        $this->id_servico= $novo_id_servico;
    }

    public function setIdEspecialidade(int $novo_id_especialidade) :void
    {
        $this->id_servico= $novo_id_especialidade;
    }

    public function setTelefone(int $novo_telefone) :void
    {
        $this->id_servico= $novo_telefone;
    }
    
    public function setMorada(int $novo_morada) :void
    {
        $this->id_servico= $novo_morada;
    }

}

//$Jose= new Medico("Jose Antonio", 4,3, 2, "Rua da Alegria", "912863752");

//var_dump($Jose-> getNome());


?>