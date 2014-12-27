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