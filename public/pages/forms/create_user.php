<?php


require "../../../bootstrap.php";

//Caso retornar o valor vazio dentro dos campos, cria uma flash message.
if(isEmpty()){
    flash('message','Preencha todos os campos');

   return redirect("contato");
}


$validate = validate([
    'name' => 's',
    'lastname' => 's',
    'email' => 'e',
    'password' => 's',
]);



$cadastrado = create('users', $validate);


// if($cadastrado){
//     flash('message','Cadastrado com sucesso', 'success');

//     return redirect('create_user');
// }

// flash('messafe','Erro ao cadastrar usuário');

//     redirect('create_user');