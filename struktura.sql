DROP TABLE branza;
CREATE TABLE branza(
   ID INTEGER NOT NULL,
   nazwa VARCHAR2(20) NOT NULL,
   CONSTRAINT branza_pk PRIMARY KEY(ID)
);

drop TABLE klient
CREATE TABLE klient(
  ID INTEGER NOT NULL,
  branza_ID INTEGER,
  nazwa VARCHAR2(20) NOT NULL,
  CONSTRAINT klient_pk PRIMARY KEY(ID),
  CONSTRAINT klient_branza_fk FOREIGN KEY(branza_ID) REFERENCES branza(ID)
);



DROP TABLE stanowisko;
CREATE TABLE stanowisko(
   ID INTEGER NOT NULL,
   nazwa VARCHAR2(20) NOT NULL,
   CONSTRAINT stanowisko_pk PRIMARY KEY(ID)
);

DROP TABLE sprzedawca;
CREATE TABLE sprzedawca(
  ID INTEGER NOT NULL,
  stanowisko_ID INTEGER,
  imie VARCHAR2(20) NOT NULL,
  nazwisko VARCHAR2(20) NOT NULL,
  CONSTRAINT sprzedawca_pk PRIMARY KEY(ID),
  CONSTRAINT sprzedawca_stanowisko_fk FOREIGN KEY(stanowisko_ID) REFERENCES stanowisko(ID)
);

DROP TABLE dzien
CREATE TABLE dzien(
  ID INTEGER NOT NULL,
  dzien INTEGER,
  CONSTRAINT dzien_pk PRIMARY KEY(ID)
);

DROP TABLE miesiac;
CREATE TABLE miesiac(
  ID INTEGER NOT NULL,
  dzien_ID INTEGER,
  miesiac INTEGER NOT NULL,
  CONSTRAINT miesiac_pk PRIMARY KEY(ID),
  CONSTRAINT miesiac_dzien_fk FOREIGN KEY(dzien_ID) REFERENCES dzien(ID)
);

  DROP TABLE rok
  CREATE TABLE rok(
  ID INTEGER NOT NULL,
  miesiac_ID INTEGER,
  rok INTEGER,
  CONSTRAINT rok_pk PRIMARY KEY(ID),
  CONSTRAINT rok_miesiac_fk FOREIGN KEY(miesiac_ID) REFERENCES miesiac(ID)
);

  DROP TABLE data_sprzedazy
  CREATE TABLE data_sprzedazy(
  ID INTEGER NOT NULL,
  rok_ID INTEGER,
  czy_dzien_wolny INTEGER,
  CONSTRAINT data_sprzedazy_pk PRIMARY KEY(ID),
  CONSTRAINT data_sprzedazy_rok_fk FOREIGN KEY(rok_ID) REFERENCES rok(ID)

);



DROP TABLE sprzedaz;
CREATE TABLE sprzedaz(
  ID INTEGER NOT NULL,
  klient_ID INTEGER,
  sprzedawca_ID INTEGER,
  data_sprzedazy_ID INTEGER,
  ilo�� NUMERIC,
  warto�� FLOAT(1),
  CONSTRAINT sprzedaz_pk PRIMARY KEY(ID),
  CONSTRAINT sprzedaz_klient_fk FOREIGN KEY(klient_ID) REFERENCES sprzedaz(ID),
  CONSTRAINT sprzedaz_sprzedawca_fk FOREIGN KEY(sprzedawca_ID) REFERENCES sprzedaz(ID),
  CONSTRAINT sprzedaz_data_sprzedazy_fk FOREIGN KEY(data_sprzedazy_ID) REFERENCES data_sprzedazy(ID)

);

insert into branza (ID ,nazwa) values (1,'Castorama');
insert into klient (ID ,nazwa) values (1,'Solowow');

SELECT* FROM klient;
