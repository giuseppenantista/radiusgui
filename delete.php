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

<?php
        // La pagina search.php mi ha passato il parametro "UserName"
        $parametro=$_REQUEST['UserName'];
?>
        <tbody>

        <h3>Attenzione, si sta cancellando l'utente</h3>

        <form action="deleteconfirmed.php">
        <p style="font-family:Century gothic, Verdana, Arial; font-size:12px; color:#0000A4; padding-left:0px">
                <input type="text" name="UserName" size="40" value="<?php echo $parametro; ?>" readonly>  UserName<br />
                <br></h3>
                <h3>L'operazione non e' reversibile</h3>
                <input type="submit" name="submit" value="Cancella">
        </p>
        </form>

        </tbody>


</table>

</body>
</html>
