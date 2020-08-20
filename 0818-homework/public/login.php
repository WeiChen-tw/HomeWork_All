<?php
session_start();
if (isset($_GET["logout"])) {
    session_unset();    
    $sUserName = "Guest";
    //setcookie("userName", "Guest", time() - 3600);
    header("Location: login.php");
    exit();
}

if (isset($_POST["btnHome"])) {
    header("Location: index.php");
    exit();
}

if (isset($_POST["btnLogin"])) {
    $sUserName = $_POST["txtUserName"];
    if (trim($sUserName) != "") {
        $_SESSION["userName"] = $sUserName;
        //setcookie("userName", $sUserName);
        if (isset($_SESSION["lastPage"]))
            header(sprintf("Location: %s", $_SESSION["lastPage"]));
        else
            header("Location: admin.php");
        exit();
    }
}

?>


<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/jquery.toast.css">
    <title>News - Login</title>
</head>

<body>
    <form id="form1" name="form1" method="post" action="login.php">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                </div>
                <div class="col-sm-4">
                    <table class=table>                        
                        <tbody>
                            <tr class = "container text-center">
                                <td>會員系統 - 登入</td>
                               
                            </tr>
                            <tr class = " text-center">
                                <td>帳號</td>
                                <td valign="baseline"><input type="text" name="txtUserName" id="txtUserName" /></td>                                
                            </tr>
                            <tr class = " text-center">
                                <td>密碼</td>
                                <td valign="baseline"><input type="password" name="txtPassword" id="txtPassword" /></td>                             
                            </tr>                         
                            <tr class = "container text-center">
                                <td>
                                    <input class="btn btn-success" type="submit" name="btnLogin" id="btnLogin" value="登入" />
                                    <input class="btn btn-success" type="reset" name="btnReset" id="btnReset" value="重設" />
                                    <input class="btn btn-success" type="submit" name="btnHome" id="btnHome" value="回首頁" />
                                </td>
                            </tr>
                    </table>
                </div>
                <div class="col-sm-4">
                </div>
            </div>
        </div>

    </form>
</body>

</html>