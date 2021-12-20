<?php

$nameErr = $phoneErr = $mailErr = $passErr = $confPassErr = $fileErr = $logmail_err = $logpass_err = "";
$name = $phone = $mail = $pass = $confPass = $file = "";
$genM = "checked";
$genF = "unchecked";
$flag = false;
if($_SERVER["REQUEST_METHOD"] == "POST" &&  $_SERVER['PHP_SELF'] == "/php crud with opps/register.php"){
    
  if($_POST['gender'] == "Female"){
    $genM = "unchecked";
    $genF = "checked";
  } else {
    $genM = "checked";
    $genF = "unchecked";
  }
  $name = $_POST['name'];
  $phone = $_POST['phone'];
  $mail = $_POST['mail'];
  $pass = $_POST['password'];
  $confPass = $_POST['conform-password'];
  if (isset($_POST['submit'])) {
    if(validate()) {
      $flag = true;
    }
  }
  if (isset($_POST['clear'])) {
    $nameErr = $phoneErr = $mailErr = $passErr = $confPassErr = $fileErr = "";
    $name = $phone = $mail = $pass = $confPass = $file = "";
    $genM = "checked";
    $genF = "unchecked";
  }
} else if($_SERVER["REQUEST_METHOD"] == "POST" &&  $_SERVER['PHP_SELF'] == "/php crud with opps/index.php") {
    if(isset($_POST['mail'])) {
      $mail = $_POST['mail'];
    } 
    if(isset($_POST['password'])) {
      $pass = $_POST['password'];
    }
    if(isset($_POST['submit']) && logValidate()) {
        $flag = true;
    }
    if(isset($_POST['clear'])) {
        $mailErr = $logpass_err ="";
        $mail = $pass = "";
    }
    if(isset($_POST['logout'])) {
      session_unset();
      session_destroy();
      ?>
        <script type="text/javascript">location.href ='index.php';</script>
      <?php
    }
} else if($_SERVER["REQUEST_METHOD"] == "POST" &&  $_SERVER['PHP_SELF'] == "/php crud with opps/edit.php") {
  if(isset($_POST['cancel'])) {
    backToPorfolio();
  }
  if(isset($_POST['save']) && reValidate()) {
    $obj=new query();
    $data_arr=array('name'=>$_POST['name'], 'phone'=>$_POST['phone'], 'email'=>$_POST['mail'], 'password'=>$_POST['password'], 'gender'=>$_POST['gender']);
    $result=$obj->updateData('users',$data_arr,'id',$_SESSION['editUser']);
    if (isset($_POST['makeAdmin'])&&($_POST['makeAdmin'] == 'admin')) {
      $data_arr=array('role' => 'admin');
      $result=$obj->updateData('users',$data_arr,'id',$_SESSION['editUser']);
    } else {
      $data_arr=array('role' => 'user');
      $result=$obj->updateData('users',$data_arr,'id',$_SESSION['editUser']);
      if($_SESSION['editUser'] == $_SESSION['userId']){
        $_SESSION['role'] = 'user';
      }
    }
    backToPorfolio();
  }
}

if($_SERVER['PHP_SELF'] == "/php crud with opps/edit.php") {
  $objx=new query();
  $arr = array("id" => $_SESSION['editUser'] );
  $resultx = $objx->getData('users','*',$arr);
  foreach($resultx as $item){
    $name = $item['name'];
    $phone = $item['phone'];
    $mail = $item['email'];
    $pass = $item['password'];
    $confPass = $item['password'];
    if($item['gender'] == 'Female') {
      $genF = "checked";
      $genM = "unchecked";
    }
    if($item['role']=='admin') {
      $adminVal = 'checked';
    } else {
      $adminVal = 'unchecked';
    }
  }
}

if($flag) {
    if($_SERVER['PHP_SELF'] == "/php crud with opps/register.php") {
        $obj=new query();
        $data_arr=array('name'=>$_POST['name'], 'phone'=>$_POST['phone'], 'email'=>$_POST['mail'], 'password'=>$_POST['password'], 'gender'=>$_POST['gender'],'Image'=>"uplodede/".$_FILES['file']['name']);
        $result = $obj->insertData('users',$data_arr);
        $objx=new query();
        sleep(1);
        $resultx = $objx->getData('users','*',$data_arr);
        foreach($resultx as $item){
          $_SESSION["userId"] = $item['id'];
          $_SESSION["role"] = $item['role'];
        }
    }
    ?>
    <script type="text/javascript">location.href = 'portfolio.php';</script>
    <?php
}

function reValidate(){
  $flag = 0;
  nameValidate() || $flag++ ;
  phoneValidate() || $flag++ ;
  mailValidate() || $flag++ ;
  editmailValidate() || $flag++;
  passValidate() || $flag++ ;
  confPassValidate() || $flag++ ;
  return $flag == 0;
}

function validate(){
  $flag = 0;
  nameValidate() || $flag++ ;
  phoneValidate() || $flag++ ;
  mailValidate() || $flag++ ;
  registerdMailValidate() || $flag++ ;
  passValidate() || $flag++ ;
  confPassValidate() || $flag++ ;
  fileValidate() || $flag++ ;
  ($flag == 0) && move_uploaded_file($_FILES['file']['tmp_name'] ,"uplodede/".$_FILES['file']['name']);
  return $flag == 0;
}

