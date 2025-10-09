
CREATE TABLE Replika -- android
(   
    RID INTEGER,
    Clearance INTEGER CHECK (Clearance > -1 AND Clearance < 5),
    Legal_Name CHAR(30),
    Arrival_date DATE,
    TID INTEGER,
    ReportsToRID INTEGER,
    MID INTEGER,
    PRIMARY KEY (RID),
    FOREIGN KEY (Assigned) 
        REFERENCES Task ON DELETE SET NULL,
    FOREIGN KEY (ReportsToRID)
        REFERENCES Replika(RID)
)
CREATE TABLE Model
(    
    MID INTEGER,
    Model_name VARCHAR(4) NOT NULL UNIQUE,
    Height INTEGER,
    Model_Description TEXT,
    Known_Issues Text,
    PRIMARY KEY (MID)

)
CREATE TABLE Gestalt -- human
(
    GID INTEGER,
    EOS DATE, -- end of sentence
    Gender CHAR(15),
    Inhabits INTEGER,
    TID INTEGER,
    PRIMARY KEY (GID),
    FOREIGN KEY (TID) 
        REFERENCES Task(TID) ON DELETE SET NULL
)

CREATE TABLE Task 
(
    TID INTEGER,
    LID INTEGER,
    Clearance INTEGER CHECK (Clearance > -1 AND Clearance < 5),
    Request_date DATE,
    Urgency INTEGER,
    Task_Status CHAR(15),
    GID INTEGER,
    --role ???                           ||||||||||||||||
    FOREIGN KEY (LID) 
        REFERENCES Location, --WHY ARE YOU BLUE
    FOREIGN KEY (GID) 
        REFERENCES Gestalt
)
CREATE TABLE Delivery
(
    DID INTEGER,
    Deadline DATE,
    IID INTEGER,
    LID INTEGER,
    PRIMARY KEY (DID),
    FOREIGN KEY (IID)
        REFERENCES Item,
    FOREIGN KEY (LID)
        REFERENCES Location
)
CREATE TABLE Operation
(
    OID INTEGER,
    Start_Date DATE,
    End_Date DATE,
    CHECK (Start_Date < End_Date),
    PRIMARY KEY (OID)

)
CREATE TABLE Location
(
    LID INTEGER,
    Capacity INTEGER,
    Department CHAR(20),
    Clearance_lvl INTEGER CHECK (Clearance_lvl > -1 AND Clearance_lvl < 5)

)
CREATE TABLE Report
(
    PID INTEGER,
    TID INTEGER,
    Report_Contents TEXT,
    Report_Date DATE,



    PRIMARY KEY (PID,TID),
    FOREIGN KEY (PID)
        REFERENCES Person,
    FOREIGN KEY (TID)
        REFERENCES Task
    

)
CREATE TABLE Item
(
    IID INTEGER,
    LID INTEGER,
    Name TEXT,
    Item_Description TEXT,
    FOREIGN KEY (LID)
        REFERENCES Location 
)