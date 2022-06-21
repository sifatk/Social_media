-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2020 at 03:01 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `social_media`
--

-- --------------------------------------------------------

--
-- Table structure for table `cloud`
--

CREATE TABLE `cloud` (
  `User_ID` int(11) NOT NULL,
  `File_Timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `File_Name` varchar(70) DEFAULT NULL,
  `File_Path` varchar(200) DEFAULT NULL,
  `File_Size_MB` int(11) DEFAULT NULL,
  `File_Type` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cloud`
--

INSERT INTO `cloud` (`User_ID`, `File_Timestamp`, `File_Name`, `File_Path`, `File_Size_MB`, `File_Type`) VALUES
(1, '2015-12-31 12:00:01', 'A PICTURE', 'IMAGES', 5, 'PDF'),
(4, '0000-00-00 00:00:00', 'profile_picture_jamiul.bari98@gmail.com', 'cloud', 0, 'com');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `Country_ID` int(11) NOT NULL,
  `ISO` char(2) DEFAULT NULL,
  `Country_Name` varchar(80) DEFAULT NULL,
  `Phone_Code` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`Country_ID`, `ISO`, `Country_Name`, `Phone_Code`) VALUES
(1, 'AF', 'Afghanistan', 93),
(2, 'BD', 'Bangladesh', 880),
(3, 'BE', 'Belgium', 32);

-- --------------------------------------------------------

--
-- Table structure for table `friend_requests`
--

