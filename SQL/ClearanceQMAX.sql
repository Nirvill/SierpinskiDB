USE db_rzherebilov;
SELECT R.Legal_Name AS Name, R.Clearance AS Clearance
FROM Replika R
WHERE R.Clearance = 
(
    SELECT MAX(Clearance)
    FROM Replika
);