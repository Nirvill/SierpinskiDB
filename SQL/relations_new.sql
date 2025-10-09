USE db_rzherebilov;
CREATE TABLE Replika -- Andorids
(   
    RID INTEGER, 
    Clearance INTEGER,
    CHECK (Clearance > -1 AND Clearance < 4),
    Legal_Name CHAR(30),
    Inhabits INTEGER,
    Arrival_Date DATE,
    Assigned INTEGER,
    Reports_To INTEGER,
    CurrentRole Char(30),
    M_ID INTEGER,

    PRIMARY KEY (RID)
);

CREATE TABLE Model
(    
    M_ID INTEGER, -- Model ID
    Model_Code Char(4),
    Model_Name TEXT,
    Height INTEGER,
    Model_Description TEXT,
    Known_Issues Text,

    PRIMARY KEY (M_ID)

);

CREATE TABLE Gestalt -- Human
(
    GID INTEGER, -- Gestalt ID
    Inhabits INTEGER,
    End_Of_Sentence DATE,
    Gender CHAR(15),
    Assigned INTEGER, -- TASK1 ID
    Reports_To INTEGER,

    PRIMARY KEY (GID)

);

CREATE TABLE TASK1
(
    TID INTEGER, -- TASK1 ID
    LID INTEGER, -- Location1 ID
    Clearance INTEGER CHECK (Clearance > -1 AND Clearance < 4),
    Request_Date DATE,
    Urgency INTEGER,
    TASK1_Status CHAR(15),
    Requested_By INTEGER,
    

    PRIMARY KEY (TID)
);

CREATE TABLE Delivery
(
    DID INTEGER, -- Delivery ID
    Deadline DATE,
    IID INTEGER, -- Item ID
    LID INTEGER, -- to Location1 with ID
    TID INTEGER NOT NULL,
    PRIMARY KEY (DID)
);

CREATE TABLE Operation
(
    OID INTEGER, -- Operation ID
    Start_Date DATE,
    End_Date DATE,
    CHECK (Start_Date < End_Date),
    TID INTEGER NOT NULL,


    PRIMARY KEY (OID)
);

CREATE TABLE Location1
(
    LID INTEGER,
    Location_Name Char(30),
    Capacity INTEGER,
    Department CHAR(20),
    Clearance_Level INTEGER CHECK (Clearance_Level > -1 AND Clearance_Level < 4),
    PRIMARY KEY(LID)
);


CREATE TABLE Report
(
    ReportID INTEGER,
    RID INTEGER,
    TID INTEGER,
    Report_Contents TEXT,
    Report_Date DATE,

    PRIMARY KEY (ReportID)
);

CREATE TABLE Item
(
    IID INTEGER,
    LID INTEGER,
    Name TEXT,
    Item_Description TEXT,
    PRIMARY KEY (IID)
);

-- ADD FOREIGN KEYS
ALTER TABLE Replika
 
    ADD FOREIGN KEY (Assigned)  
        REFERENCES TASK1(TID) ON DELETE SET NULL, 
    ADD FOREIGN KEY (Reports_To)
        REFERENCES Replika(RID), 
    ADD FOREIGN KEY (M_ID)
        REFERENCES Model(M_ID),
    ADD FOREIGN KEY (Inhabits)
        REFERENCES Location1(LID);  
        
ALTER TABLE Gestalt 
    ADD FOREIGN KEY (Assigned)
        REFERENCES TASK1(TID) ON DELETE SET NULL,
    ADD FOREIGN KEY (Reports_To)
        REFERENCES Replika(RID),
    ADD FOREIGN KEY (Inhabits)
        REFERENCES Location1(LID);

ALTER TABLE TASK1 
    ADD FOREIGN KEY (LID) 
        REFERENCES Location1(LID),
    ADD FOREIGN KEY (Requested_By) 
        REFERENCES Replika(RID);
ALTER TABLE Operation 
    ADD FOREIGN KEY (TID)
        REFERENCES TASK1(TID);

ALTER TABLE Delivery 
    ADD FOREIGN KEY (IID)
        REFERENCES Item(IID),
    ADD FOREIGN KEY (LID)
        REFERENCES Location1(LID),
    ADD FOREIGN KEY (TID)
        REFERENCES TASK1(TID);

ALTER TABLE Report 
    ADD FOREIGN KEY (RID)
        REFERENCES Replika(RID),
    ADD FOREIGN KEY (TID)
        REFERENCES TASK1(TID);
        
ALTER TABLE Item 
    ADD FOREIGN KEY (LID)
        REFERENCES Location1(LID);