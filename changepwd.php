<html>
<head>
<title>IC Radius Management :: Risultati Ricerca</title>
<link rel="shortcut icon" href="../skins/larry/images/favicon.ico"/>
<link rel="stylesheet" type="text/css" href="../skins/larry/styles.css?s=1364417489" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
</head>

<body>
<a href="http://radius.sra.mlib.cnr.it/" target="_self"><img src="../skins/larry/images/logo.png" id="logo" border="0" alt="IC Radius Management"><h1>IC Radius Management Interface</h1></a>

<table border="1" cellpadding="1" cellspacing="1" style="width: 500px;">

<?php
        include 'db.php';

        // La pagina visualizza.php mi ha passato il parametro "UserName"

        $parametro=$_REQUEST['UserName'];

        $conn = mysql_connect($db_data_host,$db_data_user,$db_data_password);
        if (!$conn) {
                die('Could not connect to RADIUS DB: ' . mysql_error());
        }
        mysql_select_db($db_data_dbname);
        $aa=mysql_query("SELECT UserName,password FROM userinfo where UserName = '$parametro'");
        $a=mysql_fetch_row($aa);
        if (!$a) {
                die('UserName non esistente: ' . mysql_error());
        }

?>
        <tbody>

        <form action="updatepwd.php">
        <p style="font-family:Century gothic, Verdana, Arial; font-size:12px; color:#0000A4; padding-left:0px">
                <input type="text" name="UserName" size="40" value="<?php echo $a[0]; ?>" readonly>  UserName<br />
                <input type="text" name="password" size="30" value="<?php echo $a[1]; ?>"> Password <br /><h3>
                <?php
                echo substr(str_shuffle('abcdefghijklmnopqrstuvwxyz0123456789'),0,8);
                echo "<br>";
                ?>
                <br></h3>
                <input type="submit" name="submit" value="Update">
        </p>
        </form>

        </tbody>


</table>

</body>
</html>

