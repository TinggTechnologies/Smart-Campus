<?php

if($_SERVER['REQUEST_METHOD'] === 'POST'){
  if(isset($_POST['quality']) && !empty($_POST['quality'])){
    $quality = $_POST['quality'];
    echo htmlspecialchars($quality) ;
  }
}

