SELECT LOKALIZACJA_ID AS "lokalizacja", PRODUKT_ID AS "produkt", SUM_ILOSC, SUM_WARTOSC, SUM_RABAT FROM
  (
    SELECT lokalizacja_id, produkt_id, SUM(ilosc) AS "SUM_ILOSC", SUM(wartosc) AS "SUM_WARTOSC", SUM(rabat) AS "SUM_RABAT" FROM sprzedaz
    GROUP BY lokalizacja_id, produkt_id
    ORDER BY lokalizacja_id ASC, produkt_id ASC
  )
UNION ALL
SELECT LOKALIZACJA_ID AS "lokalizacja", NULL AS "produkt", SUM_ILOSC, SUM_WARTOSC, SUM_RABAT FROM
  (
    SELECT lokalizacja_id, SUM(ilosc) AS "SUM_ILOSC", SUM(wartosc) AS "SUM_WARTOSC", SUM(rabat) AS "SUM_RABAT" FROM sprzedaz
    GROUP BY lokalizacja_id
    ORDER BY lokalizacja_id ASC
  )
UNION ALL
SELECT NULL AS "lokalizacja", PRODUKT_ID AS "produkt", SUM_ILOSC, SUM_WARTOSC, SUM_RABAT FROM
  (
    SELECT produkt_id, SUM(ilosc) AS "SUM_ILOSC", SUM(wartosc) AS "SUM_WARTOSC", SUM(rabat) AS "SUM_RABAT" FROM sprzedaz
    GROUP BY produkt_id
    ORDER BY produkt_id ASC
  )
UNION ALL
SELECT NULL AS "lokalizacja", NULL AS "produkt", SUM_ILOSC, SUM_WARTOSC, SUM_RABAT FROM
  (
    SELECT SUM(ilosc) AS "SUM_ILOSC", SUM(wartosc) AS "SUM_WARTOSC", SUM(rabat) AS "SUM_RABAT" FROM sprzedaz
  )
;