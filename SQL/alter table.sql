USE db_rzherebilov;
    ALTER TABLE Replika
        ADD Nickname Char(20);
/* CREATE TABLE TASK1
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
ALTER TABLE Replika
 
    ADD FOREIGN KEY (Assigned)  
        REFERENCES TASK1(TID) ON DELETE SET NULL, 
    ADD FOREIGN KEY (Reports_To)
        REFERENCES Replika(RID), 
    ADD FOREIGN KEY (M_ID)
        REFERENCES Model(M_ID),
    ADD FOREIGN KEY (Inhabits)
        REFERENCES Location1(LID);  
ALTER TABLE TASK1 
    ADD FOREIGN KEY (LID) 
        REFERENCES Location1(LID),
    ADD FOREIGN KEY (Requested_By) 
        REFERENCES Replika(RID); */