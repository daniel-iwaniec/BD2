LOAD DATA
CHARACTERSET UTF8
INFILE 'sprzedaz.csv'
INSERT INTO TABLE sprzedaz
FIELDS TERMINATED BY ","
(id,klient_id,sprzedawca_id,data_sprzedazy_id,produkt_id,ilosc,wartosc)