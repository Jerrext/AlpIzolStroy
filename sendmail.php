<?php
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;

  require 'phpmailer/src/Exception.php';
  require 'phpmailer/src/PHPMailer.php';

  $mail = new PHPMailer(true);
  $mail->CharSet = 'UTF-8';
  $mail->setLanuage('ru', 'phpmailer/language/');
  $mail->IsHTML(true);

  //От кого письмо
  $mail->setForm('info@site.com', 'АльпИзолСтрой');
  //Кому отправить
  $mail->addAddress('admin@gmail.com');
  //Тема письма
  $mail->Subject = 'Письмо с сайта!';

  //Тело письма
  $body = "<h1>Вопрос с сайта АльпИзолСтой!</h1>";

  if(trim(!empty($_POST['name1']))) {
    $body.="<p>Имя: ".$_POST['name1']."</p>";
  }
  if(trim(!empty($_POST['tel1']))) {
    $body.="<p>Телефон: ".$_POST['tel1']."</p>";
  }
  if(trim(!empty($_POST['question']))) {
    $body.="<p>Вопрос: ".$_POST['question']."</p>";
  }

  $mail->Body = $body;

  //Отправка
  if (!$mail->send()) {
    $message = 'Ошибка';
  } else {
    $message = 'Данные отправлены';
  }

  $response = ['message' => $message];

  header('Content-type: application/json');
  echo json_encode($response);
?>