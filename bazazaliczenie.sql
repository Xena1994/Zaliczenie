-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 13 Lip 2017, 15:04
-- Wersja serwera: 10.1.21-MariaDB
-- Wersja PHP: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `bazazaliczenie`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `film`
--

CREATE TABLE `film` (
  `id` int(10) UNSIGNED NOT NULL,
  `idKategoriaFilmu` int(10) UNSIGNED NOT NULL,
  `plakat` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `nazwa` varchar(60) COLLATE utf8_polish_ci NOT NULL,
  `opis` varchar(1000) COLLATE utf8_polish_ci NOT NULL,
  `rezyseria` varchar(40) COLLATE utf8_polish_ci NOT NULL,
  `scenariusz` varchar(40) COLLATE utf8_polish_ci NOT NULL,
  `dataPremiery` date NOT NULL,
  `cenaWypozyczenia` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `film`
--

INSERT INTO `film` (`id`, `idKategoriaFilmu`, `plakat`, `nazwa`, `opis`, `rezyseria`, `scenariusz`, `dataPremiery`, `cenaWypozyczenia`) VALUES
(4, 15, 'spiderManHomecoming.jpg', 'Spider Man: Homecoming', 'ddd', 'dd', 'ff', '2017-07-06', 9),
(5, 19, 'krolArturPlakat.jpg', 'KrÃ³l Artur: Legenda miecza', 'MÅ‚ody Artur zdobywa miecz Excalibur i wiedzÄ™ na temat swojego krÃ³lewskiego pochodzenia. PrzyÅ‚Ä…cza siÄ™ do rebelii, aby pokonaÄ‡ tyrana, ktÃ³ry zamordowaÅ‚ jego rodzicÃ³w. ', 'Guy Ritchie', 'Joby Harold', '2017-06-16', 19),
(6, 22, 'BabyDriverPlakat.jpg', 'Baby Driver', 'ChcÄ…cy zerwaÄ‡ z kryminalnÄ… przeszÅ‚oÅ›ciÄ… mÅ‚ody chÅ‚opak, zmuszany do pracy dla bossa mafii, zostaje wrobiony w napad skazany na niepowodzenie.', 'Edgar Wright', 'Edgar Wright', '2017-07-07', 19),
(7, 15, 'WonderWomanPlakat.jpg', 'Wonder Woman', 'Diana, amazoÅ„ska ksiÄ™Å¼niczka, przybywa do cywilizowanego Å›wiata, stajÄ…c siÄ™ najpotÄ™Å¼niejszÄ… superbohaterkÄ…. \r\n', 'Patty Jenkins', 'Allan Heinberg', '2017-06-02', 9),
(8, 22, 'WStarymDobrymStyluPlakat.jpg', 'W starym, dobrym stylu', 'Trzej zdesperowani emeryci postanawiajÄ… napaÅ›Ä‡ na bank, ktÃ³ry pozbawiÅ‚ ich oszczÄ™dnoÅ›ci.', 'Zach Braff', 'Theodore Melfi', '2017-06-30', 10),
(9, 15, 'PiraciZKaraibowPlakat.jpg', 'Piraci z KaraibÃ³w: Zemsta Salazara', 'ZÅ‚owrogi korsarz ucieka z mitycznego wiÄ™zienia i planuje zgÅ‚adziÄ‡ wszystkich piratÃ³w na morzach. Aby mu przeszkodziÄ‡, Jack Sparrow musi zdobyÄ‡ TrÃ³jzÄ…b Posejdona.', 'Joachim Ronning', 'Jeff Nathanson', '2017-05-26', 19);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kategoriefilm`
--

CREATE TABLE `kategoriefilm` (
  `id` int(10) UNSIGNED NOT NULL,
  `nazwa` varchar(20) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `kategoriefilm`
--

INSERT INTO `kategoriefilm` (`id`, `nazwa`) VALUES
(15, 'Akcja'),
(16, 'Biograficzny'),
(17, 'Animacja'),
(18, 'Dokumentalny'),
(19, 'Dramat'),
(20, 'Fantasy'),
(21, 'Horror'),
(22, 'Komedia'),
(23, 'Kryminał'),
(24, 'Musical'),
(25, 'Przygodowy'),
(26, 'Romans'),
(27, 'Sci-fi'),
(28, 'Thriller'),
(29, 'Wojenny');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ocena`
--

CREATE TABLE `ocena` (
  `id` int(10) UNSIGNED NOT NULL,
  `idFilm` int(10) UNSIGNED NOT NULL,
  `idUzytkownik` int(10) UNSIGNED NOT NULL,
  `ocena` int(10) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci ROW_FORMAT=COMPACT;

--
-- Zrzut danych tabeli `ocena`
--

INSERT INTO `ocena` (`id`, `idFilm`, `idUzytkownik`, `ocena`, `data`) VALUES
(6, 4, 4, 7, '2017-07-12 10:44:38'),
(7, 5, 4, 6, '2017-07-13 09:37:55');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ulubione`
--

CREATE TABLE `ulubione` (
  `id` int(10) UNSIGNED NOT NULL,
  `idFilm` int(10) UNSIGNED NOT NULL,
  `idUzytkownik` int(10) UNSIGNED NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `ulubione`
--

INSERT INTO `ulubione` (`id`, `idFilm`, `idUzytkownik`, `data`) VALUES
(8, 4, 5, '2017-07-12 07:08:40'),
(9, 4, 4, '2017-07-12 02:57:52');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownik`
--

CREATE TABLE `uzytkownik` (
  `id` int(10) UNSIGNED NOT NULL,
  `nazwa` varchar(20) COLLATE utf8_polish_ci NOT NULL,
  `haslo` varchar(20) COLLATE utf8_polish_ci NOT NULL,
  `email` varchar(40) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `uzytkownik`
--

INSERT INTO `uzytkownik` (`id`, `nazwa`, `haslo`, `email`) VALUES
(4, 'piotr', 'HEJ', 'piotr@gmail.com'),
(5, 'szymon', 'hej', 'szybed001@gmail.com');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wypozyczenie`
--

CREATE TABLE `wypozyczenie` (
  `id` int(10) UNSIGNED NOT NULL,
  `idFilmu` int(10) UNSIGNED NOT NULL,
  `idUzytkownik` int(10) UNSIGNED NOT NULL,
  `cenaWypozyczenia` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zdjecia`
--

CREATE TABLE `zdjecia` (
  `id` int(10) UNSIGNED NOT NULL,
  `idFilm` int(10) UNSIGNED NOT NULL,
  `zdjecie` varchar(30) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `zdjecia`
--

INSERT INTO `zdjecia` (`id`, `idFilm`, `zdjecie`) VALUES
(1, 4, 'SpiderMan1.jpg'),
(2, 4, 'SpiderMan2.jpg'),
(3, 4, 'SpiderMan3.jpg'),
(4, 4, 'SpiderMan4.jpg'),
(5, 4, 'SpiderMan5.jpg');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idKategoriaFilmu` (`idKategoriaFilmu`);

--
-- Indexes for table `kategoriefilm`
--
ALTER TABLE `kategoriefilm`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ocena`
--
ALTER TABLE `ocena`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idFilm` (`idFilm`),
  ADD KEY `idUzytkownik` (`idUzytkownik`);

--
-- Indexes for table `ulubione`
--
ALTER TABLE `ulubione`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idFilm` (`idFilm`),
  ADD KEY `idUzytkownik` (`idUzytkownik`);

--
-- Indexes for table `uzytkownik`
--
ALTER TABLE `uzytkownik`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wypozyczenie`
--
ALTER TABLE `wypozyczenie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idFilmu` (`idFilmu`),
  ADD KEY `idUzytkownik` (`idUzytkownik`);

--
-- Indexes for table `zdjecia`
--
ALTER TABLE `zdjecia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idFilm` (`idFilm`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `film`
--
ALTER TABLE `film`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT dla tabeli `kategoriefilm`
--
ALTER TABLE `kategoriefilm`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT dla tabeli `ocena`
--
ALTER TABLE `ocena`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT dla tabeli `ulubione`
--
ALTER TABLE `ulubione`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT dla tabeli `uzytkownik`
--
ALTER TABLE `uzytkownik`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT dla tabeli `wypozyczenie`
--
ALTER TABLE `wypozyczenie`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT dla tabeli `zdjecia`
--
ALTER TABLE `zdjecia`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `film`
--
ALTER TABLE `film`
  ADD CONSTRAINT `film_ibfk_1` FOREIGN KEY (`idKategoriaFilmu`) REFERENCES `kategoriefilm` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `ocena`
--
ALTER TABLE `ocena`
  ADD CONSTRAINT `ocena_ibfk_1` FOREIGN KEY (`idFilm`) REFERENCES `film` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ocena_ibfk_2` FOREIGN KEY (`idUzytkownik`) REFERENCES `uzytkownik` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `ulubione`
--
ALTER TABLE `ulubione`
  ADD CONSTRAINT `ulubione_ibfk_1` FOREIGN KEY (`idFilm`) REFERENCES `film` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ulubione_ibfk_2` FOREIGN KEY (`idUzytkownik`) REFERENCES `uzytkownik` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `wypozyczenie`
--
ALTER TABLE `wypozyczenie`
  ADD CONSTRAINT `wypozyczenie_ibfk_1` FOREIGN KEY (`idFilmu`) REFERENCES `film` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wypozyczenie_ibfk_2` FOREIGN KEY (`idUzytkownik`) REFERENCES `uzytkownik` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `zdjecia`
--
ALTER TABLE `zdjecia`
  ADD CONSTRAINT `zdjecia_ibfk_1` FOREIGN KEY (`idFilm`) REFERENCES `film` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
