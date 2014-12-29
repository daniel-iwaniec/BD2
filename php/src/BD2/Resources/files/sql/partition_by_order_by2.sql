SELECT s.lokalizacja_id, s.produkt_id, s.wartosc,
RANK() over (PARTITION BY s.lokalizacja_id ORDER BY s.wartosc DESC) AS "RANKING",
DENSE_RANK() over (PARTITION BY s.lokalizacja_id ORDER BY s.wartosc DESC) AS "DENSE_RANKING",
ROW_NUMBER() over (PARTITION BY s.lokalizacja_id ORDER BY s.wartosc DESC) AS "ROW_NUMBER"
FROM sprzedaz s
ORDER BY s.lokalizacja_id, "DENSE_RANKING";