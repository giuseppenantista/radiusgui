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

        // La pagina profili.php mi ha passato il parametro "profilename"

        $profilename=$_REQUEST['profilename'];

        $conn = mysql_connect($db_data_host,$db_data_user,$db_data_password);
        if (!$conn) {
                die('Could not connect to RADIUS DB: ' . mysql_error());
        }
        mysql_select_db($db_data_dbname);

        $risultato=mysql_query("SELECT profilename,down,up,priority FROM profiles where profilename = '$profilename'");
        $a=mysql_fetch_row($risultato);
        if (!$a) {
                die('Errore profilo non esistente: ' . mysql_error());
        }
?>
        <tbody>
        <form action="saveprofile.php">
        <p style="font-family:Century gothic, Verdana, Arial; font-size:12px; color:#0000A4; padding-left:0px">
                <input type="text" name="profilename" size="30" value="<?php echo"$a[0]" ?>" readonly> Nome del profilo<br />
                <input type="text" name="down"        size="30" value="<?php echo"$a[1]" ?>"> Download (kb)<br />
                <input type="text" name="up"          size="30" value="<?php echo"$a[2]" ?>"> Upload (kb)<br />
                <input type="text" name="priority"    size="30" value="<?php echo"$a[3]" ?>"> Priority (1-8)<br />
                <br>
                <input type="submit" name="submit" value="Salva">
        </p>
        </form>

        </tbody>

</table>

</body>
</html>
