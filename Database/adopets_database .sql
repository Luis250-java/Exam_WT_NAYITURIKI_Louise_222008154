-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2024 at 07:18 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `adopets database`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `gender` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `username`, `first_name`, `last_name`, `password`, `email`, `gender`) VALUES
(1, 'vincent3', 'Vincent', 'KARANGWA', '$2y$10$FAcyU5bQ.XH/SKVFI4lTtOeD7PulxkPd0vSDsMrn2NcOuOtBUiecu', 'vincentkarangwa@gmail.com', 'Male'),
(2, 'jeannette34', 'Jeannette', 'INGABIRE', '$2y$10$qUjBKlj5Yi5museTYEzKweWHiLLrC1XcsfV17yf90.6fFl0jKjQvy', 'jeanneteingabire@gmail.com', 'Female'),
(3, 'felix45', 'Felix', 'KAMANZI', '$2y$10$bZePzDW6eqTkngc3ac8uPeaUMa8f/odW76wdEZ8yYEh5zT8KmPYYa', 'felixkamanzi@gmail.com', 'Male'),
(4, 'Innocent34', 'Innocent', 'RULANGWA', '$2y$10$l7vC./HQotlphboiEtYJr.aZ64STskmDVEu4hKPCeYPnucgctUAYi', 'rulangwainnocent@gmail.com', 'Male'),
(5, 'Alexis@250', 'Alexis', 'MURENZI', '$2y$10$9G9h3WUiJxBVb0vVRSWonOU0i6y6h16kXS5sPeh63EIt.fQIhXIKu', 'alexismurenzi@gmail.com', 'Male'),
(6, 'ange45', 'Angelique', 'UWINEZA', '$2y$10$P7VpUEsvNoJiIcr1ZSeZE.YlTofyV0t/L7WGXfx3VomqmFi8vE1/y', 'angeliqueuwineza@gmail.com', 'Female');

-- --------------------------------------------------------

--
-- Table structure for table `adoption_applications`
--

