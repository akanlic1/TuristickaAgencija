-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2016 at 04:14 PM
-- Server version: 5.1.73-community
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `wtbaza`
--

-- --------------------------------------------------------

--
-- Table structure for table `novosti`
--

CREATE TABLE IF NOT EXISTS `novosti` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naslov` varchar(100) CHARACTER SET utf8 COLLATE utf8_slovenian_ci NOT NULL,
  `tekst` text CHARACTER SET utf8 COLLATE utf8_slovenian_ci NOT NULL,
  `autor_id` int(11) NOT NULL,
  `vrijeme` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `slika` varchar(255) CHARACTER SET utf8 COLLATE utf8_slovenian_ci DEFAULT NULL,
  `komentarisanje` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `autor_index` (`autor_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin2 COLLATE=latin2_croatian_ci AUTO_INCREMENT=14 ;

--
-- Dumping data for table `novosti`
--

INSERT INTO `novosti` (`id`, `naslov`, `tekst`, `autor_id`, `vrijeme`, `slika`, `komentarisanje`) VALUES
(1, 'Posjetite Pariz - grad ljubavi, svjetlosti, umjetnosti i kulture', 'Pariz? Grad svjetla, mode, kulture, romantike, provoda i odlične kuhinje nije samo francuska, nego i istinska kozmopolitska prijestolnica! Već desetljećima očarava posjetitelje svojim znamenitostima, ali ni dalje ne gubi na popularnosti te ga milijuni turista svake godine čine jednim od najposjećenijih svjetskih odredišta.\r\n| \r\nOtkud zapravo početi? Možda najbolje u caféu s croissantom i francuskim doručkom, njime jutro dobiva pravi domaći štih. S razgledavanjem grada je najbolje krenuti s Ile de la Cité, otoka na rijeci Seini na kojem se nalazi Notre Dame de Paris, jedan od glavnih pariških simbola. Legenda kaže da je biskup imao viziju o najljepšoj gradskoj katedrali te ju je nacrtao u blatu pokraj budućeg gradilišta. Zamišljeno, ostvareno, i to u 12. stoljeću, istinsko gotičko remek-djelo. Glas o njezinoj ljepoti i jedinstvenim skulpturama pročuo se po cijeloj Francuskoj, a svoju popularnost je najviše stekla romanom ''Zvonar crkve Notre Dame''.\r\n\r\nKoliko značenje ova katedrala ima za grad, dokazuje i Point zéro, glavna polazišna točka otkud se mjere udaljenosti za sve francuske ceste, a nalazi se na trgu ispred crkve. U neposrednoj blizini je i Sainte Chappelle, predivna crkva s plavim svodovima i obojenim vitrajima, koju je najljepše vidjeti kad je sunčan dan jer onda pokazuje svu svoju raskoš. Njena pak legenda kaže da je sagrađena kako bi se u njoj čuvala Kristova kruna od trnja i dio križa.', 2, '2016-06-04 16:56:08', 'http://www.globo-travel.com/files/products/1590/pari.jpg', 0),
(2, 'Šoping u Njujorku ?', 'Za Britance, Nemce, Skandinavce... odlazak do američke prestonice trgovine i najvećeg grada u SAD postao je uobičajeni način kupovine. Osim ogromne uštede novca, koja je zavidna i uz plaćenu povratnu avionsku kartu i noćenja u hotelu, šoping u Njujorku pruža i neizmerno zadovoljstvo boravka u najzavodljivijem gradu na planeti.', 2, '2016-06-04 16:57:05', 'http://www.vijesti.me/media/cache/67/23/6723a529770ec7f7b6af8862a5694d6e.jpg', 1),
(3, 'Maldivi, romantična destinacija za potpuni odmor', 'Ako ste zamišljali mjesto gdje ćete možda pobjeći sa svojom boljom polovicom, ali mislimo stvarno pobjeći, mjesto gdje vas nitko neće moći zezati i dosađivati vam, tada ste sigurno više puta pomislili na Maldive.Maldivi su poznati kao otočna država u Indijskom oceanu i to jugozapadno od Indijskog poluotoka.Maldivi su poznati kao područje topline i vlage gdje hladni povjetarac razbija dosadu koju donosi vrućina.Ono što je većina mogla primjetiti kako su bogati kulturom.', 2, '2016-06-04 16:58:40', 'http://zenstvena.com/wp-content/uploads/2015/02/maldivi-putovanje.jpg', 0),
(4, 'Otok Kecil, jedan od čarobnih otoka', 'Na sjeveroistočnoj strani Malajskoj poluotoka smjestili su se pravi rajski otoci koji jednostavno oduzimaju dah. Perhentianski otoci se nalaze među top destinacijama koji svake godine privuku velik broj zaljubljenika u tropske krajeve. Pješčane plaže i misterozno plavetnilo pravi su mamac za mnoge turiste.Kecil je stvoren za one koji vole tulumariti i koji na svom godišnjem odmoru ne žele veći dio vremena provesti samo u izležavanju.', 1, '2016-06-04 16:59:20', 'http://www.putokosvijeta.com/wp-content/uploads/2014/03/otok-kecil.jpg', 0),
(6, 'Acapulco, savršeno mjesto za odmor', 'Meksiko se slobodno može svrstati u najpopularnija odredišta na svijetu kada su u pitanju odmori na obali. Cancun i Acapulco dva su glavna aduta i bisera tog dijela Amerike koji svake godine namame mnoštvo znatiželjnika u potrazi za dobrom zabavom i odmorom iz snova. Acapulco je pravi turistički grad koji nudi sve to, a i više.Glamurozno i ekskluzivno ljetovalište nudi bogat paket sadržaja, od zabave koja traje neprekidno do svih ostalih zanimljivosti koje će zadovoljiti ukus svakoga.', 1, '2016-06-04 17:00:29', 'http://www.putokosvijeta.com/wp-content/uploads/2013/07/pogled-na-acapulco.jpg', 1),
(7, 'Istanbul – šta posjetiti u gradu preko 15 miliona stanovnika', 'Istanbul sam zamišljala kao bajkovit grad u kojem se na svakom ćošku osjeća taj spoj Istoka i Zapada. I da, donekle je baš tako. Jedino što još na svakom koraku osjećate da je to grad u kom živi preko 15 miliona ljudi.Istanbul je zaista grad u kojem na svakom koraku imate ostatke bogate historije, a ujedno i primjese modernog doba. ', 1, '2016-06-04 17:01:46', 'http://wikitravel.org/upload/shared//f/fb/Istanbul_Banner.jpg', 1),
(8, 'Dubai - turistički fenomen', 'Dubai je kao turistička destinacija postao pravi fenomen i ceo svet je ostavio u šoku. Mnoga popularna turistička mesta pokušavala su godinama da steknu reputaciju i izgrade potrebnu infrastrukturu kako bi privukla turiste, a turizam u Dubaiu rascvetao se u vrlo kratkom vremenskom periodu, zahvaljujući nekim pametnim potezima tamnošnje vlade.', 1, '2016-06-04 17:01:46', 'http://www.bestdesertsafariindubai.com/blog/wp-content/uploads/2015/12/dubai.jpg', 1),
(9, 'Turistička prijestolnica karipskih ostrva - Bahami', 'Bahami su država u Atlantskom okeanu, čiji se glavni grad, Nasau, nalazi na ostrvu Nju Providens. Ovo je zemlja za čiju su vodenu površinu kosmonauti rekli da je najbistrija koja se vidi iz svemira! Čarima Bahama nije mogao odoleti ni Kristifor Kolumbo, istraživač i trgovac koji je vidio brojne zemlje sveta.Vjeruje se da naziv Bahami potiče od reči „baha mar“, što znači „plitko more“, a što su bile prve reči Kolumba kada je vidio vodenu površinu ove države ispred sebe.', 1, '2016-06-04 17:02:24', 'http://www.putokosvijeta.com/wp-content/uploads/2013/05/plaza-na-otoku1.jpg', 0),
(10, 'Praia de Rocha, prekrasna pješčana plaža', 'Jeste li razmišljali o odmoru i Portugalu? Ako još niste vrijeme je da posjetite zaista čarobnu zemlju koja privlači mnoge. Portugal nudi toliko toga poput zanimljive kulture, vrhunskih specijaliteta, brojnih znamenitosti i prekrasnih plaža. Pijesak, plavetnilo i mir. Ima li što bolje? Praia de Rocha je malo i otmjeno naselje koje se s vremenom pretvorilo u jedan od glavnih turističkih aduta Portugala.', 1, '2016-06-04 17:02:55', 'http://www.putokosvijeta.com/wp-content/uploads/2014/02/praia-de-rocha.jpg', 1),
(11, 'Filipini, destinacija raznih kultura', 'Filipini su poznati kao destinacija s nevjerojatnom kombinacijom raznih kultura, tradicija i znamenitosti. Pored prekrasnih plaža na čuvenom Palawanu, Filipini nude brojne druge atrakcije kao što su terase rižinih polja smještene na obroncima planine. Radi se o turističkoj destinaciji koju čini oko 7.000 otoka, a koja svoje bogate pakete sadržaja obogaćuje raznim uslugama.Svaki predio Filipina nudi sadržaje za svaku dobnu skupinu za one koji se žele samo opuštati i avanturiste koji žele malo bolje upoznati otoke..', 1, '2016-06-04 17:03:24', 'http://www.putokosvijeta.com/wp-content/uploads/2014/02/praia-de-rocha.jpg', 1),
(12, 'Otok Palawan - raj na Filipinima', 'Na sjevernom dijelu Filipina smjestio se Palawan, poznat kao otok kojeg odlikuju besprijekorne i neodoljive plaže te nevjerojatne lokacije za ronjenje i istraživanje tropske prašume. Otok se smjestio između Južnokineskog mora i mora Sulu na kojem se nalazi zaštićeno mjesto Svjetske baštine UNESCO-a s najdubljom plovnom podzmenom rijekom.Na otoku se nalazi jedinstvena lepeza flore i faune, ekološkog, biološkog i morskog života uključujući i ugrožene dugong', 1, '2016-06-04 17:04:50', 'http://www.putokosvijeta.com/wp-content/uploads/2013/05/plaza-na-otoku2.jpg', 1),
(13, 'Barbados, suncem okupana zemlja', 'Vjerojatno će se većina složiti kako su Karibi jedno od najljep&scaron;ih mjesta na cijelom planetu. Njihova raznovrsna ponuda po pitanju rajskih plaža te neodoljive okolice stavlja ih u sam vrh. Barbados su jo&scaron; jedan dokaz svemu navedenom, budući da se po mnogima radi o suncem okupanoj zemlji. Kristalni pijesak, mno&scaron;tvo laguna i ljubazni domaćini samo su dio čarobne ponude.To je tropski otok u čijoj unutra&scaron;njosti postoji bujna vegetcija i brojne močvare dok je obala rezervirana za tirkizne oaze okupane suncem.', 3, '2016-06-06 13:08:23', 'http://www.putokosvijeta.com/wp-content/uploads/2013/09/plaza-na-barbadosu.jpg', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `novosti`
--
ALTER TABLE `novosti`
  ADD CONSTRAINT `novosti_ibfk_1` FOREIGN KEY (`autor_id`) REFERENCES `korisnici` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
