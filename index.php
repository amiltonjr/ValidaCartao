<?php

/**
 * Sistema que faz a validação de um número de cartão de crédito
 *
 * Autor: Amilton Fontoura de Camargo Junior
 * Data: Julho de 2018
 */

include_once('ValidaCartao.php');

// Pula uma linha no começo do output
echo "\n";

$cartao = new ValidaCartao();

$numero = '4111111111111111';

echo 'Numero = '.$numero;
echo "\nValido = ";

if ($cartao->validateCardNumber($numero))
    echo 'SIM';
else
    echo 'NAO';

// Pula duas linhas no fim do output
echo "\n\n";
