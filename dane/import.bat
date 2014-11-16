@echo off
set /P login=Podaj login || set login=null
if "%login%"=="null" goto :error

set /P haslo=Podaj haslo || set haslo=null
if "%haslo%"=="null" goto :error

sqlldr userid=%login%/%haslo% control=rok.ctl log=rok.log
sqlldr userid=%login%/%haslo% control=miesiac.ctl log=miesiac.log
sqlldr userid=%login%/%haslo% control=data_sprzedazy.ctl log=data_sprzedazy.log
sqlldr userid=%login%/%haslo% control=branza.ctl log=branza.log

goto:eof
:error
echo Musisz podać dane