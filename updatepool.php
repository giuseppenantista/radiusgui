<html>
<head>
<title>IC Radius Management :: Benvenuto</title>
<link rel="shortcut icon" href="../skins/larry/images/favicon.ico"/>
<link rel="stylesheet" type="text/css" href="../skins/larry/styles.css?s=1364417489" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
</head>

<body>
<a href="http://radius.sra.mlib.cnr.it/" target="_self"><img src="../skins/larry/images/logo.png" id="logo" border="0" alt="IC Radius Management"><h1>IC Radius Management Interface</h1></a>

<table width="450" cellpadding="5" cellspacing="5" border="1">

<?php
        include 'db.php';

        // La pagina chengeip.php mi ha passato i campi Username, ip, oldpool, newpool
        // Attenzione, ip e' il vecchio ip!

        $UserName=$_REQUEST['UserName'];
        $ip=$_REQUEST['ip'];
        $oldpool=$_REQUEST['oldpool'];
        $newpool=$_REQUEST['newpool'];

        $conn = mysql_connect($db_data_host,$db_data_user,$db_data_password);
        if (!$conn) {
                die('Could not connect to RADIUS DB: ' . mysql_error());
        }
        mysql_select_db($db_data_dbname);

        $aa=mysql_query("SELECT address from ip where pool='$newpool' and used=0");
        $a=mysql_fetch_row($aa);
        if (!$a) {
                die('Il pool selezionato non ha indirizzi liberi: ' . mysql_error());
        }

        mysql_query("UPDATE userinfo set ip='$a[0]' where Username='$UserName'");
        mysql_query("UPDATE radreply set Value='$a[0]' where Username='$UserName' and Attribute='Framed-IP-Address'");
        mysql_query("UPDATE ip set used=0 where address='$ip'");
        mysql_query("UPDATE ip set used=1 where address='$a[0]'");

        // Update completato ora do la possibilita di cambiare ip nello stesso pool
?>
        <tbody>

        <form action="updateip.php">
        <p style="font-family:Century gothic, Verdana, Arial; font-size:12px; color:#0000A4; padding-left:0px">
                <input type="text" name="UserName" size="40" value="<?php echo $UserName; ?>" readonly>  UserName<br />
                <input type="text" name="oldip" size="30" value="<?php echo $a[0]; ?>" readonly> IP attuale<br />
                <input type="text" name="pool" size="30" value="<?php echo $newpool; ?>" readonly> Pool attuale<br />
                <br>
                <select size="1" name="newip" >
                <?php
                $cc=mysql_query("SELECT address from ip where pool='$newpool' and used=0");
                while ($c=mysql_fetch_row($cc)) {
                        echo"<option>$c[0]</option>";
                }
                ?>
                </select> Nuovo Indirizzo IP<br />
                <br>
                <input type="submit" name="submit" value="Update">
        </p>
        </form>

        </tbody>

</table> <p>

</body>
</html>

