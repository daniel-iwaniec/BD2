CREATE TABLE lokalizacja (
  id           INTEGER       NOT NULL,
  miasto_id    INTEGER       NOT NULL,
  ulica        VARCHAR2(200) NOT NULL,
  kod_pocztowy VARCHAR2(200) NOT NULL,

  CONSTRAINT lokalizacja_pk        PRIMARY KEY (id),
  CONSTRAINT lokalizacja_miasto_fk FOREIGN KEY (miasto_id) REFERENCES miasto (id)
);