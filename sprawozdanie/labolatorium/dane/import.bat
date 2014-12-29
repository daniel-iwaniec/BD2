@echo off
chcp 65001>nul

set /P login=Podaj login || set login=
if [%login%] == [] goto :error

set /P password=Podaj hasło || set password=
if [%password%] == [] goto :error

echo.
echo.
echo %ESC%[30;48;5;118m Import danych za pomocą SQL*Loader'a do tabeli ROK %ESC%[0m
sqlldr userid=%login%/%password% control=rok.ctl log=rok.log

echo.
echo.
echo %ESC%[30;48;5;118m Import danych za pomocą SQL*Loader'a do tabeli MIESIAC %ESC%[0m
sqlldr userid=%login%/%password% control=miesiac.ctl log=miesiac.log

echo.
echo.
echo %ESC%[30;48;5;118m Import danych za pomocą SQL*Loader'a do tabeli DATA_SPRZEDAZY %ESC%[0m
sqlldr userid=%login%/%password% control=data_sprzedazy.ctl log=data_sprzedazy.log

echo.
echo.
echo %ESC%[30;48;5;118m Import danych za pomocą SQL*Loader'a do tabeli BRANZA %ESC%[0m
sqlldr userid=%login%/%password% control=branza.ctl log=branza.log

echo.
echo.
echo %ESC%[30;48;5;118m Import danych za pomocą SQL*Loader'a do tabeli KLIENT %ESC%[0m
sqlldr userid=%login%/%password% control=klient.ctl log=klient.log

echo.
echo.
echo %ESC%[30;48;5;118m Import danych za pomocą SQL*Loader'a do tabeli STANOWISKO %ESC%[0m
sqlldr userid=%login%/%password% control=stanowisko.ctl log=stanowisko.log

echo.
echo.
echo %ESC%[30;48;5;118m Import danych za pomocą SQL*Loader'a do tabeli SPRZEDAWCA %ESC%[0m
sqlldr userid=%login%/%password% control=sprzedawca.ctl log=sprzedawca.log

echo.
echo.
echo %ESC%[30;48;5;118m Import danych za pomocą SQL*Loader'a do tabeli PRODUKT_TYP %ESC%[0m
sqlldr userid=%login%/%password% control=produkt_typ.ctl log=produkt_typ.log

echo.
echo.
echo %ESC%[30;48;5;118m Import danych za pomocą SQL*Loader'a do tabeli PRODUKT %ESC%[0m
sqlldr userid=%login%/%password% control=produkt.ctl log=produkt.log

echo.
echo.
echo %ESC%[30;48;5;118m Import danych za pomocą SQL*Loader'a do tabeli SPRZEDAZ %ESC%[0m
sqlldr userid=%login%/%password% control=sprzedaz.ctl log=sprzedaz.log

goto:eof
:error
echo %ESC%[30;48;5;196m Musisz podać dane dostępowe %ESC%[0m