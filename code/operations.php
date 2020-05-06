<?php
require_once'db.php';
@session_start();
@ob_start();


if(isset($_POST["register"])){

    $email = post('register');
    $username = post('username');
    $pass = post('pass');
    $pass2 = post('pass2');


    if($email == "" || $username == "" || $pass == "" || $pass2 == ""){

         alert("error","Hata","Lütfen Boş Alan Bırakmayınız");

    }else if(email($email)){

         alert("error","Hata","Emailiniz Geçerli Değil");

    }else if(strlen($pass) < 6){

          alert("error","Hata","Şifreniz 6 Karakterden Fazla Olmalı");

    }else if($pass != $pass2){

          alert("error","Hata","Şifreleriniz Eşleşmiyor");

    }else{
      $register = $db->prepare("INSERT INTO users SET email=?,username=?,password=?");
      $register->execute(array($email,$username,sha1(md5($pass))));

      if($register){

        alert("success","Başarılı","Başarıyla Kayıt Oldunuz");

      }else{

        $data["title"] = "Bir Sorun Oluştu";
        $data["icon"] = "error";
        echo json_encode($data);

      }
    }







}else if(isset($_POST["login"])){

      $email = post('login');
      $pass = post('pass');

      if($email == "" || $pass == ""){
        alert("error","Hata","Lütfen Boş Alan Bırakmayınız");
      }else if(email($email)){
        alert("error","Hata","Email Adresiniz Geçerli Değildir");
      }else{

        $gir = $db->prepare("SELECT * FROM users WHERE email=? and password=?");
        $gir->execute(array($email,sha1(md5($pass))));

        if($gir->rowCount()){
               
              $_SESSION["access"] = post('login');

              alert("success","Başarılı","Başarıyla Giriş Yaptınız");

        }else{

               alert("error","Hata","Email Adresiniz Veya Şifreniz Hatalı");

        }

      }

}


 ?>
