--Clearance2Q
SELECT R.RID
    FROM Replika R, Task1 T, Location1 L
    INNER JOIN Task1 T ON R.Clearance >= T.Clearance
    INNER JOIN Location1 L ON  T.LID = L.LID AND R.Clearance >= L.Clearance_Level
        WHERE T.TID=9999 
        AND R.Assigned IS NULL;