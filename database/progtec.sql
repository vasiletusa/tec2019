-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Set 08, 2019 alle 16:06
-- Versione del server: 5.6.38
-- Versione PHP: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `progtec`
--

DELIMITER $$
--
-- Funzioni
--
CREATE DEFINER=`root`@`localhost` FUNCTION `checkUser` (`userin` VARCHAR(20)) RETURNS INT(10) BEGIN
DECLARE num INT(10);
SET num = (SELECT ruoli.User FROM ruoli WHERE ruoli.User=userin AND ((ruoli.Ruolo = "Admin") OR (ruoli.Ruolo = "Guida")));
RETURN num;  
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Struttura della tabella `commenti`
--

CREATE TABLE `commenti` (
  `IdComm` int(11) NOT NULL,
  `IdTour` int(11) NOT NULL,
  `UserUtente` varchar(20) NOT NULL,
  `Commento` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `partecipa`
--

CREATE TABLE `partecipa` (
  `IdTour` int(11) NOT NULL,
  `Username` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `ruoli`
--

CREATE TABLE `ruoli` (
  `User` varchar(20) NOT NULL,
  `Ruolo` enum('Admin','Normale','Moderatore','Guida') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `tour`
--

CREATE TABLE `tour` (
  `Id` int(11) NOT NULL,
  `Data` date NOT NULL,
  `Organizzatore` varchar(20) NOT NULL,
  `Citta` enum('Padova','Vicenza','Verona','Rovigo','Belluno','Treviso','Venezia') NOT NULL,
  `Titolo` text NOT NULL,
  `Descrizione` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `tour`
--

INSERT INTO `tour` (`Id`, `Data`, `Organizzatore`, `Citta`, `Titolo`, `Descrizione`) VALUES
(1, '2019-06-03', 'rizzo', 'Padova', 'sss', 'aaaaaaaaaa');

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE `utenti` (
  `Nome` varchar(50) NOT NULL,
  `Cognome` varchar(50) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(8) NOT NULL,
  `Email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`Nome`, `Cognome`, `Username`, `Password`, `Email`) VALUES
('', '', '', '', ''),
('admin', 'admin', 'admin', 'admin', 'admin@admin.it'),
('asdfasf', 'asdfasdf', 'asdfasf', '44444', 'asdfasf@asdfasdf'),
('edoardo', 'caregnato', 'Ettoardo', 'aaa', 'caregnatoedoardo@ts-auto.it'),
('', 'Rizzo', 'ilarya9531', 'aaa', 'ilarya9531@gmail.com'),
('ilaria', 'unodue', 'rizzo', 'qoqoqo', 'qopqoqo'),
('sara', 'romito', 'sasa', 'aaa', 'sararomito'),
('vasile', 'tusa', 'vasiletusa', 'user', 'vasiletusa95@yahoo.it');

-- --------------------------------------------------------

--
-- Struttura della tabella `valutazioni`
--

CREATE TABLE `valutazioni` (
  `Recensore` varchar(20) NOT NULL,
  `Guida` varchar(20) NOT NULL,
  `Voto` enum('1','2','3','4','5') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `commenti`
--
ALTER TABLE `commenti`
  ADD PRIMARY KEY (`IdComm`),
  ADD KEY `UserUtente` (`UserUtente`),
  ADD KEY `IdTour` (`IdTour`);

--
-- Indici per le tabelle `partecipa`
--
ALTER TABLE `partecipa`
  ADD PRIMARY KEY (`IdTour`,`Username`),
  ADD KEY `Username` (`Username`);

--
-- Indici per le tabelle `ruoli`
--
ALTER TABLE `ruoli`
  ADD PRIMARY KEY (`User`);

--
-- Indici per le tabelle `tour`
--
ALTER TABLE `tour`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Organizzatore` (`Organizzatore`);

--
-- Indici per le tabelle `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`Username`);

--
-- Indici per le tabelle `valutazioni`
--
ALTER TABLE `valutazioni`
  ADD PRIMARY KEY (`Recensore`,`Guida`),
  ADD KEY `Guida` (`Guida`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `commenti`
--
ALTER TABLE `commenti`
  MODIFY `IdComm` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `tour`
--
ALTER TABLE `tour`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `commenti`
--
ALTER TABLE `commenti`
  ADD CONSTRAINT `Commenti_ibfk_1` FOREIGN KEY (`UserUtente`) REFERENCES `utenti` (`Username`),
  ADD CONSTRAINT `Commenti_ibfk_2` FOREIGN KEY (`IdTour`) REFERENCES `tour` (`Id`);

--
-- Limiti per la tabella `partecipa`
--
ALTER TABLE `partecipa`
  ADD CONSTRAINT `Partecipa_ibfk_1` FOREIGN KEY (`IdTour`) REFERENCES `tour` (`Id`),
  ADD CONSTRAINT `Partecipa_ibfk_2` FOREIGN KEY (`Username`) REFERENCES `utenti` (`Username`);

--
-- Limiti per la tabella `ruoli`
--
ALTER TABLE `ruoli`
  ADD CONSTRAINT `Ruoli_ibfk_1` FOREIGN KEY (`User`) REFERENCES `utenti` (`Username`);

--
-- Limiti per la tabella `tour`
--
ALTER TABLE `tour`
  ADD CONSTRAINT `Tour_ibfk_2` FOREIGN KEY (`Organizzatore`) REFERENCES `utenti` (`Username`);

--
-- Limiti per la tabella `valutazioni`
--
ALTER TABLE `valutazioni`
  ADD CONSTRAINT `Valutazioni_ibfk_1` FOREIGN KEY (`Recensore`) REFERENCES `utenti` (`Username`),
  ADD CONSTRAINT `Valutazioni_ibfk_2` FOREIGN KEY (`Guida`) REFERENCES `utenti` (`Username`);
