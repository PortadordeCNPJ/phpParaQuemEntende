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

    if (!is_array($fields)) {
        $fields = (array) $fields;
    }

    //Vai inserir dentro da determinada tabela as informaçõs que vierem do field.
    $sql = "INSERT INTO {$table}";
    //Vai concatenar no sql os indices de cada campo dentro da tabela, separados por vírgula
    $sql .= "(" . implode(',', array_keys($fields)) . ")";
    $sql .= " values(" . ":" . implode(',:', array_keys($fields)) . ")";

    $pdo = connect();


    $insert = $pdo->prepare($sql);

    return $insert->execute($fields);
}

function all($table)
{
    $pdo = connect();

    $sql = "SELECT * FROM {$table}";
    $list = $pdo->query($sql);


    $list->execute();

    return $list->fetchAll();

}

function update($table, $fields, $where)
{
    if (!is_array($fields)) {
        $fields = (array) $fields;
    }

    $pdo = connect();

    //Array_map vai poder mapear e colocar : em todos os indices que precisam de :
    $data = array_map(function($field)
    {
        //array_map reorgarniza a forma com que as informações aparecem dentro do array
        return "$field = :{$field}";
    }, array_keys($fields));


    $sql = "UPDATE {$table} set ";

    $sql .=implode(',',$data);

    $sql .=" WHERE {$where[0]} = :{$where[0]}";

    // dd($sql);

    $data = array_merge($fields,[$where[0] => $where[1]]);

    $update = $pdo->prepare($sql);
    $update->execute($data);

    return $update->rowCount();
    
}

function find($table, $field, $value)
{
    $pdo = connect();

    $value = filter_var($value, FILTER_SANITIZE_NUMBER_INT);

    $sql = "SELECT * FROM {$table} WHERE {$field} = :{$field}";

    $find = $pdo->prepare($sql);
    $find->bindValue($field, $value);
    $find->execute();

    return $find->fetch();
}

function delete($table, $field, $value)
{
    $pdo = connect();

    $sql = "DELETE FROM {$table} WHERE {$field} = :{$field}";
    $delete = $pdo->prepare($sql);
    $delete->bindValue($field, $value);
    return $delete->execute();
}
