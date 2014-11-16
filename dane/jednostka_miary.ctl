LOAD DATA
CHARACTERSET UTF8
INFILE 'jednostka_miary.csv'
INSERT INTO TABLE jednostka_miary
FIELDS TERMINATED BY ","
(id,nazwa,symbol)