use mohsen;

CREATE TABLE OREDERS (

ORDER_ID INT NOT NULL AUTO_INCREMENT,
PRODUCT_ID INT NOT NULL,
PRIMARY KEY (ORDER_ID),
FOREIGN KEY (PRODUCT_ID) REFERENCES product(ID)


);