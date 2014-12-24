CREATE TABLE rok (
  id             INTEGER      NOT NULL,
  numer          INTEGER      NOT NULL,
  czy_przestepny NUMBER(1, 0) NOT NULL,

  CONSTRAINT rok_pk PRIMARY KEY (id)
);