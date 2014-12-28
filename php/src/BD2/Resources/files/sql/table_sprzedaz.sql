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