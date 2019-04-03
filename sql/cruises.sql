DROP DATABASE IF EXISTS CRUISES;
CREATE DATABASE CRUISES;
use CRUISES;

DROP TABLE IF EXISTS cities;
CREATE TABLE IF NOT EXISTS cities (
  id int NOT NULL AUTO_INCREMENT,
  name varchar(50) NOT NULL,
  active boolean not null default 1,
  PRIMARY KEY (id));

DROP TABLE IF EXISTS ships;
CREATE TABLE IF NOT EXISTS ships (
  id int NOT NULL AUTO_INCREMENT,
  name varchar(45) NOT NULL,
  yearservice int(5) NOT NULL,
  active boolean not null default 1,
  PRIMARY KEY (id));

DROP TABLE IF EXISTS facilities;
CREATE TABLE IF NOT EXISTS facilities (
    id int NOT NULL AUTO_INCREMENT,
    name varchar(45) NOT NULL,
    active boolean not null default 1,
    PRIMARY KEY (id));

DROP TABLE IF EXISTS tours;
CREATE TABLE IF NOT EXISTS tours (
  id int NOT NULL AUTO_INCREMENT,
  sailing_date date DEFAULT NULL,
  duration int NOT NULL,
  ship int NOT NULL,
  from_city int NOT NULL,
  to_city int NOT NULL,
  oneway int(1) not null,
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
  ('Aruba'),
  ('Curacao'),
  ('Caribbean'),
  ('Vancouver'),
  ('Puerto Rico'),
  ('Jamaica'),
  ('US Virgin Islands');

insert into ships(name,yearservice) values 
  ('Polar Bear',2008),
  ('Grizzly Bear',2013),
  ('Black Bear',2009),
  ('Brown Bear',2015),
  ('Spirit Bear',2012);

insert into facilities(name) values 
  ('Olympic Swiming Pool'),
  ('Fitnes Center'),
  ('Cinema'),
  ('Spa'),
  ('Hot Tub'),
  ('Casino'),
  ('Tennis Courts'),
  ('Water Slide');

insert into tours (sailing_date,duration,ship,from_city,to_city,oneway) values 
  ('2019-11-27',  7, 1, 6, 1, 0),
  ('2019-08-22',  9, 2, 8, 9, 1),
  ('2019-08-22', 14, 2, 6, 2, 0);

insert into attractions (attraction, tour) values 
  ('Phill Show',1),
  ('Cirque',2),
  ('Someone else show',2),
  ('Justin show',2);

insert into facilities_ship (facilities,ship) values 
  (1,1),
  (5,2),
  (4,3),
  (3,4),
  (4,5),
  (4,6),
  (3,6),
  (2,7),
  (2,8);