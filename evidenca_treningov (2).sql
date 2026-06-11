-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gostitelj: 127.0.0.1
-- Čas nastanka: 10. jun 2026 ob 19.34
-- Različica strežnika: 10.4.32-MariaDB
-- Različica PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Zbirka podatkov: `evidenca_treningov`
--

-- --------------------------------------------------------

--
-- Struktura tabele `izvedbavaje`
--

CREATE TABLE `izvedbavaje` (
  `id` int(11) NOT NULL,
  `serije` int(11) NOT NULL,
  `ponovitve` int(11) NOT NULL,
  `teza` decimal(10,0) NOT NULL,
  `Trening_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ucs2 COLLATE=ucs2_slovenian_ci;

-- --------------------------------------------------------

--
-- Struktura tabele `lokacija`
--

CREATE TABLE `lokacija` (
  `id` int(11) NOT NULL,
  `naziv` varchar(250) NOT NULL,
  `naslov` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ucs2 COLLATE=ucs2_slovenian_ci;

--
-- Odloži podatke za tabelo `lokacija`
--

INSERT INTO `lokacija` (`id`, `naziv`, `naslov`) VALUES
(1, 'Fitnes Velenje', 'Kidriceva 10, Velenje'),
(2, 'Domaci fitnes', 'Smartno ob Paki 15'),
(3, 'Sportni park', 'Celjska cesta 20');

-- --------------------------------------------------------

--
-- Struktura tabele `set_treningov`
--

CREATE TABLE `set_treningov` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `naslov` varchar(250) NOT NULL,
  `opis` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ucs2 COLLATE=ucs2_slovenian_ci;

--
-- Odloži podatke za tabelo `set_treningov`
--

INSERT INTO `set_treningov` (`id`, `naslov`, `opis`) VALUES
(4, 'leg day', 'hamstrings,quads'),
(7, 'leg day', 'dkomaj hodim');

-- --------------------------------------------------------

--
-- Struktura tabele `set_uporabnik`
--

CREATE TABLE `set_uporabnik` (
  `id` int(11) NOT NULL,
  `Uporabnik_id` int(11) NOT NULL,
  `set_treningov_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ucs2 COLLATE=ucs2_slovenian_ci;

-- --------------------------------------------------------

--
-- Struktura tabele `set_vaje`
--

CREATE TABLE `set_vaje` (
  `id` int(11) NOT NULL,
  `vaje_id` bigint(20) UNSIGNED NOT NULL,
  `set_treningov_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ucs2 COLLATE=ucs2_slovenian_ci;

-- --------------------------------------------------------

--
-- Struktura tabele `trening`
--

CREATE TABLE `trening` (
  `id` int(11) NOT NULL,
  `datum` datetime NOT NULL,
  `čas_treninga` int(11) NOT NULL,
  `opis` text DEFAULT NULL,
  `Uporabnik_id` int(11) NOT NULL,
  `tezavnost` int(11) DEFAULT NULL,
  `slika` varchar(250) DEFAULT NULL,
  `Lokacija_id` int(11) NOT NULL,
  `VrstaTreninga_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ucs2 COLLATE=ucs2_slovenian_ci;

--
-- Odloži podatke za tabelo `trening`
--

INSERT INTO `trening` (`id`, `datum`, `čas_treninga`, `opis`, `Uporabnik_id`, `tezavnost`, `slika`, `Lokacija_id`, `VrstaTreninga_id`) VALUES
(0, '2026-06-06 00:00:00', 45, 'core trening', 2, 4, 'slikeTreningov/Pomivalnistroj.jfif', 1, 1);

-- --------------------------------------------------------

--
-- Struktura tabele `uporabnik`
--

CREATE TABLE `uporabnik` (
  `id` int(11) NOT NULL,
  `ime` varchar(250) NOT NULL,
  `priimek` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `geslo` varchar(250) DEFAULT NULL,
  `datum_roj` date DEFAULT NULL,
  `visina` int(11) DEFAULT NULL,
  `teza` decimal(10,0) DEFAULT NULL,
  `vloga` enum('uporabnik','admin') NOT NULL DEFAULT 'uporabnik'
) ENGINE=InnoDB DEFAULT CHARSET=ucs2 COLLATE=ucs2_slovenian_ci;

--
-- Odloži podatke za tabelo `uporabnik`
--

INSERT INTO `uporabnik` (`id`, `ime`, `priimek`, `email`, `geslo`, `datum_roj`, `visina`, `teza`, `vloga`) VALUES
(2, 'aljaz', 'rozic', 'aljaz@gmail.com', '$2y$10$ADbQgWFSBx6B/I9XtdtBKO41/dKf7Cu0JtbQbt2pJEfyi1.o5Z3oC', '2026-06-04', 169, 70, 'admin'),
(3, 'timi', 'vodovnik', 'timotej@gmail.com', '$2y$10$mkMWeJiMZtUjKF9jPNew1exacU/6qtG50PFWAPqbO4reRtvprjUr.', '2026-06-05', 179, 78, 'uporabnik'),
(4, 'filip', 'kranjčan', 'filip@gmail.com', '$2y$10$Hd3wsF5114epONm/IUXqJ.ahqgDDa6kf13hslDw.OuYEIO/9t1rqe', '2026-06-12', 187, 90, 'uporabnik');

-- --------------------------------------------------------

--
-- Struktura tabele `vaje`
--

CREATE TABLE `vaje` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `naslov` varchar(250) NOT NULL,
  `opis` text NOT NULL,
  `slika` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ucs2 COLLATE=ucs2_slovenian_ci;

-- --------------------------------------------------------

--
-- Struktura tabele `vrstatreninga`
--

CREATE TABLE `vrstatreninga` (
  `id` int(11) NOT NULL,
  `naziv` varchar(250) DEFAULT NULL,
  `opis` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ucs2 COLLATE=ucs2_slovenian_ci;

--
-- Odloži podatke za tabelo `vrstatreninga`
--

INSERT INTO `vrstatreninga` (`id`, `naziv`, `opis`) VALUES
(1, 'Fitnes', 'Trening z utezmi'),
(2, 'Kardio', 'Tek in kolesarjenje'),
(3, 'Kickboxing', 'Borilni trening');

--
-- Indeksi zavrženih tabel
--

--
-- Indeksi tabele `izvedbavaje`
--
ALTER TABLE `izvedbavaje`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Trening_IzvedbaVaje` (`Trening_id`);

--
-- Indeksi tabele `lokacija`
--
ALTER TABLE `lokacija`
  ADD PRIMARY KEY (`id`);

--
-- Indeksi tabele `set_treningov`
--
ALTER TABLE `set_treningov`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indeksi tabele `set_uporabnik`
--
ALTER TABLE `set_uporabnik`
  ADD PRIMARY KEY (`id`),
  ADD KEY `set_uporabnik_fkey_1` (`Uporabnik_id`),
  ADD KEY `set_uporabnik_fkey_2` (`set_treningov_id`);

--
-- Indeksi tabele `set_vaje`
--
ALTER TABLE `set_vaje`
  ADD PRIMARY KEY (`id`),
  ADD KEY `set_vaje_fkey_1` (`vaje_id`),
  ADD KEY `set_vaje_fkey_2` (`set_treningov_id`);

--
-- Indeksi tabele `trening`
--
ALTER TABLE `trening`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Uporabnik_Trening` (`Uporabnik_id`),
  ADD KEY `Lokacija_Trening` (`Lokacija_id`),
  ADD KEY `VrstaTreninga_Trening` (`VrstaTreninga_id`);

--
-- Indeksi tabele `uporabnik`
--
ALTER TABLE `uporabnik`
  ADD PRIMARY KEY (`id`);

--
-- Indeksi tabele `vaje`
--
ALTER TABLE `vaje`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indeksi tabele `vrstatreninga`
--
ALTER TABLE `vrstatreninga`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT zavrženih tabel
--

--
-- AUTO_INCREMENT tabele `set_treningov`
--
ALTER TABLE `set_treningov`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT tabele `uporabnik`
--
ALTER TABLE `uporabnik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT tabele `vaje`
--
ALTER TABLE `vaje`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Omejitve tabel za povzetek stanja
--

--
-- Omejitve za tabelo `izvedbavaje`
--
ALTER TABLE `izvedbavaje`
  ADD CONSTRAINT `Trening_IzvedbaVaje` FOREIGN KEY (`Trening_id`) REFERENCES `trening` (`id`);

--
-- Omejitve za tabelo `set_uporabnik`
--
ALTER TABLE `set_uporabnik`
  ADD CONSTRAINT `set_uporabnik_fkey_1` FOREIGN KEY (`Uporabnik_id`) REFERENCES `uporabnik` (`id`),
  ADD CONSTRAINT `set_uporabnik_fkey_2` FOREIGN KEY (`set_treningov_id`) REFERENCES `set_treningov` (`id`);

--
-- Omejitve za tabelo `set_vaje`
--
ALTER TABLE `set_vaje`
  ADD CONSTRAINT `set_vaje_fkey_1` FOREIGN KEY (`vaje_id`) REFERENCES `vaje` (`id`),
  ADD CONSTRAINT `set_vaje_fkey_2` FOREIGN KEY (`set_treningov_id`) REFERENCES `set_treningov` (`id`);

--
-- Omejitve za tabelo `trening`
--
ALTER TABLE `trening`
  ADD CONSTRAINT `Lokacija_Trening` FOREIGN KEY (`Lokacija_id`) REFERENCES `lokacija` (`id`),
  ADD CONSTRAINT `Uporabnik_Trening` FOREIGN KEY (`Uporabnik_id`) REFERENCES `uporabnik` (`id`),
  ADD CONSTRAINT `VrstaTreninga_Trening` FOREIGN KEY (`VrstaTreninga_id`) REFERENCES `vrstatreninga` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
