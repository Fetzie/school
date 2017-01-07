<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "phpClass";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
	die("Verbindungsfehler: " . mysqli_connect_error());
}

// sql to create table
$sql = "CREATE TABLE customers (
  id int(11) NOT NULL,
  firstname varchar(55) NOT NULL,
  lastname varchar(55) NOT NULL,
  emailaddress varchar(55) NOT NULL,
  address1 varchar(55) NOT NULL,
  houseNumber varchar(55) NOT NULL,
  zipcode varchar(55) NOT NULL,
  city varchar(55) NOT NULL,
  passcode varchar(50) NOT NULL,
  advertisementid int(6) UNSIGNED NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO customers (id, firstname, lastname, emailaddress, address1, houseNumber, zipcode, city, passcode) VALUES
(1, 'admin', 'admin', 'admin@example.com', 'adminstreet', 123, '12345', 'admincity', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE customers
  ADD PRIMARY KEY (id),
  ADD UNIQUE KEY emailaddress (emailaddress)
  ADD FOREIGN KEY (advertisementid) REFERENCES annoncen(id) ON UPDATE CASCADE ON DELETE CASCADE;

		
ALTER TABLE 'customers' ADD CONSTRAINT 'customer2annonce' FOREIGN KEY ('advertisementid') REFERENCES 'phpclass2'.'annoncen'('annoncenID') ON DELETE CASCADE ON UPDATE CASCADE;
--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table customers
--
ALTER TABLE customers
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;";

if (mysqli_query($conn, $sql)) {
	echo "Tabelle rubrik erfolgreich erzeugt";
} else {
	echo "Fehler bei der Erzeugung der Tabelle: " . mysqli_error($conn);
}

mysqli_close($conn);
?>