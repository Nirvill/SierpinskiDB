
CREATE TABLE Replika 
(
    RID INTEGER NOT NULL,
    Clearance INTEGER,
    Legal_Name CHAR(30),
    Arrival_Date DATE,
    Assigned INTEGER,
    Reports_To INTEGER,
    Current_Role Char(30),
    M_ID INTEGER,
    PRIMARY KEY (RID),
    FOREIGN KEY (Assigned) 
        REFERENCES Task(TID) ON DELETE SET NULL,
    FOREIGN KEY (Reports_To)
        REFERENCES Replika(RID)
)
CREATE TABLE Model
(
    M_ID INTEGER,
    -- Model ID
    Model_Name TEXT,
    Height INTEGER,
    Model_Description TEXT,
    Known_Issues Text,

    PRIMARY KEY (M_ID)

)
CREATE TABLE Gestalt -- Human
(
    GID INTEGER,
    -- Gestalt ID
    End_Of_Sentence DATE,
    Gender CHAR(15),
    Assigned INTEGER,
    -- Task ID
    Reports_To INTEGER,

    PRIMARY KEY (GID),

    FOREIGN KEY (Assigned)
        REFERENCES Task(TID) ON DELETE SET NULL,

    FOREIGN KEY (Reports_To)
        REFERENCES Replika(RID)
)

CREATE TABLE Task
(
    TID INTEGER,
    -- Task ID
    LID INTEGER,
    -- Location ID
    Clearance INTEGER CHECK (Clearance > -1 AND Clearance < 4),
    Request_Date DATE,
    Urgency INTEGER,
    Task_Status CHAR(15),
    Requested_By INTEGER,


    PRIMARY KEY (TID),
    FOREIGN KEY (LID) 
        REFERENCES Location,
    FOREIGN KEY (Requested_By) 
        REFERENCES Gestalt(GID)

)
CREATE TABLE Delivery
(
    DID INTEGER,
    --Delivery ID
    DeadlINTEGER DATE,
    IID INTEGER,
    -- Item ID
    LID INTEGER,
    -- to location with ID
    TID INTEGER NOT NULL,
    PRIMARY KEY (DID),

    FOREIGN KEY (IID)
        REFERENCES Item,

    FOREIGN KEY (LID)
        REFERENCES Location,
    FOREIGN KEY (TID)
        REFERENCES Task
)
CREATE TABLE Operation
(
    OID INTEGER,
    -- Operation ID
    Start_Date DATE,
    End_Date DATE,
    CHECK (Start_Date < End_Date),
    TID INTEGER NOT NULL,


    PRIMARY KEY (OID),
    FOREIGN KEY (TID)
        REFERENCES Task

)
CREATE TABLE Location
(
    LID INTEGER,
    Capacity INTEGER,
    Department CHAR(20),
    Clearance_Level INTEGER CHECK (Clearance_Level > -1 AND Clearance_Level < 4)

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