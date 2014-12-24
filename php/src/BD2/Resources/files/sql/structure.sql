CREATE OR REPLACE PROCEDURE DROP_ALL IS
  CURSOR table_cursor IS
    SELECT object_name FROM user_objects WHERE object_type = 'TABLE';

  BEGIN
    FOR table_item IN table_cursor LOOP
      EXECUTE IMMEDIATE ('DROP TABLE ' || table_item.object_name || ' CASCADE CONSTRAINTS');
    END LOOP;

    EXCEPTION WHEN OTHERS THEN ROLLBACK;
  END;
/
EXECUTE DROP_ALL;
DROP PROCEDURE DROP_ALL;

CREATE TABLE branza (
  id    INTEGER       NOT NULL,
  nazwa VARCHAR2(200) NOT NULL,
  CONSTRAINT branza_pk PRIMARY KEY (id)
);

CREATE TABLE klient (
  id        INTEGER       NOT NULL,
  branza_id INTEGER,
  nazwa     VARCHAR2(200) NOT NULL,
  CONSTRAINT klient_pk        PRIMARY KEY (id),
  CONSTRAINT klient_branza_fk FOREIGN KEY (branza_id) REFERENCES branza (id)
);

CREATE TABLE stanowisko (
  id    INTEGER       NOT NULL,
  nazwa VARCHAR2(200) NOT NULL,
  CONSTRAINT stanowisko_pk PRIMARY KEY (id)
);

CREATE TABLE sprzedawca (
  id            INTEGER       NOT NULL,
  stanowisko_id INTEGER,
  imie          VARCHAR2(200) NOT NULL,
  nazwisko      VARCHAR2(200) NOT NULL,
  CONSTRAINT sprzedawca_pk            PRIMARY KEY (id),
  CONSTRAINT sprzedawca_stanowisko_fk FOREIGN KEY (stanowisko_id) REFERENCES stanowisko (id)
);

CREATE TABLE rok (
  id             INTEGER      NOT NULL,
  numer          INTEGER      NOT NULL,
  czy_przestepny NUMBER(1, 0) NOT NULL,
  CONSTRAINT rok_pk PRIMARY KEY (id)
);

CREATE TABLE miesiac (
  id     INTEGER      NOT NULL,
  rok_id INTEGER,
  numer  INTEGER      NOT NULL,
  nazwa  VARCHAR2(50) NOT NULL,
  CONSTRAINT miesiac_pk     PRIMARY KEY (id),
  CONSTRAINT miesiac_rok_fk FOREIGN KEY (rok_id) REFERENCES rok (id)
);

CREATE TABLE data_sprzedazy (
  id                INTEGER      NOT NULL,
  miesiac_id        INTEGER      NOT NULL,
  numer_miesiac     INTEGER      NOT NULL,
  numer_tydzien     INTEGER      NOT NULL,
  nazwa             VARCHAR2(50) NOT NULL,
  czy_dzien_roboczy NUMBER(1)    NOT NULL,
  CONSTRAINT data_sprzedazy_pk         PRIMARY KEY (id),
  CONSTRAINT data_sprzedazy_miesiac_fk FOREIGN KEY (miesiac_id) REFERENCES miesiac (id)
);

CREATE TABLE produkt_typ (
  id    INTEGER       NOT NULL,
  nazwa VARCHAR2(200) NOT NULL,
  CONSTRAINT produkt_typ_pk PRIMARY KEY (id)
);

CREATE TABLE produkt (
  id             INTEGER       NOT NULL,
  produkt_typ_id INTEGER       NOT NULL,
  nazwa          VARCHAR2(200) NOT NULL,
  CONSTRAINT produkt_pk             PRIMARY KEY (id),
  CONSTRAINT produkt_produkt_typ_fk FOREIGN KEY (produkt_typ_id) REFERENCES produkt_typ (id)
);

CREATE TABLE wojewodztwo (
  id    INTEGER       NOT NULL,
  nazwa VARCHAR2(200) NOT NULL,
  CONSTRAINT wojewodztwo_pk PRIMARY KEY (id)
);

CREATE TABLE miasto (
  id             INTEGER       NOT NULL,
  wojewodztwo_id INTEGER       NOT NULL,
  nazwa          VARCHAR2(200) NOT NULL,
  CONSTRAINT miasto_pk             PRIMARY KEY (id),
  CONSTRAINT miasto_wojewodztwo_fk FOREIGN KEY (wojewodztwo_id) REFERENCES wojewodztwo (id)
);

CREATE TABLE lokalizacja (
  id           INTEGER       NOT NULL,
  miasto_id    INTEGER       NOT NULL,
  ulica        VARCHAR2(200) NOT NULL,
  kod_pocztowy VARCHAR2(200) NOT NULL,
  CONSTRAINT lokalizacja_pk        PRIMARY KEY (id),
  CONSTRAINT lokalizacja_miasto_fk FOREIGN KEY (miasto_id) REFERENCES miasto (id)
);

CREATE TABLE sprzedaz (
  id                INTEGER           NOT NULL,
  klient_id         INTEGER           NOT NULL,
  sprzedawca_id     INTEGER           NOT NULL,
  data_sprzedazy_id INTEGER           NOT NULL,
  produkt_id        INTEGER           NOT NULL,
  lokalizacja_id    INTEGER           NOT NULL,
  ilosc             INTEGER           NOT NULL,
  wartosc           INTEGER           NOT NULL,
  rabat             INTEGER DEFAULT 0 NOT NULL,
  CONSTRAINT sprzedaz_pk                PRIMARY KEY (id),
  CONSTRAINT sprzedaz_klient_fk         FOREIGN KEY (klient_id)         REFERENCES klient (id),
  CONSTRAINT sprzedaz_sprzedawca_fk     FOREIGN KEY (sprzedawca_id)     REFERENCES sprzedawca (id),
  CONSTRAINT sprzedaz_data_sprzedazy_fk FOREIGN KEY (data_sprzedazy_id) REFERENCES data_sprzedazy (id),
  CONSTRAINT sprzedaz_produkt_fk        FOREIGN KEY (produkt_id)        REFERENCES produkt (id),
  CONSTRAINT sprzedaz_lokalizacja_fk    FOREIGN KEY (lokalizacja_id)    REFERENCES lokalizacja (id)
);