CREATE TABLE klient (
  id        INTEGER       NOT NULL,
  branza_id INTEGER       NOT NULL,
  nazwa     VARCHAR2(200) NOT NULL,

  CONSTRAINT klient_pk        PRIMARY KEY (id),
  CONSTRAINT klient_branza_fk FOREIGN KEY (branza_id) REFERENCES branza (id)
);