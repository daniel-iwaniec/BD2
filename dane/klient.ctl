LOAD DATA
CHARACTERSET UTF8
INFILE 'klient.csv'
INSERT INTO TABLE klient
FIELDS TERMINATED BY ","
(id,branza_id,nazwa)