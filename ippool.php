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

        $conn = mysql_connect($db_data_host,$db_data_user,$db_data_password);
        if (!$conn) {
                die('Could not connect to RADIUS DB: ' . mysql_error());
        }
        mysql_select_db($db_data_dbname);

        echo "<tbody>";
        $risultato=mysql_query("SELECT DISTINCT (pool) AS pool FROM ip order by pool");
        while ($riga=mysql_fetch_row($risultato)) {
                echo "<tr> <td>";
                echo "<a href='viewpool.php?poolname=$riga[0]'>$riga[0]</a>";
                echo "</td> </tr>";
                }
        echo "</tbody>";

?>

<br>
<h3><a href='newpool.php'> Crea pool IP </a></h3>

</table>

</body>
</html>

