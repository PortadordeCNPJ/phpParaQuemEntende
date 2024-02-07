<?php

//Função para validar os campos do formulario
function validate(array $fields)
{
    //A variavel request recebe a função request que pega as informações do formulario para ver se é POST ou GET
    $request = request();
    $validate = [];

    //Validação dos campos passando por cada campo dentro do foreach
    foreach ($fields as $field => $type) {
        switch ($type) {
            case 's':
                $validate[$field] =  filter_var($request[$field], FILTER_SANITIZE_STRING);
                break;

            case 'i':
                $validate[$field] =  filter_var($request[$field], FILTER_SANITIZE_NUMBER_INT);
                break;

            case 'e':
                $validate[$field] =  filter_var($request[$field], FILTER_SANITIZE_EMAIL);
                break;
        }
    }

    return (object)$validate;
}


//Função para encontrar algum campo vazio que o usuário deixou
function isEmpty()
{
    $request = request();
    
    $empty = false;

    foreach ($request as $key => $value) {
        if(empty($request[$key])){
            $empty = true;
        }
    }

    return $empty;
}