<?php

if($_SERVER["REQUEST_METHOD"] == "POST" &&  $_SERVER['PHP_SELF'] == "/php crud with opps/portfolio.php"){
    if(isset($_POST['dlt']) && ($_POST['dlt'] == 'Delete')) {
        $obj=new query();
        $result=$obj->deleteData('users',$_POST['userId']);
    }
    if(isset($_POST['edit']) && ($_POST['edit'] == 'Edit')) {
        $_SESSION['editUser'] = $_POST['userId'];
        ?>
            <script type="text/javascript">location.href = 'edit.php';</script>
        <?php
    }
}

?>