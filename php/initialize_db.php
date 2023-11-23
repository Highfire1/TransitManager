<?php declare(strict_types=1);


function createDBConnection(String $username="root", String $password="root", String $dbname="transitmanager"){
    $servername = "localhost";

    // Create connection
    $conn = new mysqli($servername, $username, $password);

    // Check that connection is successful
    if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

	$GLOBALS["db"] = $conn;
	return $conn;
}

function initialize_db($dbname = "transitmanager") {
    $query = "
    CREATE TABLE IF NOT EXISTS Driver(
        DID INTEGER,
        DName VARCHAR(50),
        DLicense VARCHAR(50),
        PRIMARY KEY(DID)
    );

    CREATE TABLE IF NOT EXISTS TransitVehicle (
        VID INTEGER,
        D_ID INTEGER,
        T_Capacity INTEGER,
        Status VARCHAR(20),
        PRIMARY KEY(VID),
        FOREIGN KEY(D_ID) REFERENCES Driver(DID)
    );

    CREATE TABLE IF NOT EXISTS Route(
        RID VARCHAR(50),
        R_start VARCHAR(50),
        Destination VARCHAR(50),
        PRIMARY KEY(RID)
    );

    CREATE TABLE IF NOT EXISTS Stop(
        SID INTEGER,
        Address VARCHAR(50),
        PRIMARY KEY(SID)
    );

    CREATE TABLE IF NOT EXISTS Passenger(
        PID INTEGER,
        Name VARCHAR(50),
        Age INTEGER,
        PRIMARY KEY(PID)
    );

    CREATE TABLE IF NOT EXISTS Card(
        PassID INTEGER NOT NULL,
        CID INTEGER,
        Balance REAL,
        CType VARCHAR(10),
        PRIMARY KEY(PassID, CID),
        FOREIGN KEY(PassID) REFERENCES Passenger(PID) ON DELETE CASCADE
    );

    CREATE TABLE IF NOT EXISTS TransitBus(
        Vehicle_ID INTEGER,
        License_Number VARCHAR(10),
        PRIMARY KEY(Vehicle_ID),
        FOREIGN KEY(Vehicle_ID) REFERENCES TransitVehicle(VID)
    );

    CREATE TABLE IF NOT EXISTS TransitTrain(
        Vehicle_ID INTEGER,
        Train_Number VARCHAR(10),
        Number_Of_Cars INTEGER,
        PRIMARY KEY(Vehicle_ID),
        FOREIGN KEY(Vehicle_ID) REFERENCES TransitVehicle(VID)
    );

    CREATE TABLE IF NOT EXISTS PassengerRidesTransit(
        P_ID INTEGER,
        V_ID INTEGER,
        PRIMARY KEY(P_ID, V_ID),
        FOREIGN KEY(P_ID) REFERENCES Passenger(PID) ON DELETE CASCADE,
        FOREIGN KEY(V_ID) REFERENCES TransitVehicle(VID)
    );

    CREATE TABLE IF NOT EXISTS TransitTakesRoute (
        R_ID VARCHAR(50),
        V_ID INTEGER,
        PRIMARY KEY(R_ID, V_ID),
        FOREIGN KEY(R_ID) REFERENCES Route(RID),
        FOREIGN KEY(V_ID) REFERENCES TransitVehicle(VID)
    );

    CREATE TABLE IF NOT EXISTS RouteHasStop(
        S_ID INTEGER,
        R_ID VARCHAR(50),
        PRIMARY KEY(S_ID, R_ID),
        FOREIGN KEY(S_ID) REFERENCES Stop(SID),
        FOREIGN KEY(R_ID) REFERENCES Route(RID)
    );

    CREATE TABLE IF NOT EXISTS Route_IsTransferable(
        R_ID1 VARCHAR(50),
        R_ID2 VARCHAR(50),
        PRIMARY KEY(R_ID1, R_ID2),
        FOREIGN KEY(R_ID1) REFERENCES Route(RID),
        FOREIGN KEY(R_ID2) REFERENCES Route(RID)
    );
    ";

    $conn = createDBConnection();

    $result = $conn->query("CREATE DATABASE IF NOT EXISTS $dbname;");
    $result = $conn->query("USE $dbname;");

    $conn->close();
}

initialize_db();
?>