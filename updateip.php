<html>
<head>
<title>RadiusGUI :: Benvenuto</title>
<link rel="shortcut icon" href="favicon.ico"/>
<link rel="stylesheet" type="text/css" href="styles.css?s=1364417489" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
</head>

<body>
<img src="logo.png" id="logo" border="0" alt="RadiusGUI"><h1>RadiusGUI Interface</h1>

<table width="450" cellpadding="5" cellspacing="5" border="1">

<?php
        include 'db.php';

        // La pagina updatepool.php mi ha passato i campi Username, pool, oldip e newip

        $UserName=$_REQUEST['UserName'];
//      $pool non serve, non lo uso
        $oldip=$_REQUEST['oldip'];
        $newip=$_REQUEST['newip'];

        $conn = mysql_connect($db_data_host,$db_data_user,$db_data_password);
        if (!$conn) {
                die('Could not connect to RADIUS DB: ' . mysql_error());
        }
        mysql_select_db($db_data_dbname);

        mysql_query("UPDATE userinfo set ip='$newip' where UserName='$UserName'");
        mysql_query("UPDATE radreply set Value='$newip' where UserName='$UserName' and Attribute='Framed-IP-Address'");
        mysql_query("UPDATE ip set used=1 where address='$newip'");
        mysql_query("UPDATE ip set used=0 where address='$oldip'");

        echo "<h2>UPDATE COMPLETATO <br>";
        echo "<a href='visualizza.php?UserName=$UserName'> TORNA A SCHEDA UTENTE </a></h2>";

?>

</table> <p>

</body>
</html>
