SELECT COUNT(R.RID, G.GID)
    FROM Replikas R, Gestalts G, Location1 L
        WHERE R.Inhabits = G.Inhabits = L.LID = somelocationidk