CREATE DATABASE mohsen;
USE mohsen;

CREATE TABLE COUNTRIES(COUNTRY_ID INT NOT NULL AUTO_INCREMENT, COUNTRY_NAME VARCHAR(25) NOT NULL, PRIMARY KEY(COUNTRY_ID));

INSERT INTO countries (COUNTRY_NAME) VALUES ('Romania');
INSERT INTO countries (COUNTRY_NAME) VALUES ('USA');
INSERT INTO countries (COUNTRY_NAME) VALUES ('Luxembourg');
INSERT INTO countries (COUNTRY_NAME) VALUES ('Afganistan');


CREATE TABLE ppl 
(PERSON_ID INT NOT NULL AUTO_INCREMENT, 
 First_Name VARCHAR(25) NOT NULL, 
 Second_Name VARCHAR(25) NOT NULL,
 Age INT,
 UserName VARCHAR(25) NOT NULL UNIQUE,
 Password VARCHAR(25) NOT NULL,
 Nationality INT NOT NULL,
 PRIMARY KEY (PERSON_ID),
 FOREIGN KEY (Nationality) REFERENCES COUNTRIES(COUNTRY_ID)
);
