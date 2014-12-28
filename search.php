<html>
<head>
<title>IC Radius Management :: Risultati Ricerca</title>
<link rel="shortcut icon" href="../skins/larry/images/favicon.ico"/>
<link rel="stylesheet" type="text/css" href="../skins/larry/styles.css?s=1364417489" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
</head>

<body>
<a href="http://radius.sra.mlib.cnr.it/" target="_self"><img src="../skins/larry/images/logo.png" id="logo" border="0" alt="IC Radius Management"><h1>IC Radius Management Interface</h1></a>

<table border="1" cellpadding="1" cellspacing="1" style="width: 640px;">

<tbody>
<?php
        include 'db.php';

        // La pagina index.php mi ha passato i parametri "ricerca" e "tipo"

        $ricerca=$_REQUEST['ricerca'];
        $tipo=$_REQUEST['tipo'];

        $conn = mysql_connect($db_data_host,$db_data_user,$db_data_password);
        if (!$conn) {
                die('Could not connect to RADIUS DB: ' . mysql_error());
        }
        mysql_select_db($db_data_dbname);

        // PS SANIFICARE L'INPUT!

        if ($tipo=="username") {
        $risultato=mysql_query("SELECT UserName,ip FROM userinfo where UserName like '%$ricerca%' order by UserName");
        while ($riga=mysql_fetch_row($risultato)) {
                echo "<tr> <td>";
                echo "<a href='visualizza.php?UserName=$riga[0]'>$riga[0]</a>";
                echo "</td> <td>";
                echo "$riga[1]";
                echo "</td> <td>";
                echo "<a href='delete.php?UserName=$riga[0]'>delete</a>";
                echo "</td> <td>";

                $qq=mysql_query("SELECT AcctStartTime,AcctStopTime from radacct where UserName='$riga[0]' and AcctStopTime is NULL");
                $q=mysql_fetch_row($qq);
                if (!$q) {
                        echo "<img src=\"skins/larry/images/red.png\" alt=\"down\" height=\"16\" width=\"16\">";
                }
                if ($q) {
                        echo "<img src=\"skins/larry/images/green.png\" alt=\"down\" height=\"16\" width=\"16\">";
                }
                echo "</td> </tr>";
        } //fine while
        } //fine if

        if ($tipo=="ip") {
        $risultato=mysql_query("SELECT UserName,ip FROM userinfo where ip like '%$ricerca%' order by UserName");
        while ($riga=mysql_fetch_row($risultato)) {
                echo "<tr> <td>";
                echo $riga[0]; //UserName
                echo "</td> <td>";
                echo $riga[1]; // IP
                echo "</td> </tr>";
                }
        }
?>
        </tbody>


</table>

</body>
</html>

