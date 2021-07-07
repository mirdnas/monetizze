<?php 

class jogoClass 
{
    private $quantidadeDezenas; 
    private $resultado;
    private $totalJogos;
    private $jogos;

    function __construct($quantidadeDezenas,$totalJogos) {
        $this->setQuantidadeDezenas($quantidadeDezenas);
        $this->setTotalJogos($totalJogos);
    }

    private function getArrayDezenasSorteadas($dezenas = 0)
    {
        $arrayNumericoJogo = [];
        $dezenas = (empty($dezenas)) ? $this->getQuantidadeDezenas() : $dezenas;
        for ($i=1; $i <= $dezenas; $i++) { 
            $numeroRandomico = rand(1,60); 
            array_push($arrayNumericoJogo,$numeroRandomico);
        }    
        return $arrayNumericoJogo;
    }

    public function gerarJogoDaPessoa()
    {
        $quantidadeJogos = $this->getTotalJogos();
        $jogos = [];
        for ($i=0; $i <= $quantidadeJogos; $i++) { 
            $jogos[$i] = [
                'dezenas'=> $this->getQuantidadeDezenas(),
                'jogo' => $this->getArrayDezenasSorteadas()
            ]; ;
        }
        $this->setJogos($jogos); 
    }

    public function gerarResultadoSorteio()
    {
        $resultado = $this->getArrayDezenasSorteadas(6);
        $this->setResultado($resultado);
    }

    public function conferirJogos()
    {
        //aqui o metodo vai conferir os jogos
    }

    public function gerarTabelaResultadio()
    {
        $this->gerarJogoDaPessoa();
        $this->gerarResultadoSorteio();
        
        $resultado = implode( ' - ', $this->getResultado() );
        $jogos = $this->getJogos();
        $stringJogodaPessoa = '';
        foreach ($jogos as $value) { 
            $ganhou = false; 
            if( $value['jogo'] === $this->getResultado() )
            {
                $ganhou = true;
            }
            $ganhou = ($ganhou === true) ? 'Sim' : 'Não';
            $stringJogodaPessoa.= '
            <tr>
                <td>'.implode( ' - ', $value['jogo'] ).'</td>
                <td>'.$value['dezenas'].'</td> 
                <td>'.$ganhou.'</td> 
            </tr> 
            '; 
        }  
        $tabela = '
        <h3> O resultado foi: '.$resultado.' </h3>
        <p> Confira seus jogos: </p>
        <table border="1">
            <tr>
                <th>Jogos</th>
                <th>Quantidade de Dezenas</th> 
                <th>Ganhou</th> 
            </tr>
            '.$stringJogodaPessoa.'
        </table>
        ';
        return $tabela; 
    }

    public function getQuantidadeDezenas()
    {
        return $this->quantidadeDezenas;
    } 

    public function setQuantidadeDezenas($quantidadeDezenas)
    {
        $this->quantidadeDezenas = $quantidadeDezenas;
    }


    public function getResultado()
    {
        return $this->resultado;
    } 

    public function setResultado($resultado)
    {
        $this->resultado = $resultado;
    }


    public function getTotalJogos()
    {
        return $this->totalJogos;
    } 

    public function setTotalJogos($totalJogos)
    {
        $this->totalJogos = $totalJogos;
    }


    public function getJogos()
    {
        return $this->jogos;
    } 

    public function setJogos($jogos)
    {
        $this->jogos = $jogos;
    }

    
}

$teste = new jogoClass(8,4);
echo $teste->gerarTabelaResultadio(); 
