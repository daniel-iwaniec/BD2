DROP TABLE sprzedaz;
DROP TABLE klient;
DROP TABLE branza;
DROP TABLE data_sprzedazy;
DROP TABLE rok;
DROP TABLE miesiac;
DROP TABLE dzien;
DROP TABLE sprzedawca;
DROP TABLE stanowisko; 

CREATE TABLE branza (
   ID INTEGER NOT NULL,
   nazwa VARCHAR2(20) NOT NULL,
   CONSTRAINT branza_pk PRIMARY KEY(ID)
);

CREATE TABLE klient (
  ID INTEGER NOT NULL,
  branza_ID INTEGER,
  nazwa VARCHAR2(20) NOT NULL,
  CONSTRAINT klient_pk PRIMARY KEY(ID),
  CONSTRAINT klient_branza_fk FOREIGN KEY(branza_ID) REFERENCES branza(ID)
);

CREATE TABLE stanowisko (
   ID INTEGER NOT NULL,
   nazwa VARCHAR2(20) NOT NULL,
   CONSTRAINT stanowisko_pk PRIMARY KEY(ID)
);

CREATE TABLE sprzedawca (
  ID INTEGER NOT NULL,
  stanowisko_ID INTEGER,
  imie VARCHAR2(20) NOT NULL,
  nazwisko VARCHAR2(20) NOT NULL,
  CONSTRAINT sprzedawca_pk PRIMARY KEY(ID),
  CONSTRAINT sprzedawca_stanowisko_fk FOREIGN KEY(stanowisko_ID) REFERENCES stanowisko(ID)
);

CREATE TABLE dzien (
  ID INTEGER NOT NULL,
  dzien INTEGER,
  CONSTRAINT dzien_pk PRIMARY KEY(ID)
);

CREATE TABLE miesiac (
  ID INTEGER NOT NULL,
  dzien_ID INTEGER,
  miesiac INTEGER NOT NULL,
  CONSTRAINT miesiac_pk PRIMARY KEY(ID),
  CONSTRAINT miesiac_dzien_fk FOREIGN KEY(dzien_ID) REFERENCES dzien(ID)
);

CREATE TABLE rok (
  ID INTEGER NOT NULL,
  miesiac_ID INTEGER,
  rok INTEGER,
  CONSTRAINT rok_pk PRIMARY KEY(ID),
  CONSTRAINT rok_miesiac_fk FOREIGN KEY(miesiac_ID) REFERENCES miesiac(ID)
);

CREATE TABLE data_sprzedazy (
  ID INTEGER NOT NULL,
  rok_ID INTEGER,
  czy_dzien_wolny INTEGER,
  CONSTRAINT data_sprzedazy_pk PRIMARY KEY(ID),
  CONSTRAINT data_sprzedazy_rok_fk FOREIGN KEY(rok_ID) REFERENCES rok(ID)
);

CREATE TABLE sprzedaz (
  ID INTEGER NOT NULL,
  klient_ID INTEGER,
  sprzedawca_ID INTEGER,
  data_sprzedazy_ID INTEGER,
  ilosc NUMERIC(10),
  wartosc FLOAT(12),
  CONSTRAINT sprzedaz_pk PRIMARY KEY(ID),
  CONSTRAINT sprzedaz_klient_fk FOREIGN KEY (klient_ID) REFERENCES klient (ID),
  CONSTRAINT sprzedaz_sprzedawca_fk FOREIGN KEY (sprzedawca_ID) REFERENCES sprzedawca (ID),
  CONSTRAINT sprzedaz_data_sprzedazy_fk FOREIGN KEY (data_sprzedazy_ID) REFERENCES data_sprzedazy (ID)
);

