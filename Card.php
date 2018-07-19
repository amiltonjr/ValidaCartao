<?php

/**
 * Classe que faz a validação de um número de cartão de crédito
 * e identifica o banco emissor/bandeira.
 *
 * Autor: Amilton Fontoura de Camargo Junior
 * Data: Julho de 2018
 */
class Card {
    
    // Atributos da classe
    private $card_number    = 0;
    private $card_bank      = '';
    private $isValid        = false;
    private $B_AMEX         = 'AMEX';
    private $B_DISCOVER     = 'Discover';
    private $B_MASTERCARD   = 'MasterCard';
    private $B_VISA         = 'VISA';
    private $B_DESCONHECIDO = 'Desconhecido';
    
    // Método construtor
    function __construct($number='') {
        // Adiciona o número do cartão e faz a validação do mesmo
        $this->setCardNumber($number);
    }
    
    // Método que define o número do cartão
    private function setCardNumber($number='') {
        // Remove espaços, quebras de linha e tabulações do valor recebido
        $number = $this->prepareCardNumber($number);
        
        // Verifica se o atributo number é válido, de acordo com as regras
        $this->isValid = $this->validateCardNumber($number);
        
        // Salva o número no atributo da classe
        $this->card_number = $number;

        // Identifica o banco emissor
        $this->card_bank = $this->getCardBank($number);
    }
    
    // Método que valida o número de um cartão de crédito
    public function validateCardNumber($number='') {
        // Pega o número do atributo da classe, se nenhum foi passado via parâmetro
        if ($number == '')
            $number = $this->card_number;
        
        // Remove espaços, quebras de linha e tabulações do valor recebido
        $number = $this->prepareCardNumber($number);
        
        // Verifica se o número é válido, de acordo com as regras básicas
        if (!is_numeric($number) || strlen($number) < 13 || strlen($number) > 16)
            return false;
        
        // Verifica se o cartão cumpre as regras de formatação do banco emissor/bandeira
        if  (
                !((strlen($number) == 15 && (substr($number, 0, 2) == '34' || substr($number, 0, 2) == '37')) // AMEX
                || (strlen($number) == 16 && substr($number, 0, 4) == '6011') // Discover
                || (strlen($number) == 16 && (substr($number, 0, 2) == '51' || substr($number, 0, 2) == '55')) // MasterCard
                || (substr($number, 0, 1) == '4' && (strlen($number) == 13 || strlen($number) == 16))) // Visa
            )
            return false;
        
        // Faz a validação pelo algoritmo Luhn

        // Inverte a sequência de números
        $n_rev = strrev($number);
        
        // Inicializa as variáveis auxiliares
        $aux    = array();
        $total  = 0;
        
        // Dobra o valor de cada número em posição de índice ímpar e guarda no array
        for ($i=0; $i<strlen($n_rev); $i++)
            if ($i > 0 && $i % 2 != 0) {
                // Dobra o valor
                $value = (int) $n_rev[$i] * 2;
                
                // Se value for maior do que 9, subtrai o mesmo por 9
                if ($value > 9)
                    $aux[] = $value - 9;
                else
                    $aux[] = $value;
            } else
                $aux[] = (int) $n_rev[$i];
        
        // Faz a somatória de todos os números do array
        foreach ($aux as $n)
            $total += (int) $n;
        
        // Verifica se a soma é um número múltiplo de 10
        if ($total %10 != 0)
            return false;
        
        return true;
    }
    
    // Método que limpa um número de cartão recebido
    private function prepareCardNumber($number='') {
        // Efetua as substituições
        return str_replace(array(' ', '.', ',', '-', "\n", "\t"), '', trim($number));
    }
    
    // Método que identifica o nome do banco emissor/bandeira do cartão
    private function getCardBank($number='') {
        // Pega o número do atributo da classe, se nenhum parâmetro for passado
        if ($number == '')
            $number = $this->card_number;

        // AMEX
        if (substr($number, 0, 2) == '34' || substr($number, 0, 2) == '37')
            return $this->B_AMEX;
        
        // Discover
        else if (substr($number, 0, 4) == '6011')
            return $this->B_DISCOVER;
        
        // MasterCard
        else if (substr($number, 0, 2) == '51' || substr($number, 0, 2) == '55')
            return $this->B_MASTERCARD;
        
        // Visa
        else if (substr($number, 0, 1) == '4')
            return $this->B_VISA;
        
        // Desconhecido
        else
            return $this->B_DESCONHECIDO;
    }
    
    // Método que retorna com o número do cartão salvo
    public function getNumber() {
        return $this->card_number;
    }
    
    // Método que retorna com o nome do banco emissor/bandeira do cartão
    public function getBank() {
        return $this->card_bank;
    }
    
    // Método que verifica se o número do cartão é válido
    public function isValidCard() {
        return $this->isValid;
    }
    
}
