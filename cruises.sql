DROP DATABASE IF EXISTS CRUISES;
CREATE DATABASE CRUISES;

DROP TABLE IF EXISTS attractions;
CREATE TABLE IF NOT EXISTS attractions (
  id int NOT NULL AUTO_INCREMENT,
  name int NOT NULL,
  PRIMARY KEY (id));

DROP TABLE IF EXISTS cities;
CREATE TABLE IF NOT EXISTS cities (
  id int NOT NULL AUTO_INCREMENT,
  name varchar(50) NOT NULL,
  PRIMARY KEY (id));

DROP TABLE IF EXISTS ships;
CREATE TABLE IF NOT EXISTS ships (
  id int NOT NULL AUTO_INCREMENT,
  name varchar(45) NOT NULL,
  PRIMARY KEY (id));

DROP TABLE IF EXISTS tours;
CREATE TABLE IF NOT EXISTS tours (
  id int(11) NOT NULL AUTO_INCREMENT,
  sailing_date date DEFAULT NULL,
  duration int NOT NULL,
  title varchar(100) NOT NULL,
  ship int NOT NULL,
  from_city int NOT NULL,
  to_city int NOT NULL,
  PRIMARY KEY (id)
  FOREIGN KEY (from_city) REFERENCES cities(id),
  FOREIGN KEY (to_city) REFERENCES cities(id),
  FOREIGN KEY (ship) REFERENCES ships(id));


