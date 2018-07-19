<?php

/**
 * Sistema que faz a validação de um número de cartão de crédito
 *
 * Autor: Amilton Fontoura de Camargo Junior
 * Data: Julho de 2018
 */

// Inclui a classe Card
include_once('Card.php');

// Imprime um cabeçalho no começo do output
echo "\n== TESTE DE NUMEROS DE CARTOES ==\n\n";

// Define os números dos cartões a serem testados
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
    
    // Remove o objeto Card da memória
    unset($cartao);
}

// Pula uma linha no fim do output
echo "\n";
