IF NOT EXISTS {
CREATE database 'phpClass';
}

USING database 'phpClass';

CREATE table customers
{
id int not null AUTO_INCREMENT,
firstname VARCHAR(55) not null,
lastname VARCHAR (55) not null,
emailaddress VARCHAR (55) not null,
address1 VARCHAR (55) not null,
houseNumber VARCHAR (55) not null,
zipcode VARCHAR (55) not null,
city VARCHAR (55) not null,
PRIMARY KEY (id)
};

CREATE table customerpaymentmethods
{
id int(20) not null AUTO_INCREMENT,
customerid int(20) not null ,
paymentmethod int(20) not null,
cardnumber VARCHAR(60) not null,
cardname VARCHAR(60) not null,
expires VARCHAR(60) not null,
secnumber VARCHAR(60),
billingaddress VARCHAR(500) not null,
PRIMARY KEY (id)
FOREIGN KEY customerid REFERENCES customers(id) ON UPDATE CASCADE ON DELETE RESTRICT
FOREIGN KEY paymentmethod REFERENCES paymentOptions(id) ON UPDATE CASCADE ON DELETE RESTRICT 
};

CREATE table paymentOptions{
id int,
paymenttype VARCHAR(10),
PRIMARY KEY (id)
};

CREATE table advertisement{
id int,
text VARCHAR (5000),
picturepath VARCHAR (240),
customerid int not null,
createdate int not null,
expiredate int not null,
duration int not null,
transactionid int not null,
categoryid int not null,
PRIMARY KEY (id)
FOREIGN KEY (customerid) REFERENCES customers(id) ON UPDATE CASCADE ON DELETE RESTRICT
FOREIGN KEY (transactionid) REFERENCES transactions(id) ON UPDATE CASCADE ON DELETE RESTRICT
};

CREATE table advertisement2category{
advertisementid int not null,
categoryid int not null,
FOREIGN KEY (categoryid) REFERENCES category(id) ON UPDATE CASCADE ON DELETE RESTRICT
FOREIGN KEY (advertisementid) REFERENCES advertisement(id) ON UPDATE CASCADE ON DELETE RESTRICT
};

CREATE table category{
id int not null auto_increment(0),
name VARCHAR(255) not null,
parentid int not null,
PRIMARY KEY (id)
};

CREATE table transactions{
id int not null AUTO_INCREMENT,
customerid int not null,
price double not null,
paymentoptionid int not null,
advertisementid int not null,
paymentdate int not null,
paymentmethodid int not null,
PRIMARY KEY (id)
FOREIGN KEY (customerid) REFERENCES customer(id) ON UPDATE CASCADE ON DELETE RESTRICT
FOREIGN KEY (paymentoption) REFERENCES paymentoption(id) ON UPDATE CASCADE ON DELETE RESTRICT
FOREIGN KEY (advertisementid) REFERENCES advertisement(id) ON UPDATE CASCADE ON DELETE RESTRICT
FOREIGN KEY (paymentmethodid) REFERENCES customerpaymentmethods(id) ON UPDATE CASCADE ON DELETE RESTRICT
};