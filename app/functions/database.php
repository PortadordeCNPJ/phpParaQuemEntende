<?php


function connect()
{
    //Aqui estamos atribuindo e criando o PDO, passando para ele as informações que nós colocamos dentro de config.php
    $pdo = new \PDO("mysql:host=localhost;dbname=db_phpparaquementende;charset=utf8", 'root', '');


    //Esse setAttribute, mostra os tipos que os erros iram aparecer quando der um tipo de erro
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //Esse setAttribute, mostra as informações que vem das tabelas, como objeto e não como array
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);


    return $pdo;
}

function create($table, $fields)
{
    // $pdo = connect();

    if (!is_array($fields)) {
        $fields = (array) $fields;
    }

    //Vai inserir dentro da determinada tabela as informaçõs que vierem do field.
    $sql = "INSERT INTO {$table}";
    //Vai concatenar no sql os indices de cada campo dentro da tabela, separados por vírgula
    $sql.="(" . implode(',', array_keys($fields)) . ")";
    $sql.=" values(" . implode(',:', array_keys($fields)) . ")";

    dd($sql);
}

function update()
{
}

function find()
{
}

function delete()
{
}
