<?php


function createDBConnection(String $username="root", String $password="root", String $dbname="transit"){
    $servername = "localhost";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check that connection is successful
    if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

	// $GLOBALS["db"] = $conn;
	return $conn;
}

function initialize_db($dbname = "transit") {
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
	$result = $conn->multi_query($query);

    $conn->close();
}

function initialize_populate_db($dbname = "transit") {
    $query = "
    
    CREATE Table IF NOT EXISTS Passenger(
        PID INTEGER,
        Name VARCHAR(50),
        Age INTEGER,
        PRIMARY KEY(PID));
    
    CREATE Table IF NOT EXISTS Route(
        RID VARCHAR(50),
        R_start VARCHAR(50),
        Destination VARCHAR(50),
        PRIMARY KEY(RID));
    
    CREATE Table IF NOT EXISTS Driver(
        DID INTEGER,
        DName VARCHAR(50),
        DLicense VARCHAR(50),
        PRIMARY KEY(DID));
    
    Create Table IF NOT EXISTS Stop(
        SID INTEGER,
        Address VARCHAR(50),
        PRIMARY KEY(SID));
    
    CREATE Table IF NOT EXISTS Card(
        PassID INTEGER NOT NULL,
        CID INTEGER,
        Balance REAL,
        CType VARCHAR(10),
        PRIMARY KEY(PassID, CID),
        FOREIGN KEY(PassID) References Passenger(PID) ON DELETE CASCADE);
    
    CREATE Table IF NOT EXISTS TransitVehicle (
        VID INTEGER,
        D_ID INTEGER,
        T_Capacity INTEGER,
        Status VARCHAR(20),
        PRIMARY KEY(VID),
            FOREIGN KEY(D_ID) References Driver(DID) ON UPDATE CASCADE);
    
    CREATE Table IF NOT EXISTS PassengerRidesTransit(
        P_ID INTEGER,
        V_ID INTEGER,
        PRIMARY KEY(P_ID, V_ID),
        FOREIGN KEY(P_ID) References Passenger(PID) ON DELETE CASCADE,
        FOREIGN KEY(V_ID) References TransitVehicle(VID));
    
    CREATE Table IF NOT EXISTS TransitBus(
        Vehicle_ID INTEGER,
        License_Number VARCHAR(10) unique,
        PRIMARY KEY(Vehicle_ID),
        FOREIGN KEY(Vehicle_ID) References TransitVehicle(VID));
    
    CREATE Table IF NOT EXISTS TransitTrain(
        Vehicle_ID INTEGER,
        Train_Number VARCHAR(10) unique,
        Number_Of_Cars INTEGER,
        PRIMARY KEY(Vehicle_ID),
        FOREIGN KEY(Vehicle_ID) References TransitVehicle(VID));
    
    CREATE Table IF NOT EXISTS TransitTakesRoute (
        R_ID VARCHAR(50),
        V_ID INTEGER,
        PRIMARY KEY(R_ID, V_ID),
        FOREIGN KEY(R_ID) References Route(RID),
        FOREIGN KEY(V_ID) References TransitVehicle(VID));
    
    CREATE Table IF NOT EXISTS RouteHasStop(
        S_ID INTEGER,
        R_ID VARCHAR(50),
        PRIMARY KEY(S_ID, R_ID),
        FOREIGN KEY(S_ID) References Stop(SID),
        FOREIGN KEY(R_ID) References Route(RID));
    
    Create Table IF NOT EXISTS Route_IsTransferable(
        R_ID1 VARCHAR(50),
        R_ID2 VARCHAR(50),
        PRIMARY KEY(R_ID1, R_ID2),
        FOREIGN KEY(R_ID1) References Route(RID),
        FOREIGN KEY(R_ID2) References Route(RID));
    
    INSERT INTO Passenger VALUES(0, 'Travis', 25);
    INSERT INTO Passenger VALUES(1, 'Tyson', 35);
    INSERT INTO Passenger VALUES(2, 'Lisa', 20);
    INSERT INTO Passenger VALUES(3, 'Anderson', 19);
    INSERT INTO Passenger VALUES(4, 'Bob', 70);
    INSERT INTO Passenger VALUES(5, 'Steve', 17);
    INSERT INTO Passenger VALUES(6, 'Smith', 31);
    INSERT INTO Passenger VALUES(7, 'Scott', 45);
    INSERT INTO Passenger VALUES(8, 'Alex', 12);
    INSERT INTO Passenger VALUES(9, 'Kayla', 23);
    INSERT INTO Passenger VALUES(10, 'Mike', 15);
    
    INSERT INTO Route VALUES('Route_P231', 'Station_01', 'Station_12');
    INSERT INTO Route VALUES('Route_P413', 'Station_07', 'Station_09');
    INSERT INTO Route VALUES('Route_P001', 'Station_10', 'Station_12');
    INSERT INTO Route VALUES('Route_P111', 'Station_04', 'Station_10');
    INSERT INTO Route VALUES('Route_P342', 'Station_13', 'Station_7');
    Insert INTO Route Values('T_Route_P123', 'Station_F1', 'Station_G3');
    
    INSERT INTO Driver VALUES(101, 'Carlos', 'Bus-Certified');
    INSERT INTO Driver VALUES(102, 'Frank', 'Bus-Certified');
    INSERT INTO Driver VALUES(103, 'Lewellyn', 'Bus-Certified');
    INSERT INTO Driver VALUES(104, 'Shav', 'Bus-Certified');
    INSERT INTO Driver VALUES(105, 'Peter', 'Train-Certified');
    INSERT INTO Driver VALUES(106, 'Kale', 'Train-Certified');
    INSERT INTO Driver VALUES(107, 'Patrick', 'Train-Certified');
    INSERT INTO Driver VALUES(108, 'Michael', 'Bus-Certified');
    INSERT INTO Driver VALUES(109, 'Michonne', 'Bus-Certified');
    INSERT INTO Driver VALUES(110, 'Ja', 'Bus-Certified');
    INSERT INTO Driver VALUES(111, 'Emma', 'Bus-Certified');
    
    INSERT INTO Stop VALUES(100001, 'Goblin st.');
    INSERT INTO Stop VALUES(100002, 'Helmeck st.');
    INSERT INTO Stop VALUES(100003, 'Super st.');
    INSERT INTO Stop VALUES(100004, 'Moeb st.');
    INSERT INTO Stop VALUES(100005, 'Calgary st.');
    INSERT INTO Stop VALUES(100006, 'Granville st.');
    INSERT INTO Stop VALUES(100007, 'Lopp st.');
    INSERT INTO Stop VALUES(100008, 'Smithe st.');
    INSERT INTO Stop VALUES(100009, 'Coral st.');
    INSERT INTO Stop VALUES(100010, 'Albe st.');
    INSERT INTO Stop VALUES(100011, 'Hermit st.');
    INSERT INTO Stop VALUES(100012, 'Bodel st.');
    
    INSERT INTO Card VALUES(0, 100100010001, 100.51, 'Adult');
    INSERT INTO Card VALUES(1, 100100010002, 50.43, 'Adult');
    INSERT INTO Card VALUES(2, 100100010003, 20.20, 'Adult');
    INSERT INTO Card VALUES(3, 100100010004, 10.01, 'Adult');
    INSERT INTO Card VALUES(4, 100100010005, 500.00, 'Senior');
    INSERT INTO Card VALUES(5, 100100010006, 30.21, 'Youth');
    INSERT INTO Card VALUES(6, 100100010007, 5.41, 'Adult');
    INSERT INTO Card VALUES(7, 100100010008, 2.09, 'Adult');
    INSERT INTO Card VALUES(8, 100100010009, 20.24, 'Youth');
    INSERT INTO Card VALUES(9, 100100010010, 80.01, 'Adult');
    INSERT INTO Card VALUES(10, 100100010011, 30.21, 'Youth');
    
    INSERT INTO TransitVehicle VALUES(10001,101, 30, 'In Service');
    INSERT INTO TransitVehicle VALUES(10002,102, 40, 'In Service');
    INSERT INTO TransitVehicle VALUES(10003,103, 20, 'In Service');
    INSERT INTO TransitVehicle VALUES(10004,104, 35, 'In Service');
    INSERT INTO TransitVehicle VALUES(10005,105, 99, 'In Service');
    INSERT INTO TransitVehicle VALUES(10006,106, 70, 'In Service');
    INSERT INTO TransitVehicle VALUES(10007,107, 80, 'In Service');
    INSERT INTO TransitVehicle VALUES(10008,108, 25, 'In Service');
    INSERT INTO TransitVehicle VALUES(10009,109, 30, 'In Service');
    INSERT INTO TransitVehicle VALUES(10010,110, 35, 'In Service');
    INSERT INTO TransitVehicle VALUES(10011,111, 30, 'In Service');
    
    INSERT INTO PassengerRidesTransit VALUES(0,10001);
    INSERT INTO PassengerRidesTransit VALUES(1,10001);
    INSERT INTO PassengerRidesTransit VALUES(2,10001);
    INSERT INTO PassengerRidesTransit VALUES(3,10002);
    INSERT INTO PassengerRidesTransit VALUES(4,10003);
    INSERT INTO PassengerRidesTransit VALUES(5,10004);
    INSERT INTO PassengerRidesTransit VALUES(6,10005);
    INSERT INTO PassengerRidesTransit VALUES(7,10005);
    INSERT INTO PassengerRidesTransit VALUES(8,10005);
    INSERT INTO PassengerRidesTransit VALUES(9,10006);
    INSERT INTO PassengerRidesTransit VALUES(1,10002);
    INSERT INTO PassengerRidesTransit VALUES(1,10003);
    INSERT INTO PassengerRidesTransit VALUES(1,10004);
    INSERT INTO PassengerRidesTransit VALUES(1,10005);
    INSERT INTO PassengerRidesTransit VALUES(1,10006);
    INSERT INTO PassengerRidesTransit VALUES(1,10007);
    INSERT INTO PassengerRidesTransit VALUES(1,10008);
    INSERT INTO PassengerRidesTransit VALUES(1,10009);
    INSERT INTO PassengerRidesTransit VALUES(1,10010);
    INSERT INTO PassengerRidesTransit VALUES(1,10011);
    
    
    INSERT INTO TransitBus VALUES(10001, 'B123-C321');
    INSERT INTO TransitBus VALUES(10002, 'A132-B543');
    INSERT INTO TransitBus VALUES(10003, 'D134-C321');
    INSERT INTO TransitBus VALUES(10004, 'E213-D323');
    INSERT INTO TransitBus VALUES(10008, 'A231-C321');
    INSERT INTO TransitBus VALUES(10009, 'F333-G210');
    INSERT INTO TransitBus VALUES(10010, 'L123-P621');
    INSERT INTO TransitBus VALUES(10011, 'S033-C001');
    
    INSERT INTO TransitTrain VALUES(10005, 'R21', 8);
    INSERT INTO TransitTrain VALUES(10006, 'R15', 7);
    INSERT INTO TransitTrain VALUES(10007, 'R09', 9);
    
    INSERT INTO TransitTakesRoute VALUES('Route_P231', 10001);
    INSERT INTO TransitTakesRoute VALUES('Route_P231', 10002);
    INSERT INTO TransitTakesRoute VALUES('Route_P413', 10003);
    INSERT INTO TransitTakesRoute VALUES('Route_P001', 10004);
    INSERT INTO TransitTakesRoute VALUES('Route_P111', 10008);
    INSERT INTO TransitTakesRoute VALUES('Route_P342', 10009);
    INSERT INTO TransitTakesRoute VALUES('Route_P111', 10010);
    INSERT INTO TransitTakesRoute VALUES('Route_P111', 10011);
    INSERT INTO TransitTakesRoute VALUES('T_Route_P123', 10005);
    INSERT INTO TransitTakesRoute VALUES('T_Route_P123', 10006);
    INSERT INTO TransitTakesRoute VALUES('T_Route_P123', 10007);
    
    INSERT INTO RouteHasStop VALUES(100001, 'Route_P231');
    INSERT INTO RouteHasStop VALUES(100002, 'Route_P231');
    INSERT INTO RouteHasStop VALUES(100003, 'Route_P413');
    INSERT INTO RouteHasStop VALUES(100004, 'Route_P413');
    INSERT INTO RouteHasStop VALUES(100005, 'Route_P001');
    INSERT INTO RouteHasStop VALUES(100006, 'Route_P001');
    INSERT INTO RouteHasStop VALUES(100007, 'Route_P111');
    INSERT INTO RouteHasStop VALUES(100008, 'Route_P111');
    INSERT INTO RouteHasStop VALUES(100009, 'Route_P342');
    INSERT INTO RouteHasStop VALUES(100010, 'Route_P342');
    INSERT INTO RouteHasStop VALUES(100011, 'T_Route_P123');
    INSERT INTO RouteHasStop VALUES(100012, 'T_Route_P123');
    
    INSERT INTO Route_isTransferable VALUES('Route_P231', 'Route_P001');
    INSERT INTO Route_IsTransferable VALUES('Route_P111', 'Route_P001');
    INSERT INTO Route_IsTransferable VALUES('Route_P111', 'Route_P413');
    
    ";

    $conn = createDBConnection();

    $result = $conn->query("CREATE DATABASE IF NOT EXISTS $dbname;");
    $result = $conn->query("USE $dbname;");
	$result = $conn->multi_query($query);

    $conn->close();
}

initialize_populate_db()

?>