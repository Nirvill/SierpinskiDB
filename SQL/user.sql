USE db_rzherebilov;
CREATE TABLE USER 
(
UID INTEGER, 
    Clearance INTEGER,
    CHECK (Clearance > -1 AND Clearance < 4),
    Username CHAR(10),

    PRIMARY KEY (UID)
);