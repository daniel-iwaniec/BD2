SELECT s.klient_id, s.produkt_id, pt.id AS "PRODUKT_TYP_ID", SUM(s.ilosc), SUM(s.wartosc), SUM(s.rabat) FROM sprzedaz s
JOIN produkt p ON s.produkt_id = p.id
JOIN produkt_typ pt ON p.produkt_typ_id = pt.id
GROUP BY rollup(s.klient_id, s.produkt_id, pt.id);