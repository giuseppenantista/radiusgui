<html>
<head>
<title>RadiusGUI :: Benvenuto</title>
<link rel="shortcut icon" href="favicon.ico"/>
<link rel="stylesheet" type="text/css" href="styles.css?s=1364417489" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
</head>

<body>
<img src="logo.png" id="logo" border="0" alt="RadiusGUI"><h1>RadiusGUI Interface</h1>

<table border="1" cellpadding="1" cellspacing="1" style="width: 500px;">

<tbody>

<?php
        include 'db.php';

        $conn = mysql_connect($db_data_host,$db_data_user,$db_data_password);
        if (!$conn) {
                die('Could not connect to RADIUS DB: ' . mysql_error());
        }
        mysql_select_db($db_data_dbname);

        $risultato=mysql_query("SELECT profilename FROM profiles");
        while ($riga=mysql_fetch_row($risultato)) {
                echo "<tr> <td>";
                echo "<a href='editprofile.php?profilename=$riga[0]'>$riga[0]</a>";
                echo "</td> </tr>";
        }
?>

</tbody>
<br>
<h3><a href='newprofile.php'> Crea nuovo profilo </a></h3>

</table>

</body>
</html>

