<?php

 try{


  $db = new PDO("mysql:host=localhost;dbname=umitbasa_login;charset=utf8;","umitbasa_login","UcI}gpzSBu;i");


 }catch(PDOException $e){

   print $e->getMessage();
 }


   function post($post){

      $security = strip_tags(trim(addslashes($_POST[$post])));

      return $security;
   }

   function alert($icon,$title,$text){
     $data["icon"] = $icon;
     $data["title"] = $title;
     $data["text"]  = $text;
     echo json_encode($data);
   }

   function email($email){

         if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
           $type = 1;
         }else{
           $type = 0;
         }
     return $type;
   }



 ?>
