<html>
<head>
<title>IC Radius Management :: Benvenuto</title>
<link rel="shortcut icon" href="../skins/larry/images/favicon.ico"/>
<link rel="stylesheet" type="text/css" href="../skins/larry/styles.css?s=1364417489" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
</head>

<body>
<img src="../skins/larry/images/logo.png" id="logo" border="0" alt="IC Radius Management"><h1>IC Radius Management Interface</h1>

<table width="450" cellpadding="5" cellspacing="5" border="1">

<?php
        include 'db.php';

        // La pagina visualizza.php mi ha passato tutti i campi della tabella "userinfo"

        $UserName=$_REQUEST['UserName'];
        $nome=$_REQUEST['nome'];
        $cognome=$_REQUEST['cognome'];
        $codfis=$_REQUEST['codfis'];
        $indirizzo=$_REQUEST['indirizzo'];
        $cap=$_REQUEST['cap'];
        $localita=$_REQUEST['localita'];
        $comune=$_REQUEST['comune'];
        $provincia=$_REQUEST['provincia'];
        $email=$_REQUEST['email'];
        $tel=$_REQUEST['tel'];
        $cel=$_REQUEST['cel'];
        $fax=$_REQUEST['fax'];
        $ragsociale=$_REQUEST['ragsociale'];
        $piva=$_REQUEST['piva'];
        $data_creazione=$_REQUEST['data_creazione'];
        $attivato=$_REQUEST['attivato'];
        $num_contratto=$_REQUEST['num_contratto'];
        $ip=$_REQUEST['ip'];
        $profilo=$_REQUEST['profilo'];
        $note=$_REQUEST['note'];

        $conn = mysql_connect($db_data_host,$db_data_user,$db_data_password);
        if (!$conn) {
                die('Could not connect to RADIUS DB: ' . mysql_error());
        }
        mysql_select_db($db_data_dbname);
//      mysql_query("UPDATE userinfo set nome='$nome' where Username='$UserName'");
//      mysql_query("UPDATE userinfo set cognome='$cognome' where Username='$UserName'");
        mysql_query("UPDATE userinfo set codfis='$codfis' where Username='$UserName'");
        mysql_query("UPDATE userinfo set indirizzo='$indirizzo' where Username='$UserName'");
        mysql_query("UPDATE userinfo set cap='$cap' where Username='$UserName'");
        mysql_query("UPDATE userinfo set localita='$localita' where Username='$UserName'");
        mysql_query("UPDATE userinfo set comune='$comune' where Username='$UserName'");
        mysql_query("UPDATE userinfo set provincia='$provincia' where Username='$UserName'");
        mysql_query("UPDATE userinfo set email='$email' where Username='$UserName'");
        mysql_query("UPDATE userinfo set tel='$tel' where Username='$UserName'");
        mysql_query("UPDATE userinfo set cel='$cel' where Username='$UserName'");
        mysql_query("UPDATE userinfo set fax='$fax' where Username='$UserName'");
        mysql_query("UPDATE userinfo set ragsociale='$ragsociale' where Username='$UserName'");
        mysql_query("UPDATE userinfo set piva='$piva' where Username='$UserName'");
//      Data di creazione NO!
        mysql_query("UPDATE userinfo set attivato='$attivato' where Username='$UserName'");
        mysql_query("UPDATE userinfo set num_contratto='$num_contratto' where Username='$UserName'");
//      IP NO, pagina a parte
        mysql_query("UPDATE userinfo set profilo='$profilo' where Username='$UserName'");

//      Quando scrivo il profilo devo "tradurlo" in "Mikrotik-Rate-Limit" sulla parte radreply
        $aa=mysql_query("SELECT rate FROM profiles where profilename='$profilo'");
        $a=mysql_fetch_row($aa);
        if (!$a) {
                die('Errore, profilo non esistente: ' . mysql_error());
        }
        mysql_query("UPDATE radreply set Value='$a[0]' where Username='$UserName' and Attribute='Mikrotik-Rate-Limit'");

        mysql_query("UPDATE userinfo set note='$note' where Username='$UserName'");
//      Password NO!

        echo "<h2>UPDATE COMPLETATO <br>";
        echo "<a href='visualizza.php?UserName=$UserName'> TORNA A SCHEDA UTENTE </a></h2>";

?>

</table> <p>

</body>
</html>

