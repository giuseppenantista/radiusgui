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
        mysql_query("UPDATE profiles set rate='$stringa' where profilename='$profilename'");

        echo "<h2>PROFILO CREATO <br>";
        echo "<a href='profili.php'> TORNA A ELENCO PROFILI </a></h2>";

?>

</table> <p>

</body>
</html>
