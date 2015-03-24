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

        // La pagina create.php mi ha passato tutti i campi della tabella "userinfo" tranne ip
        // Pero' mi ha passato "poolname"

        $UserName=$_REQUEST['UserName'];
        $password=$_REQUEST['password'];
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
        $poolname=$_REQUEST['poolname'];
        $profilo=$_REQUEST['profilo'];
        $note=$_REQUEST['note'];

        $conn = mysql_connect($db_data_host,$db_data_user,$db_data_password);
        if (!$conn) {
                die('Could not connect to RADIUS DB: ' . mysql_error());
        }
        mysql_select_db($db_data_dbname);

//      Se esiste gia uno UserName non devo duplicarlo
        $esistente=mysql_query("SELECT UserName from userinfo where UserName='$UserName'");
        $riga=mysql_fetch_row($esistente);
        if ($riga) {
                die('UserName gia esistente: ' . mysql_error());
        }

//      Per maggior leggibilita ho messo una query per riga, potevo unificare
        mysql_query("INSERT into userinfo (UserName) values ('$UserName')");
        mysql_query("UPDATE userinfo set password='$password' where Username='$UserName'");
//      Password va messa anche su radcheck
        mysql_query("INSERT into radcheck (UserName,Attribute,op,Value) values ('$UserName','Password','==','$password')");
        mysql_query("UPDATE userinfo set nome='$nome' where Username='$UserName'");
        mysql_query("UPDATE userinfo set cognome='$cognome' where Username='$UserName'");
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
        mysql_query("UPDATE userinfo set data_creazione='$data_creazione' where Username='$UserName'");
        mysql_query("UPDATE userinfo set attivato='$attivato' where Username='$UserName'");
        mysql_query("UPDATE userinfo set num_contratto='$num_contratto' where Username='$UserName'");
//      L'IP va preso tramite il pool, seleziono tutti gli ip liberi di quel pool e prendo il primo
        $indirizzoip=mysql_query("SELECT address from ip where pool='$poolname' and used=0");
        $riga=mysql_fetch_row($indirizzoip);
        if (!$riga) {
                echo "ATTENZIONE, UTENTE CREATO MA IP NON ASSEGNATO PER POOL ESAURITO";
        }
        $ip=$riga[0];
        mysql_query("UPDATE userinfo set ip='$ip' where Username='$UserName'");
//      Aggiorno l'ip segndolo come usato
        mysql_query("UPDATE ip set used=1 where address='$ip'");
//      IP va messo anche su radreply
        mysql_query("INSERT into radreply (UserName,Attribute,op,Value) values ('$UserName','Framed-IP-Address',':=','$ip')");
        mysql_query("UPDATE userinfo set profilo='$profilo' where Username='$UserName'");
//      Quando scrivo il profilo devo "tradurlo" in "Mikrotik-Rate-Limit" sulla parte radreply
        $aa=mysql_query("SELECT rate from profiles where profilename='$profilo'");
        $a=mysql_fetch_row($aa);
        if (!$a) {
                die('Errore profilo non trovato: ' . mysql_error());
        }
        mysql_query("INSERT into radreply (UserName,Attribute,op,Value) values ('$UserName','Mikrotik-Rate-Limit',':=','$a[0]')");
//      Fine del blocco relativo al profilo
        mysql_query("UPDATE userinfo set note='$note' where Username='$UserName'");

        echo "<h2>UPDATE COMPLETATO <br>";
        echo "<a href='visualizza.php?UserName=$UserName'> TORNA A SCHEDA UTENTE </a></h2>";

?>

</table> <p>

</body>
</html>

