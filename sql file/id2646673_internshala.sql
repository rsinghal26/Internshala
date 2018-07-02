-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 29, 2018 at 04:19 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id2646673_internshala`
--

-- --------------------------------------------------------

--
-- Table structure for table `apply_interns`
--

CREATE TABLE `apply_interns` (
  `apply_id` int(11) NOT NULL,
  `intern_id` int(11) NOT NULL,
  `post_by` varchar(60) NOT NULL,
  `apply_by` varchar(60) NOT NULL,
  `question` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apply_interns`
--

INSERT INTO `apply_interns` (`apply_id`, `intern_id`, `post_by`, `apply_by`, `question`) VALUES
(1, 9, 'jamichael.deybi@0ld0ak.com', 'singhalraja.30003@gmail.com', 'Your company is working in the field of my interest. I wish to solve all the problems that your company faces in the field. Besides, your company is also known for the working environment and job satisfaction. I believe that I can contribute to taking this company at new heights of success.'),
(2, 10, 'jamichael.deybi@0ld0ak.com', 'singhalraja.30003@gmail.com', 'Sir, I always wanted to work in a reputed and prestigious company like yours. Which will provide me better opportunities of learning and I want to enhance my skills and knowledge to the next level by working with you and it will be helpful for my personal and professional growth. This company leads the market in this domain.'),
(3, 15, 'mekai.texas@0ld0ak.com', 'vizoy@99pubblicita.com', 'Since, I am a fresher I would like to mould me according to your company. And am a hard working person I would like to work in your company because it is well established and has a good reputation.'),
(4, 14, 'mekai.texas@0ld0ak.com', 'vizoy@99pubblicita.com', 'Mam/sir, honestly to say I\'m really very much interested in your company & the reason I get attracted to the company is that the company is a very reputed one. So, I think it is the best place wherein I can prove my skills and talent & even can gain more knowledge of whatever is necessary for the development of the company.'),
(5, 11, 'kastiel.vuk@0ld0ak.com', 'vizoy@99pubblicita.com', 'It is one of the topmost company and well-reputed company. Everyone wants to work for a well reputed company like yours and people feel proud about our company. One of my friends is working in your company they shared good feedback about the company.'),
(6, 12, 'kastiel.vuk@0ld0ak.com', 'ashwath.denzil@0ld0ak.com', 'Your company is reputed company and I would like to join your company not only to earn money I want to enhance my skills and knowledge so that we can grow personally and financially, I would like to start with my career to work with reputed company.'),
(7, 9, 'jamichael.deybi@0ld0ak.com', 'ashwath.denzil@0ld0ak.com', 'Yes, sir/mam. I would like to be a part of your company because I know that your company can give me a promising future and chance to have an international opportunity and from this, I will get chance to explore to your different branches too as your company give a great chance to work 1st-day work experience as well.'),
(8, 15, 'mekai.texas@0ld0ak.com', 'ashwath.denzil@0ld0ak.com', 'I really believe in the value of teamwork and so when I saw a position with your company to join your engineering department I had to make sure my application was put in. I believe strongly in working with other people towards a common goal and I know the skills I bring not only as an engineer, but as a team member will not only bring me work satisfaction, but will make me a valuable teammate as well.');

-- --------------------------------------------------------

--
-- Table structure for table `forget_pass`
--

