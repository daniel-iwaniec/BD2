SELECT r.numer as "ROK", m.numer as "MIESIAC", s.wartosc,
SUM(s.wartosc) over (PARTITION BY r.id ORDER BY m.id RANGE BETWEEN CURRENT ROW AND CURRENT ROW) AS "SUMA_MIESIAC",
SUM(s.wartosc) over (PARTITION BY r.id ORDER BY m.id RANGE BETWEEN UNBOUNDED PRECEDING AND CURRENT ROW) AS "SUMA_ROK"
FROM sprzedaz s
JOIN data_sprzedazy ds ON s.data_sprzedazy_id = ds.id
JOIN miesiac m ON ds.miesiac_id = m.id
JOIN rok r ON m.rok_id = r.id
ORDER BY r.numer, m.numer;