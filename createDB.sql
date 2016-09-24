IF NOT EXISTS {
CREATE database 'phpClass';
}

USING database 'phpClass';

CREATE table customers
{
id int not null auto_increment,
firstName VARCHAR(55) not null,
lastName VARCHAR (55),
emailAddress VARCHAR (55),
address1 VARCHAR (55),
houseNumber VARCHAR (55),
zipcode VARCHAR (55),
city VARCHAR (55),
PRIMARY KEY (id)
}

CREATE table customerpaymentmethods
{
id int not null AUTO_INCREMENT,
customerid int not null ,
paymentMethod int,
cardNumber VARCHAR,
cardName VARCHAR,
expires VARCHAR,
secNumber VARCHAR,
PRIMARY KEY (id)
FOREIGN KEY customerid REFERENCES customers(id) ON UPDATE CASCADE ON DELETE RESTRICT
FOREIGN KEY paymentmethod REFERENCES paymentOptions(id) ON UPDATE CASCADE ON DELETE RESTRICT 
}

CREATE table paymentOptions{
id int,
paymentType VARCHAR(255),
PRIMARY KEY (id)
}

CREATE table advertisement{

id int,
text VARCHAR 5000,
picturePath VARCHAR 240,
customerid int ,
createDate int,
expireDate int,
duration int,
transactionid int,
PRIMARY KEY (id)
FOREIGN KEY (customerid) REFERENCES customers(id) ON UPDATE CASCADE ON DELETE RESTRICT
FOREIGN KEY (transactionid) REFERENCES transactions(id) ON UPDATE CASCADE ON DELETE RESTRICT
}

CREATE table category{
id int not null auto_increment(0),
name VARCHAR(255),
parentid int,
PRIMARY KEY (id)
}