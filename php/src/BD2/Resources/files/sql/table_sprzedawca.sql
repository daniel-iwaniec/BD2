CREATE TABLE sprzedawca (
  id            INTEGER       NOT NULL,
  stanowisko_id INTEGER,
  imie          VARCHAR2(200) NOT NULL,
  nazwisko      VARCHAR2(200) NOT NULL,

  CONSTRAINT sprzedawca_pk            PRIMARY KEY (id),
  CONSTRAINT sprzedawca_stanowisko_fk FOREIGN KEY (stanowisko_id) REFERENCES stanowisko (id)
);