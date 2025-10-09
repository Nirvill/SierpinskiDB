USE db_rzherebilov;
SELECT L.LID as LID, L.Location_Name AS Name, 'Replika' AS Type, COUNT(R.RID) AS Current, L.Capacity AS Max
    FROM Location1 L 
    LEFT JOIN Replika R ON L.LID = R.Inhabits
    WHERE L.Department = 'Living Quarters'
    GROUP BY L.LID 
        HAVING COUNT(R.RID) < L.Capacity

UNION ALL 

SELECT L.LID as LID, L.Location_Name AS Name, 'Gestalt' AS Type, COUNT(G.GID) AS Current, L.Capacity AS Max
    FROM Location1 L 
    LEFT JOIN Gestalt G ON L.LID = G.Inhabits
    WHERE L.Department = 'Living Quarters'
    GROUP BY L.LID 
        HAVING COUNT(G.GID) < L.Capacity;