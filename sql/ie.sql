-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Φιλοξενητής: localhost
-- Χρόνος δημιουργίας: 15 Απρ 2012 στις 16:05:50
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
-- Δομή Πίνακα για τον Πίνακα `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `semester` int(11) NOT NULL,
  PRIMARY KEY (`id`)
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
  PRIMARY KEY (`id`)
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Άδειασμα δεδομένων του πίνακα `professor`
--

INSERT INTO `professor` (`id`, `name`, `surname`) VALUES
(1, 'Μιχάλης', 'Παρασκευάς'),
(2, 'Παναγιώτης', 'Αλεφραγκής'),
(3, 'Γεώργιος', 'Ασημακόπουλος');

-- --------------------------------------------------------

--
-- Δομή Πίνακα για τον Πίνακα `question`
--

CREATE TABLE IF NOT EXISTS `question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `multiple_choice` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=38 ;

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
(37, 'Παρατηρήσεις και σχόλια:', 0);

-- --------------------------------------------------------

--
-- Δομή Πίνακα για τον Πίνακα `questionset`
--

CREATE TABLE IF NOT EXISTS `questionset` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Άδειασμα δεδομένων του πίνακα `questionset`
--

INSERT INTO `questionset` (`id`, `name`, `date`) VALUES
(1, 'default', '2012-02-05 17:43:07');

-- --------------------------------------------------------

--
-- Δομή Πίνακα για τον Πίνακα `question_questionset`
--

CREATE TABLE IF NOT EXISTS `question_questionset` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `qid` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

--
-- Άδειασμα δεδομένων του πίνακα `question_questionset`
--

INSERT INTO `question_questionset` (`id`, `qid`, `sid`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 1),
(6, 6, 1),
(7, 7, 1),
(8, 8, 1),
(9, 9, 1),
(10, 10, 1),
(11, 11, 1),
(12, 12, 1),
(13, 13, 1),
(14, 14, 1),
(15, 15, 1),
(16, 16, 1),
(17, 17, 1),
(18, 18, 1),
(19, 19, 1),
(20, 20, 1),
(21, 21, 1),
(22, 22, 1),
(23, 23, 1),
(24, 24, 1),
(25, 25, 1),
(26, 26, 1),
(27, 27, 1),
(28, 28, 1),
(29, 29, 1),
(30, 30, 1),
(31, 31, 1),
(32, 32, 1),
(33, 33, 1),
(34, 34, 1),
(35, 35, 1),
(36, 36, 1);

-- --------------------------------------------------------

--
-- Δομή Πίνακα για τον Πίνακα `result`
--

CREATE TABLE IF NOT EXISTS `result` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL,
  `qid` int(11) NOT NULL,
  `ans1` int(11) DEFAULT NULL,
  `ans2` int(11) DEFAULT NULL,
  `ans3` int(11) DEFAULT NULL,
  `ans4` int(11) DEFAULT NULL,
  `ans5` int(11) DEFAULT NULL,
  `textans` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
