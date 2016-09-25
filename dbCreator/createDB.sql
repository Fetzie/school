IF NOT EXISTS {
CREATE database 'phpClass';
}

USING database 'phpClass';

CREATE table customers
{
id int not null AUTO_INCREMENT,
firstName VARCHAR(55) not null,
lastName VARCHAR (55) not null,
emailAddress VARCHAR (55) not null,
address1 VARCHAR (55) not null,
houseNumber VARCHAR (55) not null,
zipcode VARCHAR (55) not null,
city VARCHAR (55) not null,
PRIMARY KEY (id)
}

CREATE table customerpaymentmethods
{
id int(20) not null AUTO_INCREMENT,
customerid int(20) not null ,
paymentMethod int(20) not null,
cardNumber VARCHAR(60) not null,
cardName VARCHAR(60) not null,
expires VARCHAR(60) not null,
secNumber VARCHAR(60),
billingAddress VARCHAR(500) not null,
PRIMARY KEY (id)
FOREIGN KEY customerid REFERENCES customers(id) ON UPDATE CASCADE ON DELETE RESTRICT
FOREIGN KEY paymentmethod REFERENCES paymentOptions(id) ON UPDATE CASCADE ON DELETE RESTRICT 
}

CREATE table paymentOptions{
id int,
paymentType VARCHAR(10),
PRIMARY KEY (id)
}

CREATE table advertisement{

id int,
text VARCHAR (5000),
picturePath VARCHAR (240),
customerid int ,
createDate int,
expireDate int,
duration int,
transactionid int,
categoryid int
PRIMARY KEY (id)
FOREIGN KEY (customerid) REFERENCES customers(id) ON UPDATE CASCADE ON DELETE RESTRICT
FOREIGN KEY (transactionid) REFERENCES transactions(id) ON UPDATE CASCADE ON DELETE RESTRICT
}

CREATE table advertisement2category{
advertisementid int,
categoryid int,
FOREIGN KEY (categoryid) REFERENCES category(id) ON UPDATE CASCADE ON DELETE RESTRICT
FOREIGN KEY (advertisementid) REFERENCES advertisement(id) ON UPDATE CASCADE ON DELETE RESTRICT

}

CREATE table category{
id int not null auto_increment(0),
name VARCHAR(255),
parentid int,
PRIMARY KEY (id)
}

CREATE table transactions{
id int AUTO_INCREMENT,
customerid int,
price double,
paymentoptionid VARCHAR,
PRIMARY KEY (id)
FOREIGN KEY (customerid) REFERENCES customer(id) ON UPDATE CASCADE ON DELETE RESTRICT
FOREIGN KEY (paymentoption) REFERENCES paymentoption(id) ON UPDATE CASCADE ON DELETE RESTRICT
]