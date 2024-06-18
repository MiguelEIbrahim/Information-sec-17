CREATE TABLE Pokes (
    Bohemian_ID INT,  -- references Bohemian table ID
    Yondora_Name VARCHAR(550), -- references Yondora Name
    FOREIGN KEY (Bohemian_ID) REFERENCES Bohemian(ID),
    FOREIGN KEY (Yondora_Name) REFERENCES Yondora(Name)
);