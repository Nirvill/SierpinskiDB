USE db_rzherebilov;
SELECT R.ReportID
    FROM TASK1 T
    INNER JOIN Report R ON T.TID = R.TID
        WHERE R.TID = 5;  