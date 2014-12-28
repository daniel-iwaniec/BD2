SELECT lokalizacja_id, produkt_id, SUM(ilosc), SUM(wartosc), SUM(rabat) FROM sprzedaz
GROUP BY grouping sets ((lokalizacja_id, produkt_id), (lokalizacja_id), (produkt_id), ());