CREATE TABLE miesiac (
  id     INTEGER      NOT NULL,
  rok_id INTEGER      NOT NULL,
  numer  INTEGER      NOT NULL,
  nazwa  VARCHAR2(50) NOT NULL,

  CONSTRAINT miesiac_pk     PRIMARY KEY (id),
  CONSTRAINT miesiac_rok_fk FOREIGN KEY (rok_id) REFERENCES rok (id)
);