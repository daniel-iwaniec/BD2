CREATE TABLE produkt (
  id             INTEGER       NOT NULL,
  produkt_typ_id INTEGER       NOT NULL,
  nazwa          VARCHAR2(200) NOT NULL,

  CONSTRAINT produkt_pk             PRIMARY KEY (id),
  CONSTRAINT produkt_produkt_typ_fk FOREIGN KEY (produkt_typ_id) REFERENCES produkt_typ (id)
);