CREATE TABLE miasto (
  id             INTEGER       NOT NULL,
  wojewodztwo_id INTEGER       NOT NULL,
  nazwa          VARCHAR2(200) NOT NULL,

  CONSTRAINT miasto_pk             PRIMARY KEY (id),
  CONSTRAINT miasto_wojewodztwo_fk FOREIGN KEY (wojewodztwo_id) REFERENCES wojewodztwo (id)
);