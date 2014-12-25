SELECT produkt_id, klient_id, count(produkt_id) FROM sprzedaz
GROUP BY rollup(produkt_id, klient_id);

SELECT produkt_id, lokalizacja_id, sum(wartosc) FROM sprzedaz
GROUP BY cube (produkt_id, lokalizacja_id);

