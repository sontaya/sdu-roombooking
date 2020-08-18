/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 5.7.19 : Database - roombooking
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `booking_info` */

CREATE TABLE `booking_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(50) DEFAULT NULL,
  `booking_org` text,
  `booking_email` varchar(100) DEFAULT NULL,
  `booking_phone` varchar(100) DEFAULT NULL,
  `room_id` varchar(5) DEFAULT NULL,
  `participant` decimal(10,0) DEFAULT NULL,
  `booking_date_start` datetime DEFAULT NULL,
  `booking_date_end` datetime DEFAULT NULL,
  `booking_status` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_by_ip` varchar(100) DEFAULT NULL,
  `modified_at` timestamp NULL DEFAULT NULL,
  `modified_by` varchar(255) DEFAULT NULL,
  `updated_by_ip` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `booking_info` */

insert  into `booking_info`(`id`,`user_id`,`booking_org`,`booking_email`,`booking_phone`,`room_id`,`participant`,`booking_date_start`,`booking_date_end`,`booking_status`,`created_at`,`created_by`,`created_by_ip`,`modified_at`,`modified_by`,`updated_by_ip`) values (1,NULL,'b','','','12','3',NULL,NULL,'pending',NULL,'สนธยา แย้มเดช','127.0.0.1',NULL,NULL,NULL),(2,'2020-052','bb','cc@local.com','1546','02','3','2020-07-09 08:30:00','2020-07-09 12:00:00','pending',NULL,'สนธยา แย้มเดช','127.0.0.1',NULL,NULL,NULL),(3,'2020-052','bbbb','cc@local.com','1546','02','3','2020-07-09 08:30:00','2020-07-16 13:00:00','pending','2020-07-09 14:19:37','สนธยา แย้มเดช','127.0.0.1',NULL,NULL,NULL);

/*Table structure for table `room_master` */

CREATE TABLE `room_master` (
  `id` varchar(5) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `room_type` char(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `room_master` */

insert  into `room_master`(`id`,`name`,`room_type`) values ('01','ห้องรองอธิการบดีฝ่ายเทคโนโลยีสารสนเทศ','1'),('02','โรงเรียนสาธิตละอออุทิศ','1'),('03','โรงเรียนสาธิตละอออุทิศ','2'),('04','คณะครุศาสตร์','2'),('05','คณะวิทยาศาสตร์และเทคโนโลยี','2'),('06','โรงเรียนการเรือน','2'),('07','คณะพยาบาลศาสตร์','2'),('08','คณะมนุษยศาสตร์และสังคมศาสตร์','2'),('09','คณะวิทยาการจัดการ','2'),('10','โรงเรียนการท่องเที่ยวและบริการ','2'),('11','โรงเรียนกฏหมายและการเมืองและ','2'),('12','บัณฑิตวิทยาลัย','2'),('13','วิทยาเขตสุพรรณบุรี','2'),('14','ศูนย์การศึกษานอกที่ตั้ง นครนายก','2'),('15','ศูนย์การศึกษานอกที่ตั้ง ลำปาง','2'),('16','ศูนย์การศึกษานอกที่ตั้ง หัวหิน','2'),('17','ศูนย์การศึกษานอกที่ตั้ง ตรัง','2');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
