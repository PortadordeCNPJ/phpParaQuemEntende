<?php

require "../../../bootstrap.php";

//Caso retornar o valor vazio dentro dos campos, cria uma flash message.
if(isEmpty()){
    flash('message','Preencha todos os campos');

   return redirect("contato");
}


$validate = validate([
    'name' => 's',
    'email' => 'e',
    'subject' => 's',
    'message' => 's',
]);


dd($validate->name);
