@echo off
set /P login=Podaj login || set login=null
if "%login%"=="null" goto :error

set /P haslo=Podaj haslo || set haslo=null
if "%haslo%"=="null" goto :error

sqlldr userid=%login%/%haslo% control=rok.ctl log=rok.log
sqlldr userid=%login%/%haslo% control=miesiac.ctl log=miesiac.log
sqlldr userid=%login%/%haslo% control=data_sprzedazy.ctl log=data_sprzedazy.log
sqlldr userid=%login%/%haslo% control=branza.ctl log=branza.log
sqlldr userid=%login%/%haslo% control=klient.ctl log=klient.log
sqlldr userid=%login%/%haslo% control=wojewodztwo.ctl log=wojewodztwo.log
sqlldr userid=%login%/%haslo% control=miasto.ctl log=miasto.log
sqlldr userid=%login%/%haslo% control=lokalizacja.ctl log=lokalizacja.log
sqlldr userid=%login%/%haslo% control=stanowisko.ctl log=stanowisko.log
sqlldr userid=%login%/%haslo% control=sprzedawca.ctl log=sprzedawca.log
sqlldr userid=%login%/%haslo% control=produkt_typ.ctl log=produkt_typ.log
sqlldr userid=%login%/%haslo% control=produkt.ctl log=produkt.log
sqlldr userid=%login%/%haslo% control=sprzedaz.ctl log=sprzedaz.log

goto:eof
:error
echo Musisz podać dane