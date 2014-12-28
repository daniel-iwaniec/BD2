LOAD DATA
CHARACTERSET UTF8
INFILE 'sprzedawca.csv'
INSERT INTO TABLE sprzedawca
FIELDS TERMINATED BY ","
(id,stanowisko_id,imie,nazwisko) 