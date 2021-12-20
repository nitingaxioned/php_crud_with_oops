<!doctype html>
<!-- If multi-language site, reconsider usage of html lang declaration here. -->
<html lang="en">
<?php
  session_start();
  require 'assets/php/database.php';
  require 'assets/php/alter.php';
  if(!isset($_SESSION['userId'])){
    ?>
      <script type="text/javascript">location.href = 'index.php';</script>
    <?php
  }
?>
<head>
  <meta charset="utf-8">
  <title>Portfolio</title>
  <!-- View-port Basics: http://mzl.la/VYREaP -->
  <!-- This meta tag is used for mobile device to display the page without any zooming,
       so how much the device is able to fit on the screen is what's shown initially. 
       Remove comments from this tag, when you want to apply media queries to the website. -->
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <!-- Place favicon.ico in the root directory: mathiasbynens.be/notes/touch-icons -->
  <link rel="shortcut icon" href="favicon.ico" />
  <!--font-awesome link for icons-->
  <link rel="stylesheet" media="screen" href="assets/vendor/font-awesome/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Default style-sheet is for 'media' type screen (color computer display).  -->
  <link rel="stylesheet" media="screen" href="assets/css/style.css">
</head>
<?php 
  $obj=new query();
  $data = $obj->getData('users');
?>
<body>
  <!--container start-->
  <div class="container">
    <!--header section start-->
    <header>
      <form method="post" action="index.php" enctype="multipart/form-data">
        <input style="float:right;" type="submit" id="logout" name="logout" value="logout">
      </form>
      <p>Portfolio</p>
    </header>
    <!--header section start-->
    <!--main section start-->
    <main>
      <div class="wrapper">
        <ul class="cards">
          <?php
            if(isset($data['0'])){
              $id=1;	
              foreach($data as $item){
          ?>
          <li class="card">
            <img src="<?php echo $item['Image'];?>" alr="user">
            <div class="card-txt">
              <p style="font-size:18px"><?php echo $item['id']; ?></p>
              <p>Name : <?php echo $item['name']; ?></p>
              <p>Gender : <?php echo $item['gender']; ?></p>
              <p>E-mail : <?php echo $item['email']; ?></p>
              <p>Pnone No. : <?php echo $item['phone']; ?></p>
            </div>
            <?php if ($_SESSION['userId'] == $item['id'] || $_SESSION['role'] == "admin") {?>
              
            <div class="controls">
              <form method="post" action="portfolio.php" enctype="multipart/form-data">
                <input type="submit" id="edit-btn" name="edit" value="Edit">
                <input type="submit" id="dlt-btn" value="Delete" name="dlt">
                <input type="hidden" id="userId" name="userId" value="<?php echo $item['id']; ?>">
              </form>
            </div>
            <?php }?>
          </li>
            <?php
              $id++;
              } 
            } else {
            ?>
                <tr>
                  <li>No Records Found!</li>
                </tr>
            <?php } ?>
        </ul>
      </div>
    </main>
    <!--main section end-->
    <!--footer section start-->
    <footer>
      <p>Created By NDG.</p>
    </footer>
    <!--footer section end-->
  </div>
  <!--container end-->
  <script src="assets/js/script.js"></script>
</body>

</html>