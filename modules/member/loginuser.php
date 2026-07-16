<?php
if (isset($_POST["login"])) {
    include "koneksi.php";
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sqlm = mysqli_query($con, "SELECT * FROM member WHERE username='$username' AND password='$password'");
    $rm = mysqli_fetch_array($sqlm);
    $row = mysqli_num_rows($sqlm);

    if ($row > 0) {
        session_start();
        $_SESSION["usermbr"] = $rm["username"];
        $_SESSION["passmbr"] = $rm["password"];
        echo "<div align='center' class='alert alert-success'>
                <strong>LOGIN SUCCES!</strong>
            </div>";
    } else {
        echo "<div align='center' class='alert alert-danger'>
                <strong>LOGIN GAGAL!</strong>
            </div>";
    }

    echo "<META HTTP-EQUIV='Refresh' Content='1; URL=?r=loginuser'>";
}
?>
<fieldset>
    <div class="col-md-6 col-md-offset-3">
        <form name="form1" method="post" action="" enctype="multipart/form-data">
            <br>
            <center style="font-family:GreyscaleBasic;font-weight:bold;">
                <font color="#cccccc">Form Login</font>
            </center>

            <div class="panel panel-info" style="opacity:0.9">
                <div class="panel-heading">
                    <div class="panel-title " align="center">
                        <i class="glyphicon glyphicon-user"></i> LOGIN MEMBER
                    </div>
                </div>
                <div class="panel-body">
                    <div style="padding:25px">
                        <div class="row clearfix">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input type="text" class="form-control" id="username" name="username"
                                        placeholder="username">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="password">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <button type="submit" name="login" value="login"
                        class="btn btn-info btn-block btn-md"><i class="glyphicon glyphicon-log-in"></i> LOGIN </button>
                </div>
            </div>
        </form>
    </div>
</fieldset>
<br>
<br>
