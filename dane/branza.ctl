LOAD DATA
CHARACTERSET UTF8
INFILE 'branza.csv'
INSERT INTO TABLE branza
FIELDS TERMINATED BY ","
(id,nazwa)