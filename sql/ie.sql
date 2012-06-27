-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Φιλοξενητής: localhost
-- Χρόνος δημιουργίας: 27 Ιουν 2012 στις 23:34:03
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Άδειασμα δεδομένων του πίνακα `course`
--

INSERT INTO `course` (`id`, `name`, `semester`) VALUES
(1, 'Κοινωνία της Πληροφορίας', 1),
(2, 'Αλγόριθμοι κ Δομές Δεδομένων(Ε)', 2),
(3, 'Αλγόριθμοι κ Δομές Δεδομένων', 2);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Άδειασμα δεδομένων του πίνακα `course_professor`
--

INSERT INTO `course_professor` (`id`, `cid`, `pid`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 2, 3),
(4, 3, 3);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=60 ;

--
-- Άδειασμα δεδομένων του πίνακα `question`
--

INSERT INTO `question` (`id`, `name`, `multiple_choice`) VALUES
(1, 'Οι στόχοι του μαθήματος ήταν σαφείς;', 1),
(2, 'Η ύλη που καλύφθηκε ανταποκρινόταν στους στόχους του μαθήματος;', 1),
(3, 'Η ύλη που διδάχθηκε ήταν καλά οργανωμένη;', 1),
(4, 'Το εκπαιδευτικό υλικό που χρησιμοποιήθηκε βοήθησε στη καλύτερη κατανόηση του θέματος;', 1),
(5, 'Τα εκπαιδευτικά βοηθήματα (<<σύγγραμμα>>, σημειώσεις, πρόσθετη βιβλιογραφία) χορηγήθηκαν εγκαίρως;', 1),
(6, 'Πόσο ικανοποιητικό βρίσκετε το κύριο βιβλίο(α) η τις σημειώσεις;', 1),
(7, 'Πόσο εύκολα διαθέσιμη είναι η βιβλιογραφία στην Πανεπιστημιακή Βιβλιοθήκη;', 1),
(8, 'Πόσο απαραίτητα κρίνετε τα προαπαιτούμενα του μαθήματος;', 1),
(9, 'Χρήση γνώσεων από/σύνδεση με άλλα μαθήματα.', 1),
(10, 'Πως κρίνετε το επίπεδο διδασκαλίας του μαθήματος για το έτος του;', 1),
(11, 'Χρησιμότητα ύπαρξης φροντιστηρίων.', 1),
(12, 'Αξιολόγηση ποιότητας φροντιστηρίων.', 1),
(13, 'Πως κρίνετε τον αριθμό Διδακτικών Μονάδων σε σχέση με τον φόρτο εργασίας;', 1),
(14, 'Διαφάνεια των κριτιρίων βαθμολόγησης.', 1),
(15, 'Το θέμα δόθηκε εγκαίρως;', 1),
(16, 'Η καταληκτική ημερομηνία για υποβολή η παρουσίαση των εργασιών ήταν λογική;', 1),
(17, 'Υπήρχε σχετικό ερευνητικό υλικό στη βιβλιοθήκη;', 1),
(18, 'Υπήρχε καθοδήγηση απο τον διδασκόντα;', 1),
(19, 'Τα σχόλια του διδασκόντος ήταν εποικοδομητικά και αναλυτικά;', 1),
(20, 'Η συγκεκριμένη εργασία σας βοήθησε να κατανοήσετε το συγκεκριμένο θέμα;', 1),
(21, 'Οργανώνει καλά την παρουσίαση της ύλης στα μαθήματα;', 1),
(22, 'Επιτυγχάνει να διεγείρει το ενδιαφέρον για το αντικείμενο του μαθήματος;', 1),
(23, 'Αναλύει και παρουσιάζει τις έννοιες με τρόπο απλό και ενδιαφέροντα χρησιμοποιώντας παραδείγματα;', 1),
(24, 'Ενθαρρύνει τους φοιτητές να διατυπώνουν απορίες και ερωτήσεις και για να αναπτύξουν την κρίση τους;', 1),
(25, 'Ήταν συνεπής στις υποχρεώσεις του/της(παρουσία στα μαθήματα, έγκαιρη διόρθωση εργασιών ή εργαστηριακών αναφορών, ώρες συνεργασίας με τους φοιτητές);', 1),
(26, 'Είναι γενικά προσιτός στους φοιτητές;', 1),
(27, 'Πώς κρίνετε τη συμβολή του στην καλύτερη κατανόηση της ύλης;', 1),
(28, 'Πως κρίνετε το επίπεδο δυσκολίας του μαθήματος για το έτος του;', 1),
(29, 'Είναι επαρκείς οι σημειώσεις ως προς τις εργαστηριακές ασκήσεις;', 1),
(30, 'Εξηγούνται καλά οι βασικές αρχές των πειραμάτων/ασκήσεων;', 1),
(31, 'Είναι επαρκής ο εξοπλισμός του εργαστηρίου;', 1),
(32, 'Παρακολουθώ τακτικά τις διαλέξεις.', 1),
(33, 'Παρακολουθώ τακτικά τα εργαστήρια.', 1),
(34, 'Ανταποκρίνομαι συστηματικά στις γραπτές εργασίες/ασκήσεις.', 1),
(35, 'Μελετώ συστηματικά την ύλη.', 1),
(36, 'Αφιερώνω εβδομαδιαία για μελέτη του συγκεκριμένου μαθήματος:1= <2 Ώρες, 2=2-4 Ώρες, 3=4-6 Ώρες, 4=6-8 Ώρες, 5= >8 Ώρες ', 1),
(52, 'Παρατηρήσης και Σχόλια:', 0),
(59, 'hgjhgjhgjh', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Άδειασμα δεδομένων του πίνακα `result`
--

INSERT INTO `result` (`id`, `cid`, `pid`, `qid`, `ans1`, `ans2`, `ans3`, `ans4`, `ans5`) VALUES
(1, 2, 1, 16, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Δομή Πίνακα για τον Πίνακα `semester`
--

CREATE TABLE IF NOT EXISTS `semester` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sem_num` int(11) NOT NULL,
  `sem_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Άδειασμα δεδομένων του πίνακα `semester`
--

INSERT INTO `semester` (`id`, `sem_num`, `sem_name`) VALUES
(1, 1, 'Α'' Εξάμηνο'),
(2, 2, 'Β'' Εξάμηνο');

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
