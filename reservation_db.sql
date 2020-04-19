SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";
-- Database: `reservation_db`
--
-- --------------------------------------------------------
--
-- Table structure for table `workstations`
--
CREATE TABLE `workstations` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
--
-- Dumping data for table `workstations`
--
INSERT INTO `workstations` (`id`, `name`, `description`, `created`) VALUES
(1, 'Stacja robocza numer 1', 'Podstawowa stacja robocza koło okna', '2020-04-17 13:37:00'),
(2, 'Stacja robocza numer 2', 'Podstawowa stacja robocza koło drzwi', '2020-04-17 13:37:00');

-- --------------------------------------------------------
--
-- Table structure for table `persons`
--
CREATE TABLE `persons` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
--
-- Dumping data for table `persons`
--
INSERT INTO `persons` (`id`, `name`, `surname`, `created`) VALUES
(1, 'Tyler', 'Durden', '2020-04-17 13:37:00'),
(2, 'Jan', 'Kowalski', '2020-04-17 13:37:00'),
(3, 'Frieda', 'Khalo', '2020-04-17 13:37:00');

-- --------------------------------------------------------
--
-- Table structure for table `equipment`
--
CREATE TABLE `equipment` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `year_of_purchase` int(11) NOT NULL,
  `value` int(11) NOT NULL,
  `workstation_id` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
--
-- Dumping data for table `equipment`
--
INSERT INTO `equipment` (`id`, `type`, `model`, `name`, `year_of_purchase`, `value`, `workstation_id`, `created`) VALUES
(1, 'komputer', 'Lenovo Ideapad 520', 'Goku', 2017, 2400, 1, '2020-04-17 13:37:00'),
(2, 'komputer', 'Lenovo Thinkpad', 'Bulma', 2016, 2100, 2, '2020-04-17 13:37:00'),
(3, 'drukarka', 'HP Inkjet', 'Dariusz', 2018, 1500, 1, '2020-04-17 13:37:00');
-- --------------------------------------------------------
--
-- Table structure for table `reservations`
--
CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL,
  `workstation_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time_start` time NOT NULL,
  `time_end` time NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
--
-- Dumping data for table `reservations`
--


-- Indexes for dumped tables
--
--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);
-- Indexes for table `workstations`
--
ALTER TABLE `workstations`
  ADD PRIMARY KEY (`id`);
--
-- Indexes for table `doctors`
--
ALTER TABLE `persons`
  ADD PRIMARY KEY (`id`);
--
-- Indexes for table `nurses`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`id`);
--
-- AUTO_INCREMENT for dumped tables
--
--
-- AUTO_INCREMENT for table `workstations`
--
ALTER TABLE `workstations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `persons`
--
ALTER TABLE `persons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
-- AUTO_INCREMENT for table `equipment`
--
ALTER TABLE `equipment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--
--
-- Constraints for table `equipment`
--
ALTER TABLE `equipment`
  ADD CONSTRAINT `equipment_ibfk_1` FOREIGN KEY (`workstation_id`) REFERENCES `workstations` (`id`);
COMMIT;
--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`workstation_id`) REFERENCES `workstations` (`id`),
  ADD CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`person_id`) REFERENCES `persons` (`id`);
COMMIT;