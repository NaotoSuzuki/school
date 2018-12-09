<?php

/**
 * database.php
 * 2018/09/18
 */
function h($string)
{
    return htmlspecialchars($string, ENT_QUOTES, 'utf-8');
}

function connect()
{
    $dsn = 'mysql:host=localhost;dbname=sample;charset=utf8mb4;';
    $username = 'root';
    $password = 'password';
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];
    $pdo = new PDO($dsn, $username, $password, $options);
    return $pdo;
}
