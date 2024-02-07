<?php


// function send($data){
//     $to = 'guilhermedesouzamuller@gmail.com';
//     $subject = $data->subject;
//     $message = $data->message;
//     $headers = "From: {$data->email}" . "\r\n" .
//     'Reply-To: guilhermedesouzamuller@gmail.com' . "\r\n" . 
//     'X-Mailer: PHP/' . phpversion();

//    return mail($to, $subject, $message, $headers);
// }


function send(array $data)
{
    $email = new PHPMailer\PHPMailer\PHPMailer;
	$email->CharSet = 'UTF-8';
	$email->SMTPSecure = 'plain';
	$email->isSMTP();
	$email->Host = 'sandbox.smtp.mailtrap.io';
	$email->Port = 465;
	$email->SMTPAuth = true;
	$email->Username = '54e0923eef89f5';
	$email->Password = '1781d5f9b9728a';
	$email->isHTML(true);
	$email->setFrom('guilhermedesouzamuller@gmail.com');
	$email->FromName = $data['quem'];
	$email->addAddress($data['para']);
	$email->Body = $data['mensagem'];
	$email->Subject = $data['assunto'];
	$email->AltBody = 'Para ver esse email tenha certeza de estar vendo em um programa que aceita ver HTML';
	$email->MsgHTML($data['mensagem']);

    return $email->send();
}