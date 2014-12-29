--rollup1
SELECT lokalizacja_id, produkt_id, SUM(ilosc), SUM(wartosc), SUM(rabat) FROM sprzedaz
GROUP BY rollup(lokalizacja_id, produkt_id);

--rollup2
SELECT s.klient_id, s.produkt_id, pt.id AS "PRODUKT_TYP_ID", SUM(s.ilosc), SUM(s.wartosc), SUM(s.rabat) FROM sprzedaz s
JOIN produkt p ON s.produkt_id = p.id
JOIN produkt_typ pt ON p.produkt_typ_id = pt.id
GROUP BY rollup(s.klient_id, s.produkt_id, pt.id);

--cube1
SELECT b.id AS "BRANZA_ID", s.klient_id, s.produkt_id, SUM(s.ilosc), SUM(s.wartosc), SUM(s.rabat) FROM sprzedaz s
JOIN klient k ON s.klient_id = k.id
JOIN branza b ON k.branza_id = b.id
GROUP BY cube(b.id, s.klient_id, s.produkt_id);

--cube2
SELECT * FROM
  (
    SELECT lokalizacja_id, produkt_id, SUM(ilosc), SUM(wartosc), SUM(rabat) FROM sprzedaz
    GROUP BY cube(lokalizacja_id, produkt_id)
    ORDER BY lokalizacja_id ASC, produkt_id ASC
  )
WHERE lokalizacja_id IS NOT NULL AND produkt_id IS NOT NULL
UNION ALL
SELECT * FROM
  (
    SELECT lokalizacja_id, produkt_id, SUM(ilosc), SUM(wartosc), SUM(rabat) FROM sprzedaz
    GROUP BY cube(lokalizacja_id, produkt_id)
    ORDER BY lokalizacja_id ASC
  )
WHERE lokalizacja_id IS NOT NULL AND produkt_id IS NULL
UNION ALL
SELECT * FROM
  (
    SELECT lokalizacja_id, produkt_id, SUM(ilosc), SUM(wartosc), SUM(rabat) FROM sprzedaz
    GROUP BY cube(lokalizacja_id, produkt_id)
    ORDER BY produkt_id ASC
  )
WHERE lokalizacja_id IS NULL AND produkt_id IS NOT NULL
UNION ALL
SELECT * FROM
  (
    SELECT lokalizacja_id, produkt_id, SUM(ilosc), SUM(wartosc), SUM(rabat) FROM sprzedaz
    GROUP BY cube(lokalizacja_id, produkt_id)
  )
WHERE lokalizacja_id IS NULL AND produkt_id IS NULL;

--grouping_sets1
SELECT lokalizacja_id, produkt_id, SUM(ilosc), SUM(wartosc), SUM(rabat) FROM sprzedaz
GROUP BY grouping sets ((lokalizacja_id, produkt_id), (lokalizacja_id), (produkt_id), ());

--grouping_sets2
SELECT st.id AS "STANOWISKO_ID", s.sprzedawca_id, s.produkt_id, SUM(s.ilosc), SUM(s.wartosc), SUM(s.rabat) FROM sprzedaz s
JOIN sprzedawca sp ON s.sprzedawca_id = sp.id
JOIN stanowisko st ON sp.stanowisko_id = st.id
GROUP BY grouping sets ((st.id, s.sprzedawca_id, s.produkt_id), (st.id), (s.produkt_id));

--partition_by1
SELECT s.sprzedawca_id, s.produkt_id, s.wartosc, SUM(s.wartosc) OVER (PARTITION BY s.sprzedawca_id) AS "WARTOSC_SPRZEDAWCA"
FROM sprzedaz s
ORDER BY s.sprzedawca_id ASC, s.produkt_id ASC;

--partition_by2
SELECT b.id AS "BRANZA_ID", s.produkt_id, s.wartosc,
SUM(s.wartosc) OVER (PARTITION BY b.id) AS "WARTOSC_BRANZA",
CONCAT(ROUND(100 * (SUM(s.wartosc) OVER (PARTITION BY b.id) / SUM(s.wartosc) OVER ()), 2), '%') AS "UDZIAL %",
SUM(s.wartosc) OVER () AS "WARTOSC_CALOSC"
FROM sprzedaz s
JOIN klient k ON s.klient_id = k.id
JOIN branza b ON k.branza_id = b.id
ORDER BY b.id ASC, s.produkt_id ASC;

--partition_by_order_by1
SELECT r.numer as "ROK", m.numer as "MIESIAC", s.wartosc,
SUM(s.wartosc) over (PARTITION BY r.id ORDER BY m.id RANGE BETWEEN CURRENT ROW AND CURRENT ROW) AS "SUMA_MIESIAC",
SUM(s.wartosc) over (PARTITION BY r.id ORDER BY m.id RANGE BETWEEN UNBOUNDED PRECEDING AND CURRENT ROW) AS "SUMA_ROK"
FROM sprzedaz s
JOIN data_sprzedazy ds ON s.data_sprzedazy_id = ds.id
JOIN miesiac m ON ds.miesiac_id = m.id
JOIN rok r ON m.rok_id = r.id
ORDER BY r.numer, m.numer;

--partition_by_order_by2
SELECT s.lokalizacja_id, s.produkt_id, s.wartosc,
RANK() over (PARTITION BY s.lokalizacja_id ORDER BY s.wartosc DESC) AS "RANKING",
DENSE_RANK() over (PARTITION BY s.lokalizacja_id ORDER BY s.wartosc DESC) AS "DENSE_RANKING",
ROW_NUMBER() over (PARTITION BY s.lokalizacja_id ORDER BY s.wartosc DESC) AS "ROW_NUMBER"
FROM sprzedaz s
ORDER BY s.lokalizacja_id, "DENSE_RANKING";

--group_by_cube
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