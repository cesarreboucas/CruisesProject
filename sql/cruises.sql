DROP DATABASE IF EXISTS CRUISES;
CREATE DATABASE CRUISES;
use cruises;

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

DROP TABLE IF EXISTS facilities;
CREATE TABLE IF NOT EXISTS facilities (
    id int NOT NULL AUTO_INCREMENT,
    name varchar(45) NOT NULL,
    PRIMARY KEY (id));

DROP TABLE IF EXISTS tours;
CREATE TABLE IF NOT EXISTS tours (
  id int NOT NULL AUTO_INCREMENT,
  sailing_date date DEFAULT NULL,
  duration int NOT NULL,
  title varchar(100) NOT NULL,
  ship int NOT NULL,
  from_city int NOT NULL,
  to_city int NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (from_city) REFERENCES cities.id,
  FOREIGN KEY (to_city) REFERENCES cities.id,
  FOREIGN KEY (ship) REFERENCES ships(id));

DROP TABLE IF EXISTS attractions;
CREATE TABLE IF NOT EXISTS attractions (
  id int NOT NULL AUTO_INCREMENT,
  attraction varchar(30) NOT NULL,
  tour int NOT NULL,
  PRIMARY KEY (id),  
  FOREIGN KEY (tour) REFERENCES tours(id));

DROP TABLE IF EXISTS facilities_ship;
CREATE TABLE IF NOT EXISTS facilities_ship (
  id int NOT NULL AUTO_INCREMENT,
  facilities int NOT NULL,
  ship int NOT NULL,
  PRIMARY KEY (id),  
  FOREIGN KEY (facilities) REFERENCES facilities(id),
  FOREIGN KEY (ship) REFERENCES ships(id));

insert into cities(name) values 
  ('Alaska'),
  ('Bahamas'),
  ('Australia'),
  ('Caribbean'),
  ('Panama Canal'),
  ('Mexico');

insert into ships(name) values 
  ('Polar Bear'),
  ('Grizzly Bear'),
  ('Black Bear'),
  ('Brown Bear'),
  ('Spirit Bear');

insert into facilities(name) values 
  ('Olympic Swiming Pool'),
  ('Fitnes Center'),
  ('Cinema'),
  ('Spa'),
  ('Hot Tub'),
  ('Casino'),
  ('Tennis Courts'),
  ('Water Slide');
