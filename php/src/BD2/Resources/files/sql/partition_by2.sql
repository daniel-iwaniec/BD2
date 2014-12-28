SELECT b.id AS "BRANZA_ID", s.produkt_id, s.wartosc,
SUM(s.wartosc) OVER (PARTITION BY b.id) AS "WARTOSC_BRANZA",
CONCAT(ROUND(100 * (SUM(s.wartosc) OVER (PARTITION BY b.id) / SUM(s.wartosc) OVER ()), 2), '%') AS "UDZIAL %",
SUM(s.wartosc) OVER () AS "WARTOSC_CALOSC"
FROM sprzedaz s
JOIN klient k ON s.klient_id = k.id
JOIN branza b ON k.branza_id = b.id
ORDER BY b.id ASC, s.produkt_id ASC;