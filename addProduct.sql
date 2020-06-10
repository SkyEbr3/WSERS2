DROP database mohsen;
CREATE DATABASE mohsen;
USE mohsen;

CREATE TABLE Products (
    ID INT NOT NULL AUTO_INCREMENT, 
    Name VARCHAR(50) NOT NULL,  
    Description VARCHAR(500),
    Price INT NOT NULL,
    Picture VARCHAR(50),
    PRIMARY KEY (ID)
    );

INSERT INTO Products (Name,Description,Price,Picture) VALUES("Carrots","Yummy vegetable", 1, "carrot.jpg");
INSERT INTO Products (Name,Description,Price,Picture) VALUES("Tomatoes","Red vegetable that makes you healthy", 3, "tomato.jpg");
INSERT INTO Products (Name,Description,Price,Picture) VALUES("Cucumber","Green thing vegetable", 4, "cucumber.jpg");
INSERT INTO Products (Name,Description,Price,Picture) VALUES("GreenPeas","Small ones", 10, "greenPeas.jpg");
INSERT INTO Products (Name,Description,Price,Picture) VALUES("Potatoes","They stay in the ground", 1, "Potato.jpg");
INSERT INTO Products (Name,Description,Price,Picture) VALUES("Zucchini","They stay in the ground", 1, "zucchini.jpg");
INSERT INTO Products (Name,Description,Price,Picture) VALUES("Turnip","They stay in the ground", 1.6, "turnip.png");
INSERT INTO Products (Name,Description,Price,Picture) VALUES("Spinach","They stay in the ground", 1, "spinach.jpeg");
INSERT INTO Products (Name,Description,Price,Picture) VALUES("Radish","They stay in the ground", 1, "radish.png");
INSERT INTO Products (Name,Description,Price,Picture) VALUES("Pineapple","They stay in the ground", 1, "pineapple.jpg");
INSERT INTO Products (Name,Description,Price,Picture) VALUES("Onioins","They stay in the ground", 3, "onions.jpg");
INSERT INTO Products (Name,Description,Price,Picture) VALUES("Mushroom","They stay in the ground", 1, "mushroom.jpg");
INSERT INTO Products (Name,Description,Price,Picture) VALUES("Zucchini","They stay in the ground", 1, "zucchini.jpg");
INSERT INTO Products (Name,Description,Price,Picture) VALUES("Mango","They stay in the ground", 1.7, "mango.jpg");
INSERT INTO Products (Name,Description,Price,Picture) VALUES("Lime","They stay in the ground", 1.6, "lime.jpg");
INSERT INTO Products (Name,Description,Price,Picture) VALUES("Lettuce","They stay in the ground", 1.3, "lettuce.jpg");
INSERT INTO Products (Name,Description,Price,Picture) VALUES("Leek","They stay in the ground", 1.4, "Leek.jpg");
INSERT INTO Products (Name,Description,Price,Picture) VALUES("Grapes","They stay in the ground", 2, "grapes.jpg");
INSERT INTO Products (Name,Description,Price,Picture) VALUES("Eggplant","They stay in the ground", 1.8, "eggplant.jpg");
INSERT INTO Products (Name,Description,Price,Picture) VALUES("Cauliflower","They stay in the ground", 1.9, "cauliflower.png");
INSERT INTO Products (Name,Description,Price,Picture) VALUES("Cabbage","They stay in the ground", 2, "cabbage.png");
INSERT INTO Products (Name,Description,Price,Picture) VALUES("Broccolli","They stay in the ground", 2, "brocoli.png");
INSERT INTO Products (Name,Description,Price,Picture) VALUES("Bell papper","They stay in the ground", 1.6, "bell papper.jpg");
INSERT INTO Products (Name,Description,Price,Picture) VALUES("Banana","They stay in the ground", 1, "banana.jpg");
INSERT INTO Products (Name,Description,Price,Picture) VALUES("Kiwi","They stay in the ground", 2.5, "kiwi.jpg");





CREATE TABLE USER_ROLES(
    ID INT NOT NULL AUTO_INCREMENT, 
    UserType VARCHAR(20) NOT NULL,
    PRIMARY KEY (ID)
);

INSERT INTO USER_ROLES (UserType) VALUES ('Admin');
INSERT INTO USER_ROLES (UserType) VALUES ('Customer');

CREATE TABLE COUNTRIES(
    COUNTRY_ID INT NOT NULL AUTO_INCREMENT, 
    COUNTRY_NAME VARCHAR(25) NOT NULL, 
    PRIMARY KEY(COUNTRY_ID)
);

INSERT INTO COUNTRIES (COUNTRY_NAME) VALUES ('Afghanistan');
INSERT INTO COUNTRIES (COUNTRY_NAME) VALUES ('Belgium');
INSERT INTO COUNTRIES (COUNTRY_NAME) VALUES ('France');
INSERT INTO COUNTRIES (COUNTRY_NAME) VALUES ('Germany');
INSERT INTO COUNTRIES (COUNTRY_NAME) VALUES ('Luxembourg');
INSERT INTO COUNTRIES (COUNTRY_NAME) VALUES ('Romania');
INSERT INTO COUNTRIES (COUNTRY_NAME) VALUES ('United States');


CREATE TABLE PPL (
    PERSON_ID INT NOT NULL AUTO_INCREMENT, 
    First_Name VARCHAR(25) NOT NULL, 
    Second_Name VARCHAR(25) NOT NULL,
    Age INT,
    UserName VARCHAR(25) NOT NULL UNIQUE,
    Password VARCHAR(150) NOT NULL,
    Nationality INT NOT NULL,
    User_role INT NOT NULL,
    PRIMARY KEY (PERSON_ID),
    FOREIGN KEY (Nationality) REFERENCES COUNTRIES(COUNTRY_ID),
    FOREIGN KEY (User_role) REFERENCES USER_ROLES(ID)
);




COMMIT;