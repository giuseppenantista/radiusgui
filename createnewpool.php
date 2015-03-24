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

        // La pagina newpool.php mi ha passato i campi poolname, net e mask
        // Questo file va perfezionato con il supporto di qualunque netmask

        $poolname=$_REQUEST['poolname'];
        $net=$_REQUEST['net'];
        $mask=$_REQUEST['mask'];

        $conn = mysql_connect($db_data_host,$db_data_user,$db_data_password);
        if (!$conn) {
                die('Could not connect to RADIUS DB: ' . mysql_error());
        }
        mysql_select_db($db_data_dbname);

        // Qua devo mettere le query per creare gli IP

        if ($mask!='255.255.255.0') {
                echo "Netmask non supportata";
        }
        if ($mask=='255.255.255.0') {
                // Normalizzo l'ip a un IP di network /24
                $newnet = long2ip(ip2long($net) & 0xFFFFFF00);
                for ($i=1;$i<255;++$i) {
                        $indirizzo=long2ip(ip2long($newnet)+$i);
                        // indirizzo contiene una stringa con l'IP
                        mysql_query("INSERT into ip values ('$indirizzo','$poolname',0)");
                }
        }
?>
        <h2>Creazione completata <br>
        <a href='ippool.php'> Torna a Gestione pool </a></h2>


</table> <p>

</body>
</html>
