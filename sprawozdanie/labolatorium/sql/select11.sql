SELECT produkt_id, klient_id, count(produkt_id) FROM sprzedaz
GROUP BY rollup(produkt_id, klient_id);

SELECT produkt_id, data_sprzedazy_id, sum(wartosc) FROM sprzedaz
GROUP BY cube (produkt_id, data_sprzedazy_id);

SELECT k.nazwa, b.nazwa AS "BRANZA", concat(m.nazwa, r.numer) AS "Data Sprzedazy", srednia FROM
(
SELECT s.klient_id AS klient, b.id AS branzaid, s.data_sprzedazy_id AS data, Round(Avg(s.ilosc)) AS srednia FROM sprzedaz s
JOIN klient k ON s.klient_id = k.id
JOIN branza b ON k.branza_id = b.id
JOIN data_sprzedazy d ON s.data_sprzedazy_id = d.id
group BY GROUPing sets (s.klient_id,b.id,s.data_sprzedazy_id)
) query1

LEFT JOIN branza b ON query1.branzaid = b.id
LEFT JOIN klient k ON query1.klient = k.id
left JOIN data_sprzedazy d ON query1.data = d.id
left JOIN miesiac m ON d.miesiac_id = m.id
left JOIN rok r ON m.rok_id = r.id;

select sprzedawca_id, produkt_id, ilosc,
sum(ilosc) over (partition by sprzedawca_id)
sum_ilosc, round(100*ilosc/sum(ilosc) OVER (PARTITION BY sprzedawca_id))  "udzial%"
from sprzedaz
order by sprzedawca_id, produkt_id;




SELECT r.numer AS rok,m.nazwa AS miesiac, wartosc_all FROM
(
SELECT data_sprzedazy_id,sum(wartosc) over (partition by r.numer order by d.id range between unbounded preceding and current row)
AS wartosc_all
from sprzedaz s
JOIN data_sprzedazy d ON s.data_sprzedazy_id = d.id
JOIN miesiac m ON d.miesiac_id = m.id
JOIN rok r ON m.rok_id = r.id

)query2
left JOIN data_sprzedazy d ON query2.data_sprzedazy_id = d.id
left JOIN miesiac m ON d.miesiac_id = m.id
left JOIN rok r ON m.rok_id = r.id
GROUP BY r.numer, m.nazwa,wartosc_all;



select sprzedawca_id, produkt_id, wartosc,
rank() over (partition by sprzedawca_id order by wartosc desc) as rank,
dense_rank() over (partition by sprzedawca_id order by wartosc desc) as
dense_rank
from sprzedaz
order by sprzedawca_id, produkt_id;





