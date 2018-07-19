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

$numero = '4111111111111111';

$cartao = new Card($numero);

echo 'Numero = '.$numero;
echo "\nValido = ";

if ($cartao->validateCardNumber())
    echo 'SIM';
else
    echo 'NAO';

// Pula duas linhas no fim do output
echo "\n\n";
