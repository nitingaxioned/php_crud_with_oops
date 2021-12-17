<!doctype html>
<!-- If multi-language site, reconsider usage of html lang declaration here. -->
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Login</title>
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

<body>
  <!--container start-->
  <div class="container">
    <!--header section start-->
    <header>
      <p>Login</p>
    </header>
    <!--header section start-->
    <!--main section start-->
    <main>
      <div class="wrapper">
        <form method="post" action="login.php" enctype="multipart/form-data">
          <div class="form-group">
            <label for="mail">E-mail:</label>
            <input type="text" id="mail" name="mail" value="<?php ?>">
            <span class="error hide-me mail-err"><?php ?></span>
          </div>
          <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" value="<?php ?>">
            <span class="error hide-me password-err"><?php ?></span>
          </div>
          <div class="form-controls">
            <input type="submit" id="submit-btn" name="submit" value="submit">
            <input type="submit" id="clear-btn" value="clear" name="clear">
          </div>
        </form>
      <div style="text-align: center;">
        <a href="register.php" title="Register Now">Register Now</a>
      </div>
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