CREATE TABLE `adoption_applications` (
  `application_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `pet_name` varchar(100) NOT NULL,
  `reason_for_adoption` text NOT NULL,
  `submission_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adoption_applications`
--

INSERT INTO `adoption_applications` (`application_id`, `name`, `email`, `phone`, `address`, `pet_name`, `reason_for_adoption`, `submission_date`) VALUES
(1, 'Louise NAYITURIKI', 'nayiturikiluis4@gmail.com', '0788826227', 'Rubavu/Rwanda', 'Cat', 'I like to take care of cats', '2024-05-09 00:00:00'),
(2, 'ISHIMWE BERWA Denis', 'berwadenis@gmail.com', '0785607898', 'Kigali/Rwanda', 'Cat', 'I like to terat and take care of abandoned pets', '2024-05-09 00:00:00'),
(3, 'Marie UWIMANA', 'marieuwimana@gmail.com', '07978908', 'Nyanza/South', 'Dog', 'I have others I have adopted, so I want to take care of this one too.', '2024-05-09 00:00:00'),
(4, 'Dreake Chris SHEMA', 'shemachris@gmail.com', '0788696068', 'Rubavu/Rwanda', 'Dog', 'I have a project of raising dogs and supply them to the company which sell tehm', '2024-05-10 00:00:00'),
(5, 'Raissa IGIHOZO', 'raissaigihozo@gmail.com', '0788867970', 'Nyanza/South', 'Cat', 'I have a deep love and respect for animals and want to provide a good home for a pet in need', '2024-05-18 00:00:00'),
(6, 'Kevin Klain NGABO', 'kevinngabo@gmail.com', '079099876', 'Huye/South', 'Dog', 'I want to raise it', '0000-00-00 00:00:00'),
(7, 'Louise NAYITURIKI', 'nayiturikiluis4@gmail.com', '0788826227', 'Rubavu/West', 'Cat', 'Because of for their affectionate nature and can provide constant companionship.', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

CREATE TABLE `donations` (
  `donation_id` int(11) NOT NULL,
  `donor_name` varchar(255) NOT NULL,
  `donor_contacts` varchar(255) NOT NULL,
  `donation_type` enum('Monetary','In-kind','Sponsorship') NOT NULL,
  `donation_amount` decimal(10,2) DEFAULT NULL,
  `donation_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donations`
--

INSERT INTO `donations` (`donation_id`, `donor_name`, `donor_contacts`, `donation_type`, `donation_amount`, `donation_date`) VALUES
(1, 'Mark Kenny ', '0788890070', 'Sponsorship', 100000.00, '2024-05-07'),
(2, 'Karl max', '0788886767', 'Monetary', 500000.00, '2024-05-08'),
(3, 'RUGAMBA Francis', '0788789086', 'In-kind', 800000.00, '2024-05-09'),
(4, 'Jacky UWINEZA', '0786754364', 'Sponsorship', 7500000.00, '2024-05-21'),
(5, 'Dax Marie', '0789000985', 'In-kind', 2000000.00, '2024-05-21'),
(6, 'John Kelly ', '0789000985', 'Monetary', 5000000.00, '2024-05-21'),
(8, 'Meddy Saleh', '0796780945', 'Sponsorship', 1500000.00, '2024-05-21');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `event_date` date NOT NULL,
  `event_location` varchar(255) NOT NULL,
  `event_description` varchar(300) NOT NULL,
  `event_cost` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `event_name`, `event_date`, `event_location`, `event_description`, `event_cost`) VALUES
(1, 'Paws adoption event', '2024-05-09', 'Kigali Heights Park.', 'Event Title: Paws in the Park Adoption Event\r\n\r\nDate: Saturday, May 15th, 2024\r\n\r\nTime: 10:00 AM - 3:00 PM\r\n\r\nLocation:Kigali Heights Park , 123 Main Street, Kigali, Rwanda', 5000.00),
(2, 'Puppy Love\" Adoption Event', '2024-05-07', ' Nyarutarama Park', 'Event Name: Paws in the Park Adoption Event\r\n\r\nEvent Date: May 15 2024\r\n\r\nEvent Location: Nyarutarama Park, Kigali City\r\n\r\nEvent Description:Join us for a fun-filled day at Nyarutarama Park, where we\'ll be hosting our \"Paws in the Park\" Adoption Event! This family-friendly event is dedicated to find', 5000.00),
(3, 'Furry Friends Adoption Day', '2024-05-22', ' Nyarutarama Park', 'Event Name: Furry Friends Adoption Day\r\n\r\nDate: Saturday, June 15, 2024\r\n\r\nTime: 10:00 AM - 4:00 PM\r\n\r\nLocation: Central Park Community Center, 123 Park Avenue, Cityville\r\n\r\nEvent Description:\r\n\r\nJoin us for a fun-filled day at the Paws and Claws Adoption Fair! This family-friendly event is dedicate', 10000.00);

-- --------------------------------------------------------

--
-- Table structure for table `lost_and_found`
--

CREATE TABLE `lost_and_found` (
  `report_id` int(11) NOT NULL,
  `pet_description` text NOT NULL,
  `location` varchar(255) NOT NULL,
  `report_date` datetime NOT NULL,
  `contact_details` varchar(255) NOT NULL,
  `status` enum('Lost','Found') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lost_and_found`
--

INSERT INTO `lost_and_found` (`report_id`, `pet_description`, `location`, `report_date`, `contact_details`, `status`) VALUES
(1, 'Name: Whiskers\r\nBreed: Domestic Shorthair\r\nColor: Tabby (brown and black stripes)\r\nSize: Medium\r\nAge: Approximately 3 years old\r\nGender: Male', 'Gasabo/Kigali', '2024-05-08 10:40:00', '0788826227', 'Lost'),
(2, 'Name: Bella\r\nSpecies: Dog\r\nBreed: Labrador Retriever\r\nAge: 3 years\r\nGender: Female\r\nSize: Medium\r\nColor: Black\r\nDescription: Bella is a friendly and energetic Labrador Retriever who loves to play fetch and go for long walks. She is great with kids and other dogs, making her the perfect addition to an active family. Bella is spayed, up-to-date on vaccinations, and has been microchipped. She is looking for a forever home where she can get plenty of exercise and love.', 'Gasabo/Kigali', '2024-05-22 10:52:00', '0785607290', 'Found'),
(3, 'Name: Whiskers\r\nSpecies: Cat\r\nBreed: Domestic Shorthair\r\nAge: 2 years\r\nGender: Male\r\nSize: Small\r\nColor: Gray Tabby\r\nDescription: Whiskers is a sweet and affectionate gray tabby who loves to cuddle and purr. He enjoys lounging in sunny spots and playing with feather toys. Whiskers is neutered, vaccinated, and litter box trained. He would do well in a quiet home where he can be the center of attention and receive lots of love.', 'HUYE', '2024-05-22 10:54:00', '0788826227', 'Found');

-- --------------------------------------------------------

--
-- Table structure for table `medical_records`
--

CREATE TABLE `medical_records` (
  `record_id` int(11) NOT NULL,
  `pet_id` int(11) NOT NULL,
  `vaccination_records` text DEFAULT NULL,
  `spaying_neutering_status` enum('Spayed','Neutered','Not applicable') DEFAULT NULL,
  `medical_conditions` text DEFAULT NULL,
  `medications` text DEFAULT NULL,
  `veterinary_visits` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medical_records`
--

INSERT INTO `medical_records` (`record_id`, `pet_id`, `vaccination_records`, `spaying_neutering_status`, `medical_conditions`, `medications`, `veterinary_visits`) VALUES
(2, 1, 'Rabies: 05/15/2023\r\nCanine Distemper: 06/20/2023\r\nCanine Parvovirus: 06/20/2023\r\nBordetella (Kennel Cough): 07/10/2023', 'Neutered', 'Arthritis, Diabetes', 'Insulin, Carprofen', 'Routine Wellness Exam, Sick Visit'),
(3, 3, 'Rabies: 02/20/2023\r\nCanine Distemper: 03/25/2023\r\nCanine Parvovirus: 03/25/2023\r\nCanine Influenza: 04/30/2023', 'Spayed', 'Allergies, Heartworm disease', 'Furosemide, Prednisone', 'Spaying and Neutering Surgery'),
(4, 4, 'Vaccine:Rabies	\r\nDate:January 15, 2024	January 15, 2025	\r\nVaternary clinic:Happy Paws Veterinary Clinic', 'Spayed', 'Arthritis, Canine Parvovirus', 'Ivermectin (Heartgard), Milbemycin oxime (Interceptor), Selamectin (Revolution)', ' Vaccination Boosters and Follow-Up Visits\r\nTiming: Every 3-4 weeks until 16-18 weeks old\r\nPurpose: Complete the vaccination series and monitor growth');

-- --------------------------------------------------------

--
-- Table structure for table `pets`
--

CREATE TABLE `pets` (
  `pet_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `species` varchar(100) NOT NULL,
  `breed` varchar(100) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` enum('Male','Female','Other') DEFAULT NULL,
  `size` enum('Small','Medium','Large') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pets`
--

INSERT INTO `pets` (`pet_id`, `name`, `species`, `breed`, `age`, `gender`, `size`) VALUES
(1, 'Chloe', 'Cat', 'Persian', 1, '', 'Small'),
(2, 'Buddy', 'Dog', 'German Shephered', 2, 'Female', 'Medium'),
(3, 'Max', 'Dog', 'Bulldog', 3, 'Male', 'Medium'),
(4, 'Bella', 'Dog', 'Beagle', 2, 'Female', 'Small'),
(5, 'Luna', 'Cat', 'Siamese', 3, 'Female', 'Medium'),
(6, 'Misty', 'Cat', 'British Shorthair', 2, 'Female', 'Small');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `reviewer_name` varchar(255) NOT NULL,
  `reviewer_email` varchar(255) NOT NULL,
  `reviewed_item_id` int(11) NOT NULL,
  `reviewed_item_type` enum('Pet','Shelter') NOT NULL,
  `review_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `reviewer_name`, `reviewer_email`, `reviewed_item_id`, `reviewed_item_type`, `review_date`) VALUES
(2, 'Derrick RUGAMBA', 'derriickrugamba@gmail.html', 6, 'Shelter', '0000-00-00 00:00:00'),
(3, 'Liliane UWERA', 'lilianeuwera@gmail.com', 3, 'Pet', '2024-05-08 22:00:00'),
(5, 'Melan MANZI', 'melanmanzi@gmail.com', 8, 'Pet', '2024-05-08 22:00:00'),
(6, 'Anderson RWEMA', 'andersonrwema@gmail.com', 7, 'Shelter', '2024-05-17 22:00:00'),
(7, 'Alice INEZA', 'aliceineza@gmail.com', 3, 'Shelter', '2024-05-21 22:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `shelters`
--

CREATE TABLE `shelters` (
  `shelter_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact_info` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shelters`
--

INSERT INTO `shelters` (`shelter_id`, `name`, `address`, `contact_info`) VALUES
(1, 'Paws & Claws Animal Shelter', 'Nyarugenge District, Kigali City, Rwanda', 'phone: 0788845789, Email: info@pawsandclawsrwanda.com'),
(2, 'Happy Tails Pet Rescue', 'Gasabo District, Kigali City, Rwanda', 'phone: 0788886089, Email: contact@happytailsshelter.rw'),
(3, 'Second Chance Animal Shelter', 'Nyarugenge District, Kigali City, Rwanda', '0'),
(4, 'Furry Friends Adoption Center', 'Nyarugenge Districts, Kigali City, Rwanda', '0');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `role`) VALUES
(1, 'lulu', 'nayiturikiluis4@gmail.com', '$2y$10$MmlOv18/UyoBIja/Zmhls.LFty7Iv4fE.AjKJIH5olszHSzzunUbC', 'pet_seeker'),
(2, 'paccy', 'ingabirepaccy@gmail.com', '$2y$10$RoZzlprJGShuZhEBTtYIyukkkce26ciioiQpYI37uxsmI2nRe9FOu', 'pet_owner'),
(3, 'fally34', 'fallydan@gmail.com', '$2y$10$Bae1ar50UCds3gBRoA57uuDLFw4lN8S/5DnFOjXkkcjpFqyAXCL9S', 'shelter_staff'),
(4, 'alain3', 'alainishimwe@gmail.com', '$2y$10$6bBMvkDn4hLXoy4b3lXvOepiOnlldcW1kY2YTkIoUYcrq4N6RcRc.', 'administrator'),
(5, 'joxy23', 'joxyanny@gmail.com', '$2y$10$ht1DsGojGRlFKHgCOS/kjO75DGk3cqOYvVebli8cjFeob6MhtsQmC', 'administrator'),
(6, 'sabin2', 'sabinmazimpaka@gmail.com', '$2y$10$anppAJAbTqZ/rS7Z331DBulxa4VQAKqfnYo3BXlXMKkv/7LWiXYFe', 'administrator'),
(7, 'noella3', 'noellaishimwe@gmail.com', '$2y$10$03e34mLzN6QG.UG3lrhgvOvejbVig5UMLn0SOw3kfbLYAHKERDftu', 'volunteer'),
(8, 'danny3', 'dannymukiza@gmail', '$2y$10$CIaraILtpskDE1jAAJ.XT.KNhjCnVUxhjBFVWC/OL2WD5NfkvUqjC', 'volunteer'),
(9, 'amie3', 'amieenadege@gmail.com', '$2y$10$/2UZZZntIBfh6dAFQ2JVWOQMoE9Qocg6qKivFbqmi17oPc20SFr6W', 'pet_owner');

-- --------------------------------------------------------

--
-- Table structure for table `volunteers`
--

CREATE TABLE `volunteers` (
  `volunteer_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `phone_number` int(11) DEFAULT NULL,
  `interests` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `volunteers`
--

INSERT INTO `volunteers` (`volunteer_id`, `first_name`, `last_name`, `phone_number`, `interests`) VALUES
(1, 'Annet3', 'UMWIZA', 788674567, 'Animal Rescue and Rehabilitation, Animal Health and Wellness'),
(2, 'Agnes', 'KAMALIZA', 796789068, 'Event Planning: Organizing adoption events, fundraisers, or educational workshops for pet owners.'),
(3, 'Andre', 'KAMANZI', 788856789, 'Photography and Videography: Capturing high-quality images and videos of animals to help promote them for adoption.'),
(4, 'Davids', 'KARENZI', 796789068, 'Dog Walking, Cat Socialization, Photography'),
(5, 'Giselle', 'RUGIRA', 795678438, 'Animal Rescue and Rehabilitation');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `adoption_applications`
--
ALTER TABLE `adoption_applications`
  ADD PRIMARY KEY (`application_id`);

--
-- Indexes for table `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`donation_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `lost_and_found`
--
ALTER TABLE `lost_and_found`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `medical_records`
--
ALTER TABLE `medical_records`
  ADD PRIMARY KEY (`record_id`),
  ADD KEY `pet_id` (`pet_id`);

--
-- Indexes for table `pets`
--
ALTER TABLE `pets`
  ADD PRIMARY KEY (`pet_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `shelters`
--
ALTER TABLE `shelters`
  ADD PRIMARY KEY (`shelter_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `volunteers`
--
ALTER TABLE `volunteers`
  ADD PRIMARY KEY (`volunteer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `adoption_applications`
--
ALTER TABLE `adoption_applications`
  MODIFY `application_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `donation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lost_and_found`
--
ALTER TABLE `lost_and_found`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `medical_records`
--
ALTER TABLE `medical_records`
  MODIFY `record_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pets`
--
ALTER TABLE `pets`
  MODIFY `pet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `shelters`
--
ALTER TABLE `shelters`
  MODIFY `shelter_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `volunteers`
--
ALTER TABLE `volunteers`
  MODIFY `volunteer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `medical_records`
--
ALTER TABLE `medical_records`
  ADD CONSTRAINT `medical_records_ibfk_1` FOREIGN KEY (`pet_id`) REFERENCES `pets` (`pet_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
