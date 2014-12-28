LOAD DATA
CHARACTERSET UTF8
INFILE 'lokalizacja.csv'
INSERT INTO TABLE lokalizacja
FIELDS TERMINATED BY ","
(id,miasto_id,ulica,kod_pocztowy)