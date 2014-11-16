LOAD DATA
CHARACTERSET UTF8
INFILE 'miesiac.csv'
INSERT INTO TABLE miesiac
FIELDS TERMINATED BY ","
(id, rok_id, numer, nazwa)