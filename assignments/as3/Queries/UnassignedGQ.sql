USE db_rzherebilov;
SELECT T.TID
    FROM TASK1 T
    LEFT JOIN Replika R ON T.TID = R.Assigned
    GROUP BY T.TID 
        HAVING COUNT(R.RID) = 0;