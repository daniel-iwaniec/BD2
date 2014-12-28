@echo off
chcp 65001>nul

set /P login=Podaj login || set login=
if [%login%] == [] goto :error

set /P password=Podaj hasło || set password=
if [%password%] == [] goto :error

sqlldr userid=%login%/%password% control=rok.ctl log=rok.log
sqlldr userid=%login%/%password% control=miesiac.ctl log=miesiac.log
sqlldr userid=%login%/%password% control=data_sprzedazy.ctl log=data_sprzedazy.log
sqlldr userid=%login%/%password% control=branza.ctl log=branza.log
sqlldr userid=%login%/%password% control=klient.ctl log=klient.log
sqlldr userid=%login%/%password% control=wojewodztwo.ctl log=wojewodztwo.log
sqlldr userid=%login%/%password% control=miasto.ctl log=miasto.log
sqlldr userid=%login%/%password% control=lokalizacja.ctl log=lokalizacja.log
sqlldr userid=%login%/%password% control=stanowisko.ctl log=stanowisko.log
sqlldr userid=%login%/%password% control=sprzedawca.ctl log=sprzedawca.log
sqlldr userid=%login%/%password% control=produkt_typ.ctl log=produkt_typ.log
sqlldr userid=%login%/%password% control=produkt.ctl log=produkt.log
sqlldr userid=%login%/%password% control=sprzedaz.ctl log=sprzedaz.log

goto:eof
:error
echo Musisz podać dane dostępowe