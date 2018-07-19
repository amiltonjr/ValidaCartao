<?php

/**
 * Sistema que faz a validação de um número de cartão de crédito
 *
 * Autor: Amilton Fontoura de Camargo Junior
 * Data: Julho de 2018
 */

// Inclui a classe Card
include_once('Card.php');

// Pula uma linha no começo do output
echo "\n";

// Define os números dos cartões
$numeros = array('4111111111111111', '4111111111111', '4012888888881881', 
    '378282246310005', '6011111111111117', '5105105105105100', 
    '5105105105105106', '9111111111111111');

// Percorre cada um dos números
foreach ($numeros as $numero) {
    // Cria um objeto Card
    $cartao = new Card($numero);
    
    // Imprime a validação
    echo $cartao->getBank().': '.$cartao->getNumber().' (';
    if ($cartao->isValidCard())
        echo "válido)\n";
    else
        echo "inválido)\n";
    
    // Remove o objeto da memória
    unset($cartao);
}

// Pula uma linha no fim do output
echo "\n";
