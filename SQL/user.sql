USE db_rzherebilov;
/* CREATE TABLE User 
(
UID INTEGER, 
    Clearance INTEGER,
    CHECK (Clearance > -1 AND Clearance < 4),
    Username CHAR(10),
    RID INTEGER,
    FOREIGN KEY (RID) REFERENCES Replika(RID),

    PRIMARY KEY (UID)
); */
INSERT INTO `User` (`UID`,`Clearance`,`Username`,`RID`,`Pass`) VALUES
(1,3,"FLKR-S2301",2,"$2y$10$TYtf/2rWdonca3q7Uoxq9.4j2J9f5YMmx33asUimcBJatVbbNhNjO");