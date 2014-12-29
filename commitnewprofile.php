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

        // La pagina newprofile.php mi ha passato i campi profilename,down,up,priority

        $profilename=$_REQUEST['profilename'];
        $down=$_REQUEST['down'];
        $up=$_REQUEST['up'];
        $priority=$_REQUEST['priority'];

        $conn = mysql_connect($db_data_host,$db_data_user,$db_data_password);
        if (!$conn) {
                die('Could not connect to RADIUS DB: ' . mysql_error());
        }
        mysql_select_db($db_data_dbname);

        mysql_query("INSERT into profiles (profilename,down,up,priority) values ('$profilename','$down','$up','$priority')");
        $stringa=$up.'k/'.$down.'k '.$up.'k/'.$down.'k '.$up.'k/'.$down.'k '.'1/1 '.$priority.' '.$up.'k/'.$up.'k';
//      echo "$stringa";
        mysql_query("UPDATE profiles set rate='$stringa' where profilename='$profilename'");

        echo "<h2>PROFILO CREATO <br>";
        echo "<a href='profili.php'> TORNA A ELENCO PROFILI </a></h2>";

?>

</table> <p>

</body>
</html>
