LOAD DATA
CHARACTERSET UTF8
INFILE 'produkt.csv'
INSERT INTO TABLE produkt
FIELDS TERMINATED BY ","
(id,produkt_typ_id,nazwa)