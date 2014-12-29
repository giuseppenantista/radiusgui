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

        // La pagina search.php mi ha passato il parametro "UserName"

        $parametro=$_REQUEST['UserName'];

        $conn = mysql_connect($db_data_host,$db_data_user,$db_data_password);
        if (!$conn) {
                die('Could not connect to RADIUS DB: ' . mysql_error());
        }
        mysql_select_db($db_data_dbname);
        $aa=mysql_query("SELECT * FROM userinfo where UserName = '$parametro'");
        $a=mysql_fetch_row($aa);

?>
        <tbody>

        <form action="update.php">
        <p style="font-family:Century gothic, Verdana, Arial; font-size:12px; color:#0000A4; padding-left:0px">
                <input type="text" name="UserName"      size="40" value="<?php echo $a[0]; ?>" readonly>  UserName<br />
                <input type="text" name="password"      size="30" value="<?php echo $a[21]; ?>" readonly>  Password <?php echo "<a href='changepwd.php?UserName=$a[0]'> Cambia Password </a></h2>"; ?><br />
                <input type="text" name="nome"          size="30" value="<?php echo $a[1]; ?>" readonly>  Nome<br />
                <input type="text" name="cognome"       size="30" value="<?php echo $a[2]; ?>" readonly>  Cognome<br />
                <input type="text" name="codfis"        size="30" value="<?php echo $a[3]; ?>">  Codice Fiscale<br />
                <input type="text" name="indirizzo"     size="30" value="<?php echo $a[4]; ?>">  Indirizzo<br />
                <input type="text" name="cap"           size="30" value="<?php echo $a[5]; ?>">  C.a.p.<br />
                <input type="text" name="localita"      size="30" value="<?php echo $a[6]; ?>">  Localit&agrave;<br />
                <input type="text" name="comune"        size="30" value="<?php echo $a[7]; ?>">  Comune<br />
                <input type="text" name="provincia"     size="30" value="<?php echo $a[8]; ?>">  Provincia<br />
                <input type="text" name="email"         size="30" value="<?php echo $a[9]; ?>">  Email<br />
                <input type="text" name="tel"           size="30" value="<?php echo $a[10];?>">  Telefono<br />
                <input type="text" name="cel"           size="30" value="<?php echo $a[11];?>">  Cellulare<br />
                <input type="text" name="fax"           size="30" value="<?php echo $a[12];?>">  Fax<br />
                <input type="text" name="ragsociale"    size="40" value="<?php echo $a[13];?>">  Ragione Sociale<br />
                <input type="text" name="piva"          size="30" value="<?php echo $a[14];?>">  Partita Iva<br />
                <input type="text" name="data_creazione" size="30" value="<?php echo $a[15];?>" readonly>  Data di creazione<br />
                <input type="text" name="attivato"      size="30" value="<?php echo $a[16];?>">  Attivato
<?php
        if ($a[16]=='1') {
        echo "<a href='blocca.php?UserName=$a[0]'> BLOCCA UTENTE </a></h2>";
        }
        if ($a[16]=='0') {
        echo "<a href='sblocca.php?UserName=$a[0]'> SBLOCCA UTENTE </a></h2>";
        }
?><br />
                <input type="text" name="num_contratto" size="30" value="<?php echo $a[17];?>">  Numero di contratto<br />
                <input type="text" name="ip"            size="30" value="<?php echo $a[18];?>" readonly>  Indirizzo IP <?php echo "<a href='changeip.php?UserName=$a[0]'> Cambia IP </a></h2>"; ?><br />

                <select size="1" name="profilo" >
                <option><?php echo $a[19]; ?></option>
<?php
                $risultato=mysql_query("SELECT profilename FROM profiles");
                while ($riga=mysql_fetch_row($risultato)) {
                        echo "<option>$riga[0]</option>";
                }
?>
                </select> Profilo<br />

                <input type="text" name="note"          size="90" value="<?php echo $a[20];?>"> Note<br />
                <br>
                <input type="submit" name="submit" value="Update">
        </p>
        </form>

        </tbody>


</table>

</body>
</html>

