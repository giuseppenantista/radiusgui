<html>
<head>
<title>IC Radius Management :: Benvenuto</title>
<link rel="shortcut icon" href="../skins/larry/images/favicon.ico"/>
<link rel="stylesheet" type="text/css" href="../skins/larry/styles.css?s=1364417489" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
</head>

<body>
<img src="../skins/larry/images/logo.png" id="logo" border="0" alt="IC Radius Management"><h1>IC Radius Management Interface</h1>

<table width="450" cellpadding="5" cellspacing="5" border="1">

<?php
        include 'db.php';

        // La pagina search.php mi ha passato UserName

        $UserName=$_REQUEST['UserName'];

        $conn = mysql_connect($db_data_host,$db_data_user,$db_data_password);
        if (!$conn) {
                die('Could not connect to RADIUS DB: ' . mysql_error());
        }
        mysql_select_db($db_data_dbname);

        $ee=mysql_query("SELECT Value from radreply where UserName='$UserName' and Attribute='Framed-IP-Address'");
        $e=mysql_fetch_row($ee);
        if (!$e) {
                die('Errore, profilo non esistente: ' . mysql_error());
        }
        mysql_query("UPDATE ip set used=0 where address='$e[0]'");

        $dd=mysql_query("SELECT ip from userinfo where UserName='$UserName'");
        $d=mysql_fetch_row($dd);
        if (!$d) {
                die('Errore, profilo non esistente: ' . mysql_error());
        }
        mysql_query("UPDATE radreply set Value = '$d[0]' where UserName='$UserName' and Attribute='Framed-IP-Address'");
        mysql_query("UPDATE userinfo set attivato='1' where UserName='$UserName'");

        echo "<h2>UPDATE COMPLETATO <br>";
        echo "<a href='visualizza.php?UserName=$UserName'> TORNA A SCHEDA UTENTE </a></h2>";

?>

</table> <p>

</body>
</html>

