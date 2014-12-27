SELECT s.sprzedawca_id, s.produkt_id, s.wartosc, SUM(s.wartosc) OVER (PARTITION BY s.sprzedawca_id) AS "WARTOSC_SPRZEDAWCA"
FROM sprzedaz s
ORDER BY s.sprzedawca_id ASC, s.produkt_id ASC;