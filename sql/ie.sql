-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Φιλοξενητής: localhost
-- Χρόνος δημιουργίας: 29 Ιουν 2012 στις 10:45:06
-- Έκδοση Διακομιστή: 5.5.16
-- Έκδοση PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Βάση: `ie`
--

-- --------------------------------------------------------

--
-- Δομή Πίνακα για τον Πίνακα `config`
--

CREATE TABLE IF NOT EXISTS `config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `warning_message` text,
  `intro_message` text,
  `evaluation_period` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Άδειασμα δεδομένων του πίνακα `config`
--

INSERT INTO `config` (`id`, `warning_message`, `intro_message`, `evaluation_period`) VALUES
(1, 'Παρακαλώ εισάγετε το όνομα χρήστη και κωδικό που έχετε στο studweb', 'No Message of the Day!', 1);

-- --------------------------------------------------------

--
-- Δομή Πίνακα για τον Πίνακα `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `semester` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `semester` (`semester`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Άδειασμα δεδομένων του πίνακα `course`
--

INSERT INTO `course` (`id`, `name`, `semester`) VALUES
(1, 'Κοινωνία της Πληροφορίας', 1),
(2, 'Αλγόριθμοι κ Δομές Δεδομένων(Ε)', 2),
(3, 'Αλγόριθμοι κ Δομές Δεδομένων', 2),
(4, 'Δίκτυα Ι', 4);

-- --------------------------------------------------------

--
-- Δομή Πίνακα για τον Πίνακα `course_professor`
--

CREATE TABLE IF NOT EXISTS `course_professor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`),
  KEY `pid` (`pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Άδειασμα δεδομένων του πίνακα `course_professor`
--

INSERT INTO `course_professor` (`id`, `cid`, `pid`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 2, 3),
(7, 3, 3);

-- --------------------------------------------------------

--
-- Δομή Πίνακα για τον Πίνακα `professor`
--

CREATE TABLE IF NOT EXISTS `professor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Άδειασμα δεδομένων του πίνακα `professor`
--

INSERT INTO `professor` (`id`, `name`, `surname`) VALUES
(1, 'Μιχάλης', 'Παρασκευάς'),
(2, 'Παναγιώτης', 'Αλεφραγκής'),
(3, 'Γεώργιος', 'Ασημακόπουλος'),
(4, 'Παρασκευάς', 'Κίτσος');

-- --------------------------------------------------------

--
-- Δομή Πίνακα για τον Πίνακα `question`
--

CREATE TABLE IF NOT EXISTS `question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `multiple_choice` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=39 ;

--
-- Άδειασμα δεδομένων του πίνακα `question`
--

INSERT INTO `question` (`id`, `name`, `multiple_choice`) VALUES
(1, 'Οι στόχοι του μαθήματος ήταν σαφείς;', 1),
(2, 'Η ύλη που καλύφθηκε ανταποκρινόταν στους στόχους του μαθήματος;', 1),
(3, 'Η ύλη που διδάχθηκε ήταν καλά οργανωμένη;', 1),
(4, 'Το εκπαιδευτικό υλικό που χρησιμοποιήθηκε βοήθησε στην καλύτερη κατανόηση του θέματος;', 1),
(5, 'Τα εκπαιδευτικά βοηθήματα ("σύγγραμμα", σημειώσεις, πρόσθετη βιβλιογραφία) χορηγήθηκαν εγκαίρως;', 1),
(6, 'Πόσο ικανοποιητικό βρίσκετε το κύριο βιβλίο(α) ή τις σημειώσεις;', 1),
(7, 'Πόσο εύκολα διαθέσιμη είναι η βιβλιογραφία στην Πανεπιστημιακή Βιβλιοθήκη;', 1),
(8, 'Πόσο απαραίτητα κρίνετε τα προαπαιτούμενα του μαθήματος;', 1),
(9, 'Χρήση γνώσεων από / σύνδεση με άλλα μαθήματα.', 1),
(10, 'Πως κρίνετε το επίπεδο δυσκολίας του μαθήματος για το έτος του;', 1),
(11, 'Χρησιμότητα ύπαρξης φροντιστηρίων.', 1),
(12, 'Αξιολόγηση ποιότητας φροντιστηρίων.', 1),
(13, 'Πως κρίνετε τον αριθμό Διδακτικών Μονάδων σε σχέση με τον φόρτο εργασίας;', 1),
(14, 'Διαφάνεια των κριτηρίων βαθμολόγησης.', 1),
(15, 'Το θέμα δόθηκε εγκαίρως;', 1),
(16, 'Η καταληκτική ημερομηνία για υποβολή ή παρουσίαση των εργασιών ήταν λογική;', 1),
(17, 'Υπήρχε σχετικό ερευνητικό υλικό στη βιβλιοθήκη;', 1),
(18, 'Υπήρχε καθοδήγηση από τον διδάσκοντα;', 1),
(19, 'Τα σχόλια του διδάσκοντος ήταν επικοδομητικά και αναλυτικά;', 1),
(20, 'Δόθηκε η δυνατότητα βελτίωσης της εργασίας;', 1),
(21, 'Η συγκεκριμένη εργασία σας βοήθησε να κατανοήσετε το συγκεκριμένο θέμα;', 1),
(22, 'Οργανώνει καλά την παρουσίαση της ύλης στα μαθήματα;', 1),
(23, 'Επιτυγχάνει να διεγείρει το ενδιαφέρον για το αντικείμενο του μαθήματος;', 1),
(24, 'Αναλύει και παρουσιάζει τις έννοιες με τρόπο απλό και ενδιαφέροντα χρησιμοποιώντας παραδείγματα;', 1),
(25, 'Ενθαρρύνει τους φοιτητές να διατυπώνουν απορίες και ερωτήσεις και για να αναπτύξουν την κρίση τους;', 1),
(26, 'Ήταν συνεπής στις υποχρεώσεις του/της (παρουσία στα μαθήματα, έγκαιρη διόρθωση εργασιών ή εργαστηριακών αναφορών, ώρες συνεργασίας με τους φοιτητές);', 1),
(27, 'Είναι γενικά προσιτός στους φοιτητές;', 1),
(28, 'Πως κρίνετε τη συμβολή του στην καλύτερη κατανόηση της ύλης;', 1),
(29, 'Πως κρίνετε το επίπεδο δυσκολίας του εργαστηρίου για το έτος;', 1),
(30, 'Είναι επαρκείς οι σημειώσεις ως προς τις εργαστηρικές ασκήσεις;', 1),
(31, 'Εξηγούνται καλά οι βασικές αρχές των πειραμάτων / ασκήσεων;', 1),
(32, 'Είναι επαρκής ο εξοπλισμός του εργαστηρίου;', 1),
(33, 'Παρακολουθώ τακτικά τις διαλέξεις.', 1),
(34, 'Παρακολουθώ τακτικά τα εργαστήρια.', 1),
(35, 'Ανταποκρίνομαι συστηματικά στις γραπτές εργασίες / ασκήσεις.', 1),
(36, 'Μελετώ συστηματικά την ύλη.', 1),
(37, 'Αφιερώνω εβδομαδιαία για μελέτη του συγκεκριμένου μαθήματος:  1= <2 ''Ωρες, 2= 2-4 ''Ωρες, 3= 4-6  Ώρες, 4= 6-8  Ώρες, 5= >8 Ώρες', 1),
(38, 'Παρατηρήσεις και σχόλια:', 0);

-- --------------------------------------------------------

--
-- Δομή Πίνακα για τον Πίνακα `result`
--

CREATE TABLE IF NOT EXISTS `result` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `qid` int(11) NOT NULL,
  `ans1` int(11) DEFAULT '0',
  `ans2` int(11) DEFAULT '0',
  `ans3` int(11) DEFAULT '0',
  `ans4` int(11) DEFAULT '0',
  `ans5` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`),
  KEY `pid` (`pid`),
  KEY `qid` (`qid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=186 ;

--
-- Άδειασμα δεδομένων του πίνακα `result`
--

INSERT INTO `result` (`id`, `cid`, `pid`, `qid`, `ans1`, `ans2`, `ans3`, `ans4`, `ans5`) VALUES
(1, 1, 1, 1, 0, 0, 0, 0, 0),
(2, 2, 2, 1, 0, 0, 0, 0, 0),
(3, 2, 3, 1, 0, 0, 0, 0, 0),
(4, 1, 1, 2, 0, 0, 0, 0, 0),
(5, 2, 2, 2, 0, 0, 0, 0, 0),
(6, 2, 3, 2, 0, 0, 0, 0, 0),
(7, 1, 1, 3, 0, 0, 0, 0, 0),
(8, 2, 2, 3, 0, 0, 0, 0, 0),
(9, 2, 3, 3, 0, 0, 0, 0, 0),
(10, 1, 1, 4, 0, 0, 0, 0, 0),
(11, 2, 2, 4, 0, 0, 0, 0, 0),
(12, 2, 3, 4, 0, 0, 0, 0, 0),
(13, 1, 1, 5, 0, 0, 0, 0, 0),
(14, 2, 2, 5, 0, 0, 0, 0, 0),
(15, 2, 3, 5, 0, 0, 0, 0, 0),
(16, 1, 1, 6, 0, 0, 0, 0, 0),
(17, 2, 2, 6, 0, 0, 0, 0, 0),
(18, 2, 3, 6, 0, 0, 0, 0, 0),
(19, 1, 1, 7, 0, 0, 0, 0, 0),
(20, 2, 2, 7, 0, 0, 0, 0, 0),
(21, 2, 3, 7, 0, 0, 0, 0, 0),
(22, 1, 1, 8, 0, 0, 0, 0, 0),
(23, 2, 2, 8, 0, 0, 0, 0, 0),
(24, 2, 3, 8, 0, 0, 0, 0, 0),
(25, 1, 1, 9, 0, 0, 0, 0, 0),
(26, 2, 2, 9, 0, 0, 0, 0, 0),
(27, 2, 3, 9, 0, 0, 0, 0, 0),
(28, 1, 1, 10, 0, 0, 0, 0, 0),
(29, 2, 2, 10, 0, 0, 0, 0, 0),
(30, 2, 3, 10, 0, 0, 0, 0, 0),
(31, 1, 1, 11, 0, 0, 0, 0, 0),
(32, 2, 2, 11, 0, 0, 0, 0, 0),
(33, 2, 3, 11, 0, 0, 0, 0, 0),
(34, 1, 1, 12, 0, 0, 0, 0, 0),
(35, 2, 2, 12, 0, 0, 0, 0, 0),
(36, 2, 3, 12, 0, 0, 0, 0, 0),
(37, 1, 1, 13, 0, 0, 0, 0, 0),
(38, 2, 2, 13, 0, 0, 0, 0, 0),
(39, 2, 3, 13, 0, 0, 0, 0, 0),
(40, 1, 1, 14, 0, 0, 0, 0, 0),
(41, 2, 2, 14, 0, 0, 0, 0, 0),
(42, 2, 3, 14, 0, 0, 0, 0, 0),
(43, 1, 1, 15, 0, 0, 0, 0, 0),
(44, 2, 2, 15, 0, 0, 0, 0, 0),
(45, 2, 3, 15, 0, 0, 0, 0, 0),
(46, 1, 1, 16, 0, 0, 0, 0, 0),
(47, 2, 2, 16, 0, 0, 0, 0, 0),
(48, 2, 3, 16, 0, 0, 0, 0, 0),
(49, 1, 1, 17, 0, 0, 0, 0, 0),
(50, 2, 2, 17, 0, 0, 0, 0, 0),
(51, 2, 3, 17, 0, 0, 0, 0, 0),
(52, 1, 1, 18, 0, 0, 0, 0, 0),
(53, 2, 2, 18, 0, 0, 0, 0, 0),
(54, 2, 3, 18, 0, 0, 0, 0, 0),
(55, 1, 1, 19, 0, 0, 0, 0, 0),
(56, 2, 2, 19, 0, 0, 0, 0, 0),
(57, 2, 3, 19, 0, 0, 0, 0, 0),
(58, 1, 1, 20, 0, 0, 0, 0, 0),
(59, 2, 2, 20, 0, 0, 0, 0, 0),
(60, 2, 3, 20, 0, 0, 0, 0, 0),
(61, 1, 1, 21, 0, 0, 0, 0, 0),
(62, 2, 2, 21, 0, 0, 0, 0, 0),
(63, 2, 3, 21, 0, 0, 0, 0, 0),
(64, 1, 1, 22, 0, 0, 0, 0, 0),
(65, 2, 2, 22, 0, 0, 0, 0, 0),
(66, 2, 3, 22, 0, 0, 0, 0, 0),
(67, 1, 1, 23, 0, 0, 0, 0, 0),
(68, 2, 2, 23, 0, 0, 0, 0, 0),
(69, 2, 3, 23, 0, 0, 0, 0, 0),
(70, 1, 1, 24, 0, 0, 0, 0, 0),
(71, 2, 2, 24, 0, 0, 0, 0, 0),
(72, 2, 3, 24, 0, 0, 0, 0, 0),
(73, 1, 1, 25, 0, 0, 0, 0, 0),
(74, 2, 2, 25, 0, 0, 0, 0, 0),
(75, 2, 3, 25, 0, 0, 0, 0, 0),
(76, 1, 1, 26, 0, 0, 0, 0, 0),
(77, 2, 2, 26, 0, 0, 0, 0, 0),
(78, 2, 3, 26, 0, 0, 0, 0, 0),
(79, 1, 1, 27, 0, 0, 0, 0, 0),
(80, 2, 2, 27, 0, 0, 0, 0, 0),
(81, 2, 3, 27, 0, 0, 0, 0, 0),
(82, 1, 1, 28, 0, 0, 0, 0, 0),
(83, 2, 2, 28, 0, 0, 0, 0, 0),
(84, 2, 3, 28, 0, 0, 0, 0, 0),
(85, 1, 1, 29, 0, 0, 0, 0, 0),
(86, 2, 2, 29, 0, 0, 0, 0, 0),
(87, 2, 3, 29, 0, 0, 0, 0, 0),
(88, 1, 1, 30, 0, 0, 0, 0, 0),
(89, 2, 2, 30, 0, 0, 0, 0, 0),
(90, 2, 3, 30, 0, 0, 0, 0, 0),
(91, 1, 1, 31, 0, 0, 0, 0, 0),
(92, 2, 2, 31, 0, 0, 0, 0, 0),
(93, 2, 3, 31, 0, 0, 0, 0, 0),
(94, 1, 1, 32, 0, 0, 0, 0, 0),
(95, 2, 2, 32, 0, 0, 0, 0, 0),
(96, 2, 3, 32, 0, 0, 0, 0, 0),
(97, 1, 1, 33, 0, 0, 0, 0, 0),
(98, 2, 2, 33, 0, 0, 0, 0, 0),
(99, 2, 3, 33, 0, 0, 0, 0, 0),
(100, 1, 1, 34, 0, 0, 0, 0, 0),
(101, 2, 2, 34, 0, 0, 0, 0, 0),
(102, 2, 3, 34, 0, 0, 0, 0, 0),
(103, 1, 1, 35, 0, 0, 0, 0, 0),
(104, 2, 2, 35, 0, 0, 0, 0, 0),
(105, 2, 3, 35, 0, 0, 0, 0, 0),
(106, 1, 1, 36, 0, 0, 0, 0, 0),
(107, 2, 2, 36, 0, 0, 0, 0, 0),
(108, 2, 3, 36, 0, 0, 0, 0, 0),
(109, 1, 1, 37, 0, 0, 0, 0, 0),
(110, 2, 2, 37, 0, 0, 0, 0, 0),
(111, 2, 3, 37, 0, 0, 0, 0, 0),
(149, 3, 3, 1, 0, 0, 0, 0, 0),
(150, 3, 3, 2, 0, 0, 0, 0, 0),
(151, 3, 3, 3, 0, 0, 0, 0, 0),
(152, 3, 3, 4, 0, 0, 0, 0, 0),
(153, 3, 3, 5, 0, 0, 0, 0, 0),
(154, 3, 3, 6, 0, 0, 0, 0, 0),
(155, 3, 3, 7, 0, 0, 0, 0, 0),
(156, 3, 3, 8, 0, 0, 0, 0, 0),
(157, 3, 3, 9, 0, 0, 0, 0, 0),
(158, 3, 3, 10, 0, 0, 0, 0, 0),
(159, 3, 3, 11, 0, 0, 0, 0, 0),
(160, 3, 3, 12, 0, 0, 0, 0, 0),
(161, 3, 3, 13, 0, 0, 0, 0, 0),
(162, 3, 3, 14, 0, 0, 0, 0, 0),
(163, 3, 3, 15, 0, 0, 0, 0, 0),
(164, 3, 3, 16, 0, 0, 0, 0, 0),
(165, 3, 3, 17, 0, 0, 0, 0, 0),
(166, 3, 3, 18, 0, 0, 0, 0, 0),
(167, 3, 3, 19, 0, 0, 0, 0, 0),
(168, 3, 3, 20, 0, 0, 0, 0, 0),
(169, 3, 3, 21, 0, 0, 0, 0, 0),
(170, 3, 3, 22, 0, 0, 0, 0, 0),
(171, 3, 3, 23, 0, 0, 0, 0, 0),
(172, 3, 3, 24, 0, 0, 0, 0, 0),
(173, 3, 3, 25, 0, 0, 0, 0, 0),
(174, 3, 3, 26, 0, 0, 0, 0, 0),
(175, 3, 3, 27, 0, 0, 0, 0, 0),
(176, 3, 3, 28, 0, 0, 0, 0, 0),
(177, 3, 3, 29, 0, 0, 0, 0, 0),
(178, 3, 3, 30, 0, 0, 0, 0, 0),
(179, 3, 3, 31, 0, 0, 0, 0, 0),
(180, 3, 3, 32, 0, 0, 0, 0, 0),
(181, 3, 3, 33, 0, 0, 0, 0, 0),
(182, 3, 3, 34, 0, 0, 0, 0, 0),
(183, 3, 3, 35, 0, 0, 0, 0, 0),
(184, 3, 3, 36, 0, 0, 0, 0, 0),
(185, 3, 3, 37, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Δομή Πίνακα για τον Πίνακα `semester`
--

CREATE TABLE IF NOT EXISTS `semester` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sem_num` int(11) NOT NULL,
  `sem_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Άδειασμα δεδομένων του πίνακα `semester`
--

INSERT INTO `semester` (`id`, `sem_num`, `sem_name`) VALUES
(1, 1, 'Α'' Εξάμηνο'),
(2, 2, 'Β'' Εξάμηνο'),
(3, 3, 'Γ'' Εξάμηνο'),
(4, 4, 'Δ'' Εξάμηνο'),
(5, 5, 'E'' Εξάμηνο');

-- --------------------------------------------------------

--
-- Δομή Πίνακα για τον Πίνακα `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `username` varchar(50) DEFAULT NULL,
  `pass` varchar(50) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Δομή Πίνακα για τον Πίνακα `textresult`
--

CREATE TABLE IF NOT EXISTS `textresult` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `qid` int(11) NOT NULL,
  `textans` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Περιορισμοί για άχρηστους πίνακες
--

--
-- Περιορισμοί για πίνακα `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_ibfk_1` FOREIGN KEY (`semester`) REFERENCES `semester` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Περιορισμοί για πίνακα `course_professor`
--
ALTER TABLE `course_professor`
  ADD CONSTRAINT `course_professor_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `course` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `course_professor_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `professor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Περιορισμοί για πίνακα `result`
--
ALTER TABLE `result`
  ADD CONSTRAINT `result_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `course` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `result_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `professor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `result_ibfk_3` FOREIGN KEY (`qid`) REFERENCES `question` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
