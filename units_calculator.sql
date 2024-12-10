SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE IF NOT EXISTS `calculator_4T_06` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `calculator_4T_06`;

CREATE TABLE `length_units` (
  `length_id` int(11) NOT NULL,
  `full_name` varchar(20) NOT NULL,
  `abbreviation` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `length_units` (`length_id`, `full_name`, `abbreviation`) VALUES
(1, 'millimeters', 'mm'),
(2, 'centimeters', 'cm'),
(3, 'decimeters', 'dm'),
(4, 'meters', 'm'),
(5, 'decameters', 'dcm'),
(6, 'hectometers', 'hm'),
(7, 'kilometers', 'km'),
(8, 'inches', 'in');

CREATE TABLE `results` (
  `result_id` int(11) NOT NULL,
  `result_start_value` varchar(30) NOT NULL,
  `result_select_1` varchar(5) NOT NULL,
  `result_converted` varchar(30) NOT NULL,
  `result_select_2` varchar(5) NOT NULL,
  `result_first_name` varchar(60) NOT NULL,
  `result_email` varchar(255) NOT NULL,
  `result_terms` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `results` (`result_id`, `result_start_value`, `result_select_1`, `result_converted`, `result_select_2`, `result_first_name`, `result_email`, `result_terms`) VALUES
(1, '12', 'in', '30.48', 'cm', 'Test', 'email@example.com', 'on'),
(2, '30', 'cm', '12', 'in', 'Test', 'email@example.com', 'on'),
(3, '30', 'cm', '12', 'in', 'Test', 'email@example.com', 'on'),
(4, '20', 'mm', '2', 'cm', 'not submitted', 'not submitted', 'on'),
(5, '30', 'mm', '0.3', 'dm', 'not submitted', 'not submitted', 'on'),
(6, '30', 'mm', '0.3', 'dm', 'not submitted', 'not submitted', 'on'),
(7, '10', 'cm', '100', 'mm', 'not submitted', 'not submitted', 'on'),
(8, '10', 'cm', '100', 'mm', 'not submitted', 'not submitted', 'on'),
(9, '10', 'cm', '100', 'mm', 'not submitted', 'not submitted', 'on'),
(10, '10', 'cm', '100', 'mm', 'not submitted', 'not submitted', 'on'),
(11, '4', 'in', '101.6', 'mm', 'not submitted', 'not submitted', 'on'),
(12, '273.15', '°C', '546.3', 'K', 'not submitted', 'not submitted', 'on'),
(13, '10', '°C', '50', '°F', 'not submitted', 'not submitted', 'on'),
(14, '10', '°C', '50', '°F', 'not submitted', 'not submitted', 'on'),
(15, '58', 'kg', '127.89', 'lb', 'not submitted', 'not submitted', 'on'),
(16, '128', 'lb', '58.049886621315', 'kg', 'not submitted', 'not submitted', 'on'),
(17, '36.6', '°C', '97.88', '°F', 'not submitted', 'not submitted', 'on'),
(18, '36.6', '°C', '97.88', '°F', 'Test', 'email@example.com', 'on'),
(19, '36.6', '°C', '', '°F', 'Test', 'email', 'on'),
(20, '36.6', '°C', '97.88', '°F', 'Test', 'email@example.com', 'on'),
(21, '36', '°C', '96.8', '°F', 'not submitted', 'not submitted', 'on'),
(22, '36', '°C', '96.8', '°F', 'not submitted', 'not submitted', 'on'),
(23, '36', '°C', '96.8', '°F', 'not submitted', 'not submitted', 'on'),
(24, '97.88', '°F', '36.6', '°C', 'not submitted', 'not submitted', 'on'),
(25, '36.', '°C', '96.8', '°F', 'not submitted', 'not submitted', 'on'),
(26, '36.6', '°C', '97.88', '°F', 'not submitted', 'not submitted', 'on'),
(28, '36.5', '°C', '97.7', '°F', 'not submitted', 'not submitted', 'on'),
(29, '98', '°F', '36.666666666667', '°C', 'not submitted', 'not submitted', 'on'),
(30, '97.88', '°F', '36.6', '°C', 'not submitted', 'not submitted', 'on'),
(31, '273.15', 'K', '0', '°C', 'not submitted', 'not submitted', 'on'),
(32, '0', '°C', '273.15', 'K', 'not submitted', 'not submitted', 'on'),
(33, '104', '°F', '40', '°C', 'not submitted', 'not submitted', 'on'),
(34, '40', '°C', '104', '°F', 'not submitted', 'not submitted', 'on'),
(35, '42', '°C', '107.6', '°F', 'not submitted', 'not submitted', 'on'),
(36, '42', '°C', '107.6', '°F', 'not submitted', 'not submitted', 'on');

CREATE TABLE `temperature_units` (
  `length_id` int(11) NOT NULL,
  `full_name` varchar(20) NOT NULL,
  `abbreviation` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `temperature_units` (`length_id`, `full_name`, `abbreviation`) VALUES
(1, 'Celsius', '&deg;C'),
(2, 'Fahrenheit', '&deg;F'),
(3, 'Kelvin', 'K');

CREATE TABLE `types` (
  `type_unique_id` int(11) NOT NULL,
  `type_full_name` varchar(50) NOT NULL,
  `type_tile_description` varchar(255) NOT NULL,
  `type_site` varchar(50) NOT NULL,
  `type_icon` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `types` (`type_unique_id`, `type_full_name`, `type_tile_description`, `type_site`, `type_icon`) VALUES
(1, 'Length &amp; Distance', 'Know your measurements in metric or imperial/US units', 'length', 'fas fa-ruler'),
(2, 'Temperature', 'Find out the temperature in Celsius, Fahrenheit or Kelvin', 'temperature', 'fas fa-thermometer-three-quarters'),
(3, 'Weight', 'Convert between metric, imperial and US units', 'weight', 'fas fa-weight-hanging');

CREATE TABLE `weight_units` (
  `length_id` int(11) NOT NULL,
  `full_name` varchar(20) NOT NULL,
  `abbreviation` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `weight_units` (`length_id`, `full_name`, `abbreviation`) VALUES
(1, 'miligrams', 'mg'),
(2, 'grams', 'g'),
(3, 'decagrams', 'dag'),
(4, 'kilograms', 'kg'),
(5, 'metric tons', 't'),
(6, 'ounces', 'oz'),
(7, 'pounds', 'lb'),
(8, 'imperial tons', 'imp ton'),
(9, 'US tons', 'US ton');


ALTER TABLE `length_units`
  ADD PRIMARY KEY (`length_id`);

ALTER TABLE `results`
  ADD PRIMARY KEY (`result_id`);

ALTER TABLE `temperature_units`
  ADD PRIMARY KEY (`length_id`);

ALTER TABLE `types`
  ADD PRIMARY KEY (`type_unique_id`);

ALTER TABLE `weight_units`
  ADD PRIMARY KEY (`length_id`);


ALTER TABLE `length_units`
  MODIFY `length_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

ALTER TABLE `results`
  MODIFY `result_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

ALTER TABLE `temperature_units`
  MODIFY `length_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `types`
  MODIFY `type_unique_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `weight_units`
  MODIFY `length_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