CREATE TABLE `forget_pass` (
  `f_id` int(11) NOT NULL,
  `email` varchar(60) NOT NULL,
  `hash` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `intern`
--

CREATE TABLE `intern` (
  `id` int(11) NOT NULL,
  `company` text NOT NULL,
  `title` text NOT NULL,
  `about` text NOT NULL,
  `post_by` varchar(60) NOT NULL,
  `question` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `intern`
--

INSERT INTO `intern` (`id`, `company`, `title`, `about`, `post_by`, `question`) VALUES
(9, 'OYO', 'INTERNSHIP - Business Development and Sales', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in ', 'jamichael.deybi@0ld0ak.com', 'Why you want to join us?'),
(10, 'OYO', 'Software Developer ', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition', 'jamichael.deybi@0ld0ak.com', 'Why you want to join our team?'),
(11, 'Amazon', 'markiting', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"', 'kastiel.vuk@0ld0ak.com', 'Why you want to join our team and tell me about us?'),
(12, 'Amazon', 'Software Developer ', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur', 'kastiel.vuk@0ld0ak.com', 'Tell me your skills.'),
(14, 'Flipcart', 'web developer', 'But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure.', 'mekai.texas@0ld0ak.com', 'Tell me your strength and weakness.'),
(15, 'Flipcart', 'Android developer', 'But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure.', 'mekai.texas@0ld0ak.com', 'Why you want to join our team?');

-- --------------------------------------------------------

--
-- Table structure for table `unverified_user`
--

CREATE TABLE `unverified_user` (
  `id` int(11) NOT NULL,
  `f_name` text NOT NULL,
  `l_name` text NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` text NOT NULL,
  `type` text NOT NULL,
  `hash` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_detail`
--

CREATE TABLE `user_detail` (
  `id` int(11) NOT NULL,
  `f_name` text NOT NULL,
  `l_name` text NOT NULL,
  `email` varchar(60) DEFAULT NULL,
  `password` text NOT NULL,
  `type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_detail`
--

INSERT INTO `user_detail` (`id`, `f_name`, `l_name`, `email`, `password`, `type`) VALUES
(15, 'Raja', 'Singhal', 'singhalraja.30003@gmail.com', '269c378b555490f02ffbb5362a77370b', 'Student'),
(16, 'vizoy', 'singh', 'vizoy@99pubblicita.com', '9a81838eefd4a1d0215eb2f4937355e1', 'Student'),
(17, 'rajat', 'singhal', 'ashwath.denzil@0ld0ak.com', 'b4cb34f93838ee808a22b8216bcaccba', 'Student'),
(18, 'mukesh', 'jadon', 'mekai.texas@0ld0ak.com', '25d000315016396e75ddf885ccfd4f95', 'Employee'),
(19, 'rakesh', 'bansal', 'kastiel.vuk@0ld0ak.com', 'd447a5ca928d091afb618d9e1534322a', 'Employee'),
(20, 'kalpit', 'garg', 'jamichael.deybi@0ld0ak.com', 'd84c54938a8f0452e1450221efd3e727', 'Employee');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apply_interns`
--
ALTER TABLE `apply_interns`
  ADD PRIMARY KEY (`apply_id`),
  ADD KEY `apply_by` (`apply_by`),
  ADD KEY `post_by` (`post_by`),
  ADD KEY `intern_id` (`intern_id`);

--
-- Indexes for table `forget_pass`
--
ALTER TABLE `forget_pass`
  ADD PRIMARY KEY (`f_id`);

--
-- Indexes for table `intern`
--
ALTER TABLE `intern`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_by` (`post_by`);

--
-- Indexes for table `unverified_user`
--
ALTER TABLE `unverified_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_detail`
--
ALTER TABLE `user_detail`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apply_interns`
--
ALTER TABLE `apply_interns`
  MODIFY `apply_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `forget_pass`
--
ALTER TABLE `forget_pass`
  MODIFY `f_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `intern`
--
ALTER TABLE `intern`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `unverified_user`
--
ALTER TABLE `unverified_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_detail`
--
ALTER TABLE `user_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `apply_interns`
--
ALTER TABLE `apply_interns`
  ADD CONSTRAINT `apply_interns_ibfk_1` FOREIGN KEY (`apply_by`) REFERENCES `user_detail` (`email`),
  ADD CONSTRAINT `apply_interns_ibfk_2` FOREIGN KEY (`post_by`) REFERENCES `intern` (`post_by`),
  ADD CONSTRAINT `apply_interns_ibfk_3` FOREIGN KEY (`intern_id`) REFERENCES `intern` (`id`);

--
-- Constraints for table `intern`
--
ALTER TABLE `intern`
  ADD CONSTRAINT `intern_ibfk_1` FOREIGN KEY (`post_by`) REFERENCES `user_detail` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
