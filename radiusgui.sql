 CREATE TABLE userinfo ( 
  `UserName` varchar(64) NOT NULL DEFAULT '',
  `nome` varchar(30) NOT NULL DEFAULT '',
  `cognome` varchar(30) NOT NULL DEFAULT '',
  `codfis` varchar(16) NOT NULL DEFAULT '',
  `indirizzo` varchar(50) NOT NULL DEFAULT '',
  `cap` varchar(5) NOT NULL DEFAULT '',
  `localita` varchar(50) NOT NULL DEFAULT '',
  `comune` varchar(50) NOT NULL DEFAULT '',
  `provincia` char(2) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `tel` varchar(20) NOT NULL DEFAULT '',
  `cel` varchar(20) NOT NULL DEFAULT '',
  `fax` varchar(20) NOT NULL DEFAULT '',
  `ragsociale` varchar(128) NOT NULL DEFAULT '',
  `piva` varchar(16) NOT NULL DEFAULT '',
  `data_creazione` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `attivato` char(1) NOT NULL DEFAULT '1',
  `num_contratto` varchar(20) NOT NULL DEFAULT '',
  `ip` varchar(15) NOT NULL DEFAULT '',
  `profilo` varchar(16) NOT NULL DEFAULT '',
  `note` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE ip (
  address varchar(15) NOT NULL DEFAULT '',
  pool varchar(64) NOT NULL DEFAULT '',
  used int(1) NOT NULL DEFAULT 0
);

CREATE TABLE profiles (
  profilename varchar(64) NOT NULL DEFAULT '',
  down varchar(5) NOT NULL DEFAULT '',
  up varchar(5) NOT NULL DEFAULT '',
  rate varchar(253) NOT NULL DEFAULT '',
  priority int(1) NOT NULL DEFAULT 8
);
  
  
  
