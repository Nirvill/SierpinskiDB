USE db_rzherebilov;
SELECT R.Legal_Name AS Name, 'Replika' AS Type, L.Location_Name AS Location
        FROM Replika R
        INNER JOIN Location1 L ON R.Inhabits = L.LID
        WHERE L.Location_Name LIKE '%STAR%'
 
        UNION ALL
 
        SELECT G.Legal_Name AS Name, 'Gestalt' AS Type, L.Location_Name As Location
        FROM Gestalt G
        INNER JOIN Location1 L ON G.Inhabits = L.LID
        WHERE L.Location_Name LIKE '%STAR%'
        ORDER BY Name;
