
USE db_rzherebilov;
SELECT R.RID
    FROM Replika R
    INNER JOIN TASK1 T ON R.Clearance >= T.Clearance
    INNER JOIN Location1 L ON  T.LID = L.LID AND R.Clearance >= L.Clearance_Level
        WHERE T.TID=6
        AND R.Assigned IS NULL;