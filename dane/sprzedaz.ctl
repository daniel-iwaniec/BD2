LOAD DATA
CHARACTERSET UTF8
INFILE 'sprzedaz.csv'
INSERT INTO TABLE sprzedaz
FIELDS TERMINATED BY "," TRAILING NULLCOLS
(id,klient_id,sprzedawca_id,data_sprzedazy_id,produkt_id,lokalizacja_id,ilosc,wartosc)