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

// Define o número do cartão
$numero = '4111111111111111';
// Cria um novo objeto Card
$cartao = new Card($numero);
// Imprime a validação
echo $cartao->getBank().': '.$numero.' (';
if ($cartao->validateCardNumber())
    echo "válido)\n";
else
    echo "inválido)\n";

// Pula uma linha no fim do output
echo "\n";
