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