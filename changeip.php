
<html>
<head>
<title>RadiusGUI :: Benvenuto</title>
<link rel="shortcut icon" href="favicon.ico"/>
<link rel="stylesheet" type="text/css" href="styles.css?s=1364417489" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
</head>

<body>
<img src="logo.png" id="logo" border="0" alt="RadiusGUI"><h1>RadiusGUI Interface</h1>

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
        $aa=mysql_query("SELECT UserName,ip FROM userinfo where UserName = '$parametro'");
        $a=mysql_fetch_row($aa);
        if (!$a) {
                die('UserName non esistente: ' . mysql_error());
        }
        $bb=mysql_query("SELECT pool from ip where address='$a[1]'");
        $b=mysql_fetch_row($bb);
        if (!$b) {
               die('Pool IP non esistente: ' . mysql_error());
        }

?>
        <tbody>

        <form action="updatepool.php">
        <p style="font-family:Century gothic, Verdana, Arial; font-size:12px; color:#0000A4; padding-left:0px">
                <input type="text" name="UserName" size="40" value="<?php echo $a[0]; ?>" readonly>  UserName<br />
                <input type="text" name="ip" size="30" value="<?php echo $a[1]; ?>" readonly> IP attuale<br />
                <input type="text" name="oldpool" size="30" value="<?php echo $b[0]; ?>" readonly> Pool attuale<br />
                <br>
                <select size="1" name="newpool" >
                <?php
                $cc=mysql_query("SELECT distinct (pool) as pool from ip");
                while ($c=mysql_fetch_row($cc)) {
                        echo"<option>$c[0]</option>";
                }
                ?>
                </select> Nuovo pool Indirizzo IP<br />
                <br>
                <input type="submit" name="submit" value="Update">
        </p>
        </form>

        </tbody>


</table>

</body>
</html>