function nameValidate() { 
  if (trim($_POST['name']) != "") {
    if (preg_match("/^[A-Za-z ]+$/",$_POST['name'])) {
        return true;
    } else {
      $GLOBALS['nameErr'] = "This name is invalid";
      return false;
    }
  } else {
    if ($_POST['name'] == "") {
      $GLOBALS['nameErr'] = "The name is required";
      return false;
    } else {
      $GLOBALS['nameErr'] = "The name can't be blank space";
      return false;
    }
  } 
}

function phoneValidate() { 
  if (trim($_POST['phone']) != "") {
    if (preg_match("/^[6789]\d{9}$/",$_POST['phone'])) {
        return true;
    } else {
      $GLOBALS['phoneErr'] = "This phone number is invalid";
      return false;
    }
  } else {
    if ($_POST['phone'] == "") {
      $GLOBALS['phoneErr'] = "The phone number is required";
      return false;
    } else {
      $GLOBALS['phoneErr'] = "The phone number can't be blank space";
      return false;
    }
  }  
}

function mailValidate() { 
  if (trim($_POST['mail']) != "") {
    if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
      $GLOBALS['mailErr'] = "This email is invalid";
      return false;
    }
  } else {
    if ($_POST['mail'] == "") {
      $GLOBALS['mailErr'] = "The email is required";
      return false;
    } else {
      $GLOBALS['mailErr'] = "The email can't be blank space";
      return false;
    }
  } 
}

function passValidate() { 
  $pass = $_POST['password'];
  if (trim($pass) != "") {
    $flag = 0;
    if (strlen($pass) < 8) {
      $GLOBALS['passErr'] = "The Password must be at least 8 characters in length.";
      $flag++;
      return false;
    }
    if (!preg_match('@[a-z]@', $pass)) {
      $GLOBALS['passErr'] = "The Password must contain at least one lower case letter.";
      $flag++;
      return false;
    }
    if (!preg_match('@[A-Z]@', $pass)) {
      $GLOBALS['passErr'] = "The Password must contain at least one upper case letter.";
      $flag++;
      return false;
    }
    if (!preg_match('@[0-9]@', $pass)) {
      $GLOBALS['passErr'] = "The Password must contain at least one number";
      $flag++;
      return false;
    }
    if (!preg_match('@[^\w]@', $pass)) {
      $GLOBALS['passErr'] = "The Password must contain at least one special character.";
      $flag++;
      return false;
    }
    return ($flag == 0);
  } else {
    if ($_POST['mail'] == "") {
      $GLOBALS['passErr'] = "The password is required";
      return false;
    } else {
      $GLOBALS['passErr'] = "The password can't be blank space";
      return false;
    }
  }
}

function confPassValidate() { 
  if($_POST['conform-password'] == $_POST['password']){
    return true;
  } else {
    $GLOBALS['confPassErr'] = "The Password dose not matched.";
    return false;
  } 
}

function fileValidate() {
  if(isset($_FILES['file'])) {
    if($_FILES['file']['name'] == "") {
      $GLOBALS['fileErr'] = "Please Select your Profile Picture";
      return false;
    }
    $temp = explode(".",$_FILES['file']['name']);
    if(strcasecmp($temp[count($temp)-1], "jpg") != 0) {
      $GLOBALS['fileErr'] = "Please Select .jpg Picture file only";
      return false;
    } 
    if($_FILES['file']['size'] > 15360) {
      $GLOBALS['fileErr'] = "Please Select file with maximum size of 15Kb only";
      echo $_FILES['file']['size'];
      return false;
    } else {
      return true;
    }
  }
}

function logValidate(){
  $flag = false;
    if(mailValidate()) {
      if(registerdMailLogValidate() && logPassValidate()){
        $objx = new query();
        $data = array("email" => $_POST['mail']);
        $resultx = $objx->getData('users','*' ,$data);
        foreach($resultx as $item){
          $_SESSION["userId"] = $item['id'];
          $_SESSION["role"] = $item['role'];
        }
        $flag = true;
      }
    }
    return $flag;
}

function registerdMailLogValidate() {
  if(checkMail()) {
    return true;
  } else {
    $GLOBALS['mailErr'] = "This email is not registerd.";
    return false;
  }
}

function logPassValidate() {
  $flag = false;
  $objx = new query();
  $data = array("email"=>$_POST['mail']);
  $resultx = $objx->getData('users','*' ,$data);
  foreach($resultx as $item){
   if($item['password'] == $_POST['password']) {
    $flag = true;
   } 
  }
  if(!$flag) {
    $GLOBALS['logpass_err'] = "entered password is not matched" ;
    return false;
  } else {
    return true;
  }
}

function registerdMailValidate(){
  if(checkMail()) {
    $GLOBALS['mailErr'] = "This email is alredy registerd.";
    return false;
  } else {
    return true;
  }
}

function checkMail(){
  $flag = false;
  $objx=new query();
  $resultx = $objx->getData('users');
  foreach($resultx as $item){
   if( $item['email'] == $_POST['mail']) {
      $flag = true;
   }
  }
  return $flag;
}

function editmailValidate() {
  $flag = true;
  $objx=new query();
  $resultx = $objx->getData('users');
  foreach($resultx as $item){
   if( $item['email'] == $_POST['mail']) {
     if ($item['id'] != $_SESSION['editUser']){
      $GLOBALS['mailErr'] = "This email is already in use with another account.";
      $flag = false;
     }
    }
  }
  return $flag;
}

function backToPorfolio(){
    unset($_SESSION['editUser']);
    ?>
      <script type="text/javascript">location.href ='portfolio.php';</script>
    <?php
}

?>