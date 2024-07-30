-- MySQL dump 10.13  Distrib 8.3.0, for macos14.2 (arm64)
--
-- Host: localhost    Database: donkeycar
-- ------------------------------------------------------
-- Server version	8.3.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Category`
--

DROP TABLE IF EXISTS `Category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Category` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Category`
--

LOCK TABLES `Category` WRITE;
/*!40000 ALTER TABLE `Category` DISABLE KEYS */;
INSERT INTO `Category` VALUES (1,'electrique'),(2,'thermique'),(3,'hybrid'),(4,'SUV'),(5,'citadine'),(6,'berline'),(7,'sportive'),(8,'4X4');
/*!40000 ALTER TABLE `Category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Users`
--

DROP TABLE IF EXISTS `Users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Users` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Users`
--

LOCK TABLES `Users` WRITE;
/*!40000 ALTER TABLE `Users` DISABLE KEYS */;
/*!40000 ALTER TABLE `Users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Voiture`
--

DROP TABLE IF EXISTS `Voiture`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Voiture` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `model` varchar(255) DEFAULT NULL,
  `description` text,
  `Prix` decimal(10,2) DEFAULT NULL,
  `Disponible` tinyint(1) DEFAULT NULL,
  `details` text,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Voiture`
--

LOCK TABLES `Voiture` WRITE;
/*!40000 ALTER TABLE `Voiture` DISABLE KEYS */;
INSERT INTO `Voiture` VALUES (1,'Tesla Model S','Electric luxury sedan',199.99,1,'Battery: 100 kWh, Range: 396 miles, Top Speed: 200 mph, 0-60 mph: 2.3 seconds, Drivetrain: AWD, Seats: 5, Charging Time: 10 hours (240V)','/image/tesla_modelS.webp'),(2,'Toyota Prius','Hybrid compact car',59.99,1,'Engine: 1.8L 4-cylinder Hybrid, Fuel Economy: 58 mpg city / 53 mpg highway, Top Speed: 112 mph, Transmission: CVT, Drivetrain: FWD, Seats: 5, Cargo Capacity: 27.4 cubic feet','/image/toyota_prius.webp'),(3,'Ford F-150','Thermal full-size pickup truck',99.99,1,'Engine: 3.5L V6, Horsepower: 400 hp, Towing Capacity: 13,200 lbs, Top Speed: 107 mph, Drivetrain: RWD/4WD, Transmission: 10-speed automatic, Seats: 6, Bed Length: 6.5 feet','/image/ford_F150.webp'),(4,'BMW X5','Luxury SUV',149.99,1,'Engine: 3.0L I6, Horsepower: 335 hp, Fuel Economy: 21 mpg city / 26 mpg highway, Top Speed: 155 mph, Drivetrain: AWD, Transmission: 8-speed automatic, Seats: 5, Cargo Capacity: 72.3 cubic feet','/image/bmw_X5.webp'),(5,'Honda Civic','Compact car',39.99,1,'Engine: 2.0L I4, Horsepower: 158 hp, Fuel Economy: 30 mpg city / 38 mpg highway, Top Speed: 130 mph, Drivetrain: FWD, Transmission: CVT, Seats: 5, Cargo Capacity: 15.1 cubic feet','/image/honda_civic.webp'),(6,'Audi A4','Luxury sedan',109.99,1,'Engine: 2.0L I4, Horsepower: 188 hp, Fuel Economy: 24 mpg city / 31 mpg highway, Top Speed: 130 mph, Drivetrain: AWD, Transmission: 7-speed automatic, Seats: 5, Cargo Capacity: 12 cubic feet','/image/audi_a4.webp'),(7,'Chevrolet Bolt','Electric compact car',69.99,1,'Battery: 66 kWh, Range: 259 miles, Top Speed: 93 mph, 0-60 mph: 6.5 seconds, Drivetrain: FWD, Seats: 5, Charging Time: 10 hours (240V)','/image/chevrolet_bolt.webp'),(8,'Jeep Wrangler','4x4 off-road vehicle',89.99,1,'Engine: 3.6L V6, Horsepower: 285 hp, Fuel Economy: 17 mpg city / 25 mpg highway, Top Speed: 112 mph, Drivetrain: 4WD, Transmission: 8-speed automatic, Seats: 5, Cargo Capacity: 31.7 cubic feet','/image/jeep_wrangler.webp'),(9,'Porsche 911','Luxury sports car',299.99,1,'Engine: 3.0L Twin-turbocharged Flat-6, Horsepower: 443 hp, Fuel Economy: 18 mpg city / 24 mpg highway, Top Speed: 191 mph, 0-60 mph: 3.5 seconds, Drivetrain: RWD/AWD, Transmission: 8-speed automatic, Seats: 4','/image/porsche_911.webp'),(10,'Mercedes-Benz E-Class','Luxury mid-size sedan',129.99,1,'Engine: 2.0L I4, Horsepower: 255 hp, Fuel Economy: 22 mpg city / 30 mpg highway, Top Speed: 130 mph, Drivetrain: RWD/AWD, Transmission: 9-speed automatic, Seats: 5, Cargo Capacity: 13.1 cubic feet','/image/mercedes_benz_classe_E.webp'),(11,'Nissan Leaf','Electric compact car',55.99,1,'Battery: 40 kWh, Range: 149 miles, Top Speed: 93 mph, 0-60 mph: 7.4 seconds, Drivetrain: FWD, Charging Time: 8 hours (240V), Seats: 5, Features: Automatic emergency braking, Lane departure warning','/image/nissan_leaf.webp'),(12,'Hyundai Kona Electric','Electric SUV',75.99,1,'Battery: 64 kWh, Range: 258 miles, Top Speed: 104 mph, 0-60 mph: 6.4 seconds, Drivetrain: FWD, Charging Time: 9.5 hours (240V), Seats: 5, Features: Infotainment system with navigation, Adaptive cruise control','/image/hyundai_kona.webp'),(13,'Kia Niro','Hybrid crossover',64.99,1,'Engine: 1.6L 4-cylinder Hybrid, Horsepower: 139 hp, Fuel Economy: 51 mpg city / 46 mpg highway, Top Speed: 104 mph, Drivetrain: FWD, Transmission: 6-speed automatic, Seats: 5, Features: Apple CarPlay, Android Auto','/image/kia_niro.webp'),(14,'Ford Mustang','Thermal sports car',120.99,1,'Engine: 5.0L V8, Horsepower: 450 hp, Fuel Economy: 15 mpg city / 24 mpg highway, Top Speed: 155 mph, 0-60 mph: 4.2 seconds, Drivetrain: RWD, Transmission: 6-speed manual, Seats: 4, Features: Brembo brakes, Sport exhaust system','/image/ford_mustang.webp'),(15,'Chevrolet Tahoe','Full-size SUV',140.99,1,'Engine: 5.3L V8, Horsepower: 355 hp, Fuel Economy: 16 mpg city / 20 mpg highway, Top Speed: 120 mph, Drivetrain: RWD/4WD, Transmission: 10-speed automatic, Seats: 8, Features: Trailer assist, Off-road capabilities','/image/chevrolet_tahoe.webp'),(16,'Mazda CX-5','Compact SUV',80.99,1,'Engine: 2.5L I4, Horsepower: 187 hp, Fuel Economy: 25 mpg city / 31 mpg highway, Top Speed: 125 mph, Drivetrain: AWD, Transmission: 6-speed automatic, Seats: 5, Features: Adaptive headlights, Blind-spot monitoring','/image/mazda_CX5.webp'),(17,'Subaru Outback','Mid-size SUV',90.99,1,'Engine: 2.5L I4, Horsepower: 182 hp, Fuel Economy: 26 mpg city / 33 mpg highway, Top Speed: 130 mph, Drivetrain: AWD, Transmission: CVT, Seats: 5, Features: X-Mode off-road setting, EyeSight driver assist technology','/image/subaru_outback.webp'),(18,'Volkswagen Golf','Compact car',50.99,1,'Engine: 1.4L I4, Horsepower: 147 hp, Fuel Economy: 29 mpg city / 39 mpg highway, Top Speed: 118 mph, Drivetrain: FWD, Transmission: 8-speed automatic, Seats: 5, Features: Active safety features, Compact agility','/image/volkswagen_golf.webp'),(19,'Toyota Camry','Mid-size sedan',65.99,1,'Engine: 2.5L I4, Horsepower: 203 hp, Fuel Economy: 28 mpg city / 39 mpg highway, Top Speed: 135 mph, Drivetrain: FWD, Transmission: 8-speed automatic, Seats: 5, Features: Toyota Safety Sense, Energy-efficient performance','/image/toyota_camry.webp'),(20,'Lexus RX','Luxury SUV',150.99,1,'Engine: 3.5L V6, Horsepower: 295 hp, Fuel Economy: 19 mpg city / 26 mpg highway, Top Speed: 124 mph, Drivetrain: AWD, Transmission: 8-speed automatic, Seats: 5, Features: Lexus Safety System+, Luxury interior','/image/lexus_RX.webp'),(21,'Range Rover Evoque','Luxury compact SUV',160.99,1,'Engine: 2.0L I4 Turbo, Horsepower: 246 hp, Fuel Economy: 21 mpg city / 26 mpg highway, Top Speed: 143 mph, Drivetrain: AWD, Transmission: 9-speed automatic, Seats: 5, Features: Terrain Response system, Elegant styling','/image/range_rover_evoque.webp'),(22,'Hyundai Elantra','Compact sedan',45.99,1,'Engine: 2.0L I4, Horsepower: 147 hp, Fuel Economy: 33 mpg city / 41 mpg highway, Top Speed: 120 mph, Drivetrain: FWD, Transmission: CVT, Seats: 5, Features: Hyundai SmartSense, Affordable reliability','/image/hyundai_elantra.webp'),(23,'Honda Accord','Mid-size sedan',70.99,1,'Engine: 1.5L I4, Horsepower: 192 hp, Fuel Economy: 30 mpg city / 38 mpg highway, Top Speed: 125 mph, Drivetrain: FWD, Transmission: CVT, Seats: 5, Features: Honda Sensing Suite, Spacious cabin','/image/honda_accord.webp'),(24,'Chevrolet Camaro','Sports car',130.99,1,'Engine: 6.2L V8, Horsepower: 455 hp, Fuel Economy: 16 mpg city / 24 mpg highway, Top Speed: 165 mph, 0-60 mph: 4.0 seconds, Drivetrain: RWD, Transmission: 6-speed manual, Seats: 4, Features: Performance-oriented design, High-impact aerodynamics','/image/chevrolet_camaro.webp'),(25,'Ford Explorer','Mid-size SUV',100.99,1,'Engine: 2.3L I4, Horsepower: 300 hp, Fuel Economy: 20 mpg city / 27 mpg highway, Top Speed: 120 mph, Drivetrain: AWD, Transmission: 10-speed automatic, Seats: 7, Features: Ford Co-Pilot360, Spacious third-row seating','/image/ford_explorer.webp'),(26,'BMW 3 Series','Luxury sedan',115.99,1,'Engine: 2.0L I4 Turbo, Horsepower: 255 hp, Fuel Economy: 25 mpg city / 34 mpg highway, Top Speed: 130 mph, Drivetrain: RWD, Transmission: 8-speed automatic, Seats: 5, Features: BMW ConnectedDrive, Advanced vehicle dynamics','/image/bmw_serie3.webp'),(27,'Audi Q7','Luxury SUV',175.99,1,'Engine: 3.0L V6 Turbo, Horsepower: 335 hp, Fuel Economy: 19 mpg city / 24 mpg highway, Top Speed: 155 mph, Drivetrain: AWD, Transmission: 8-speed automatic, Seats: 7, Features: Quattro all-wheel drive, Luxury amenities','/image/audi_Q7.webp'),(28,'Tesla Model 3','Electric sedan',110.99,1,'Battery: 75 kWh, Range: 310 miles, Top Speed: 140 mph, 0-60 mph: 3.2 seconds, Drivetrain: RWD, Charging Time: 8 hours (240V), Seats: 5, Features: Autopilot capabilities, Minimalist interior design','/image/tesla_model3.webp'),(29,'Nissan Rogue','Compact SUV',85.99,1,'Engine: 2.5L I4, Horsepower: 170 hp, Fuel Economy: 25 mpg city / 32 mpg highway, Top Speed: 115 mph, Drivetrain: AWD, Transmission: CVT, Seats: 5, Features: Nissan Safety Shield 360, Versatile cargo space','/image/nissan_rogue.webp'),(30,'Toyota RAV4','Compact SUV',75.99,1,'Engine: 2.5L I4, Horsepower: 203 hp, Fuel Economy: 26 mpg city / 35 mpg highway, Top Speed: 120 mph, Drivetrain: AWD, Transmission: 8-speed automatic, Seats: 5, Features: RAV4 Adventure trim, Off-road capabilities','/image/toyota_rav4.webp'),(31,'Jeep Grand Cherokee','Mid-size SUV',95.99,1,'Engine: 3.6L V6, Horsepower: 295 hp, Fuel Economy: 19 mpg city / 26 mpg highway, Top Speed: 110 mph, Drivetrain: AWD, Transmission: 8-speed automatic, Seats: 5, Features: Grand Cherokee Laredo, Advanced 4x4 systems','/image/jeep_cherokee.webp'),(32,'Kia Sportage','Compact SUV',70.99,1,'Engine: 2.4L I4, Horsepower: 181 hp, Fuel Economy: 23 mpg city / 30 mpg highway, Top Speed: 113 mph, Drivetrain: AWD, Transmission: 6-speed automatic, Seats: 5, Features: Kia Drive Wise technologies, Sporty design','/image/kia_sportage.webp'),(33,'Ford Edge','Mid-size SUV',105.99,1,'Engine: 2.0L I4 Turbo, Horsepower: 250 hp, Fuel Economy: 21 mpg city / 29 mpg highway, Top Speed: 130 mph, Drivetrain: AWD, Transmission: 8-speed automatic, Seats: 5, Features: Ford Co-Pilot360 Assist, Enhanced safety tech','/image/ford_edge.webp'),(34,'Mercedes-Benz GLC','Luxury compact SUV',145.99,1,'Engine: 2.0L I4 Turbo, Horsepower: 255 hp, Fuel Economy: 22 mpg city / 27 mpg highway, Top Speed: 130 mph, Drivetrain: AWD, Transmission: 9-speed automatic, Seats: 5, Features: Mercedes-Benz User Experience (MBUX), Luxury interior fittings','/image/mercedes_benz_glc.webp'),(35,'Volvo XC60','Luxury compact SUV',155.99,1,'Engine: 2.0L I4 Turbo, Horsepower: 250 hp, Fuel Economy: 22 mpg city / 29 mpg highway, Top Speed: 130 mph, Drivetrain: AWD, Transmission: 8-speed automatic, Seats: 5, Features: Volvo Safety Technology, Scandinavian design','/image/volvo_XC60.webp'),(36,'Mazda 3','Compact car',49.99,1,'Engine: 2.5L I4, Horsepower: 186 hp, Fuel Economy: 26 mpg city / 35 mpg highway, Top Speed: 122 mph, Drivetrain: FWD, Transmission: 6-speed automatic, Seats: 5, Features: Mazda Connect infotainment system, Responsive driving dynamics','/image/mazda_3.webp'),(37,'Honda CR-V','Compact SUV',79.99,1,'Engine: 1.5L I4 Turbo, Horsepower: 190 hp, Fuel Economy: 28 mpg city / 34 mpg highway, Top Speed: 112 mph, Drivetrain: AWD, Transmission: CVT, Seats: 5, Features: Honda Sensing technologies, Spacious interior','/image/honda_CR_V.webp'),(38,'Chevrolet Malibu','Mid-size sedan',59.99,1,'Engine: 1.5L I4 Turbo, Horsepower: 160 hp, Fuel Economy: 29 mpg city / 36 mpg highway, Top Speed: 125 mph, Drivetrain: FWD, Transmission: CVT, Seats: 5, Features: Chevrolet Infotainment 3 System, Comfortable ride','/image/chevrolet_malibu.webp'),(39,'Subaru Impreza','Compact car',44.99,1,'Engine: 2.0L I4, Horsepower: 152 hp, Fuel Economy: 28 mpg city / 36 mpg highway, Top Speed: 122 mph, Drivetrain: AWD, Transmission: 5-speed manual, Seats: 5, Features: Subaru Starlink multimedia, All-weather capability','/image/subaru_impreza.webp'),(40,'Hyundai Santa Fe','Mid-size SUV',95.99,1,'Engine: 2.4L I4, Horsepower: 185 hp, Fuel Economy: 22 mpg city / 29 mpg highway, Top Speed: 130 mph, Drivetrain: AWD, Transmission: 8-speed automatic, Seats: 5, Features: Hyundai SmartSense, Comfort-focused features','/image/hyundai_santaFe.webp');
/*!40000 ALTER TABLE `Voiture` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `VoitureCategory`
--

DROP TABLE IF EXISTS `VoitureCategory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `VoitureCategory` (
  `voiture_id` int NOT NULL,
  `category_id` int NOT NULL,
  PRIMARY KEY (`voiture_id`,`category_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `voiturecategory_ibfk_1` FOREIGN KEY (`voiture_id`) REFERENCES `Voiture` (`Id`),
  CONSTRAINT `voiturecategory_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `Category` (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `VoitureCategory`
--

LOCK TABLES `VoitureCategory` WRITE;
/*!40000 ALTER TABLE `VoitureCategory` DISABLE KEYS */;
INSERT INTO `VoitureCategory` VALUES (1,1),(7,1),(11,1),(12,1),(28,1),(3,2),(14,2),(15,2),(24,2),(2,3),(13,3),(4,4),(8,4),(12,4),(13,4),(15,4),(16,4),(17,4),(20,4),(21,4),(25,4),(27,4),(29,4),(30,4),(31,4),(32,4),(33,4),(34,4),(35,4),(37,4),(40,4),(2,5),(5,5),(7,5),(18,5),(22,5),(36,5),(39,5),(4,6),(6,6),(10,6),(19,6),(20,6),(21,6),(23,6),(26,6),(27,6),(28,6),(34,6),(35,6),(38,6),(9,7),(14,7),(24,7),(3,8),(8,8),(25,8),(31,8);
/*!40000 ALTER TABLE `VoitureCategory` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-07-29 16:32:00
