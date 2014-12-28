LOAD DATA
CHARACTERSET UTF8
INFILE 'data_sprzedazy.csv'
INSERT INTO TABLE data_sprzedazy
FIELDS TERMINATED BY ","
(id,miesiac_id,numer_miesiac,numer_tydzien,nazwa,czy_dzien_roboczy)