<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
    <?php
        if($_SERVER['PHP_SELF'] == '/php crud with opps/edit.php') {
            echo "<strong>User ID - ".$_SESSION['editUser'];
            echo "</strong><br>";
        }
    ?>
    <div class="form-group">
        <label for="name">Name :</label>
        <input type="text" id="name" name="name" value="<?php echo $name ?>">
        <span class="error hide-me name-err">
            <?php echo $nameErr ?>
        </span>
    </div>
    <div class="form-group">
        <label for="phone">Phone Number:</label>
        <input type="text" id="phone" name="phone" value="<?php echo $phone ?>">
        <span class="error hide-me phone-err">
            <?php echo $phoneErr ?>
        </span>
    </div>
    <div class="form-group">
        <label for="mail">E-mail:</label>
        <input type="text" id="mail" name="mail" value="<?php echo $mail ?>">
        <span class="error hide-me mail-err">
            <?php echo $mailErr ?>
        </span>
    </div>
    <div class="form-group">
        <label class="gender-lable">Gender:</label>
        <input type="radio" name="gender" id="gender-male" value="Male" <?php echo $genM;?>>
        <label for="gender-male">Male</label>
        <input type="radio" name="gender" id="gender-female" value="Female" <?php echo $genF;?>>
        <label for="gender-female">Female</label>
    </div>
    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" value="<?php echo $pass ?>">
        <span class="error hide-me password-err">
            <?php echo $passErr ?>
        </span>
    </div>
    <div class="form-group">
        <label for="conform-password">Conform Password:</label>
        <input type="password" id="conform-password" name="conform-password" value="<?php echo $confPass ?>">
        <span class="error hide-me conform-password-err">
            <?php echo $confPassErr ?>
        </span>
    </div>
    <?php
        if($_SERVER['PHP_SELF'] != '/php crud with opps/edit.php') {
    ?>
    <div class="form-group">
        <label for="file">Select your Profile Picture :</label>
        <input type="file" id="file" name="file">
        <span class="error hide-me file-err">
            <?php echo $fileErr ?>
        </span>
    </div>
    <div class="form-controls">
        <input type="submit" id="submit-btn" name="submit" value="submit">
        <input type="submit" id="clear-btn" value="clear" name="clear">
    </div> 
    <?php
       } else {
            if ($_SESSION['role'] == 'admin') {
            ?>
            <div class="form-group">
                <input type="checkbox" name="makeAdmin" id="makeAdmin" value='admin' <?php echo $adminVal;?> >
                <label for="makeAdmin">Make Admin</label>
            </div> 
            <?php
            }
            ?>
    <div class="form-controls">
        <input type="submit" id="submit-btn" name="save" value="save">
        <input type="submit" id="clear-btn" value="cancel" name="cancel">
    </div> 
    <?php
       }
    ?>
    <input type="hidden" name="page" id="page" value="<?php echo $_SERVER['PHP_SELF'];?>">
</form>