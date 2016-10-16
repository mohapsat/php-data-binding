<?php

  $db = new mysqli('localhost','root','','app');

  // echo $db->connect_errno;

  if($db->connect_errno) {
      // echo 'ERROR CODE: '. $db->connect_errno;
      die("Sorry, we're having issues connecting to the database at the moment!");
  }

?>
