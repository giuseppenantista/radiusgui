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

        <form action="createnew.php">
        <p style="font-family:Century gothic, Verdana, Arial; font-size:12px; color:#0000A4; padding-left:0px">
                <input type="text" name="UserName"      size="40" value=""> UserName<br />
                <input type="text" name="password"      size="30" value="<?php echo substr(str_shuffle('abcdefghijklmnopqrstuvwxyz0123456789'),0,8);?>"> Password <br />
                <input type="text" name="nome"          size="30" value=""> Nome<br />
                <input type="text" name="cognome"       size="30" value=""> Cognome<br />
                <input type="text" name="codfis"        size="30" value=""> Codice Fiscale<br />
                <input type="text" name="indirizzo"     size="30" value=""> Indirizzo<br />
                <input type="text" name="cap"           size="30" value=""> C.a.p.<br />
                <input type="text" name="localita"      size="30" value=""> Localit&agrave;<br />
                <input type="text" name="comune"        size="30" value=""> Comune<br />
                <input type="text" name="provincia"     size="30" value=""> Provincia<br />
                <input type="text" name="email"         size="30" value=""> Email<br />
                <input type="text" name="tel"           size="30" value=""> Telefono<br />
                <input type="text" name="cel"           size="30" value=""> Cellulare<br />
                <input type="text" name="fax"           size="30" value=""> Fax<br />
                <input type="text" name="ragsociale"    size="40" value=""> Ragione Sociale<br />
                <input type="text" name="piva"          size="30" value=""> Partita Iva<br />
                <input type="text" name="data_creazione" size="30" value="<?php echo date('Y-m-d H:i:s'); ?>" readonly> Data di creazione<br />
                <input type="text" name="attivato"      size="30" value="1"> Attivato<br />
                <input type="text" name="num_contratto" size="30" value=""> Numero di contratto<br />
                <select size="1" name="poolname" >
                <option></option>
<?php
                include 'db.php';

                $conn = mysql_connect($db_data_host,$db_data_user,$db_data_password);
                if (!$conn) {
                die('Could not connect to RADIUS DB: ' . mysql_error());
                }
                mysql_select_db($db_data_dbname);

                $risultato=mysql_query("SELECT DISTINCT (pool) AS pool FROM ip");
                while ($riga=mysql_fetch_row($risultato)) {
                        echo "<option>$riga[0]</option>";
                }
?>
                </select> Pool Indirizzo IP<br />

                <select size="1" name="profilo" >
                <option></option>
<?php

                $conn = mysql_connect($db_data_host,$db_data_user,$db_data_password);
                if (!$conn) {
                die('Could not connect to RADIUS DB: ' . mysql_error());
                }
                mysql_select_db($db_data_dbname);

                $risultato=mysql_query("SELECT profilename from profiles");
                while ($riga=mysql_fetch_row($risultato)) {
                        echo "<option>$riga[0]</option>";
                }
?>
                </select> Profilo<br />
                <input type="text" name="note"          size="90" value=""> Note<br />
                <br>
                <input type="submit" name="submit" value="Update">
        </p>
        </form>

        </tbody>


</table>

</body>
</html>