CREATE TABLE `friend_requests` (
  `From_User_ID` int(11) NOT NULL,
  `To_User_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `friend_requests`
--

INSERT INTO `friend_requests` (`From_User_ID`, `To_User_ID`) VALUES
(1, 3),
(1, 4),
(4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `User_ID` int(11) NOT NULL,
  `Notification_Timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Notification_Text` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`User_ID`, `Notification_Timestamp`, `Notification_Text`) VALUES
(1, '2015-12-31 12:00:01', 'You have an unseen message'),
(2, '2016-12-31 12:00:01', 'You have a new friend request'),
(3, '2017-12-31 12:00:01', 'You have an unseen message'),
(4, '2020-09-28 19:23:06', 'You have a new friend request'),
(4, '2020-09-28 23:36:49', 'NN'),
(4, '2020-09-28 23:37:04', 'New Notification');

-- --------------------------------------------------------

--
-- Table structure for table `user_friendship_graph`
--

CREATE TABLE `user_friendship_graph` (
  `User_ID_1` int(11) NOT NULL,
  `User_ID_2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_friendship_graph`
--

INSERT INTO `user_friendship_graph` (`User_ID_1`, `User_ID_2`) VALUES
(1, 2),
(2, 3),
(4, 2),
(4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `user_information`
--

CREATE TABLE `user_information` (
  `User_ID` int(11) NOT NULL,
  `First_Name` varchar(30) NOT NULL,
  `Last_Name` varchar(30) NOT NULL,
  `Mobile` varchar(15) DEFAULT NULL,
  `Email` varchar(40) NOT NULL,
  `Password` varchar(30) NOT NULL,
  `Date_of_Birth` date DEFAULT NULL,
  `Gender` varchar(10) DEFAULT NULL,
  `Country_ID` int(11) DEFAULT NULL,
  `profile_picture_status` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_information`
--

INSERT INTO `user_information` (`User_ID`, `First_Name`, `Last_Name`, `Mobile`, `Email`, `Password`, `Date_of_Birth`, `Gender`, `Country_ID`, `profile_picture_status`) VALUES
(1, 'Araf', 'Hossain', '01619004005', 'araf.hossain@gmail.com', '123123', '1998-09-29', 'Male', 2, 0),
(2, 'Simon', 'Ahmed', '01819004000', 'simon.ahmed@gmail.com', '123123', '1998-09-29', 'Male', 2, 0),
(3, 'Ahmedul', 'Kabir', '01711004444', 'ahmedul.kabir@gmail.com', '123123', '1998-09-29', 'Male', 2, 0),
(4, 'Jamiul', 'Bari', '01618004405', 'jamiul.bari98@gmail.com', '123123', '1998-09-29', 'Male', 2, 1),
(7, 'Female', 'User', '01618004404', 'fem.user@gmail.com', '123123', '2020-11-02', 'Female', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_posts`
--

CREATE TABLE `user_posts` (
  `User_ID` int(11) NOT NULL,
  `Post_Timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Text` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_posts`
--

INSERT INTO `user_posts` (`User_ID`, `Post_Timestamp`, `Text`) VALUES
(1, '2020-09-28 05:45:49', 'Happy New Year to all my Friends!!!'),
(1, '2020-09-28 05:59:58', 'Feeling Great'),
(4, '2020-09-28 09:16:30', 'Jamiul Bari\'s 1st Status'),
(4, '2020-09-29 06:06:23', 'STATUS 3'),
(4, '2020-09-29 06:36:33', 'My Post 4'),
(4, '2020-09-29 06:38:02', 'Status 7'),
(4, '2020-09-29 14:48:03', 'statrtq'),
(4, '2020-10-10 19:52:05', 'right now'),
(4, '2020-10-10 19:53:49', 'right now 2'),
(4, '2020-10-31 09:17:51', 'October 31 Post');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cloud`
--
ALTER TABLE `cloud`
  ADD PRIMARY KEY (`User_ID`,`File_Timestamp`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`Country_ID`);

--
-- Indexes for table `friend_requests`
--
ALTER TABLE `friend_requests`
  ADD PRIMARY KEY (`From_User_ID`,`To_User_ID`),
  ADD KEY `Friend_Requests_To_User_ID__FK` (`To_User_ID`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`User_ID`,`Notification_Timestamp`);

--
-- Indexes for table `user_friendship_graph`
--
ALTER TABLE `user_friendship_graph`
  ADD PRIMARY KEY (`User_ID_1`,`User_ID_2`),
  ADD KEY `User_Friendship_Graph_User_ID_2__FK` (`User_ID_2`);

--
-- Indexes for table `user_information`
--
ALTER TABLE `user_information`
  ADD PRIMARY KEY (`User_ID`),
  ADD KEY `User_Information_Country_ID__FK` (`Country_ID`);

--
-- Indexes for table `user_posts`
--
ALTER TABLE `user_posts`
  ADD PRIMARY KEY (`User_ID`,`Post_Timestamp`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_information`
--
ALTER TABLE `user_information`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cloud`
--
ALTER TABLE `cloud`
  ADD CONSTRAINT `Cloud_User_ID__FK` FOREIGN KEY (`User_ID`) REFERENCES `user_information` (`User_ID`);

--
-- Constraints for table `friend_requests`
--
ALTER TABLE `friend_requests`
  ADD CONSTRAINT `Friend_Requests_From_User_ID__FK` FOREIGN KEY (`From_User_ID`) REFERENCES `user_information` (`User_ID`),
  ADD CONSTRAINT `Friend_Requests_To_User_ID__FK` FOREIGN KEY (`To_User_ID`) REFERENCES `user_information` (`User_ID`);

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `Notification_User_ID__FK` FOREIGN KEY (`User_ID`) REFERENCES `user_information` (`User_ID`);

--
-- Constraints for table `user_friendship_graph`
--
ALTER TABLE `user_friendship_graph`
  ADD CONSTRAINT `User_Friendship_Graph_User_ID_1__FK` FOREIGN KEY (`User_ID_1`) REFERENCES `user_information` (`User_ID`),
  ADD CONSTRAINT `User_Friendship_Graph_User_ID_2__FK` FOREIGN KEY (`User_ID_2`) REFERENCES `user_information` (`User_ID`);

--
-- Constraints for table `user_information`
--
ALTER TABLE `user_information`
  ADD CONSTRAINT `User_Information_Country_ID__FK` FOREIGN KEY (`Country_ID`) REFERENCES `country` (`Country_ID`);

--
-- Constraints for table `user_posts`
--
ALTER TABLE `user_posts`
  ADD CONSTRAINT `User_Posts_User_ID__FK` FOREIGN KEY (`User_ID`) REFERENCES `user_information` (`User_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
