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

        // La pagina delete.php mi ha passato i campi Username e submit con valore "Cancella"

        $UserName=$_REQUEST['UserName'];
//      $password=$_REQUEST['submit'];

        $conn = mysql_connect($db_data_host,$db_data_user,$db_data_password);
        if (!$conn) {
                die('Could not connect to RADIUS DB: ' . mysql_error());
        }
        mysql_select_db($db_data_dbname);

        $a=mysql_query("SELECT ip from userinfo where UserName='$UserName'");
        $ip=mysql_fetch_row($a);
        if (!$ip) {
                die('Errore generale: ' . mysql_error());
        }
        mysql_query("DELETE from userinfo where Username='$UserName'");
        mysql_query("DELETE from radcheck where Username='$UserName'");
        mysql_query("DELETE from radreply where Username='$UserName'");
        mysql_query("UPDATE ip set used=0 where address='$ip[0]'");

        echo "<h2>CANCELLAZIONE EFFETTUATA <br>";
        echo "<a href='index.php'> TORNA ALLA HOME PAGE </a></h2>";

?>

</table> <p>

</body>
</html>
