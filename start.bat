@echo off
title Laravel Auto Starter with Ngrok Link

REM Check if the user provided a parameter
if "%~1"=="" (
    echo Usage: start.bat ^<ngrok-tcp-url^>
    echo Example: start.bat tcp://0.tcp.ap.ngrok.io:16858
    exit /b 1
)

REM Get the ngrok URL from the first argument
set NGROK_URL=%~1

REM Remove tcp:// prefix if present
set NGROK_URL=%NGROK_URL:tcp://=%

echo Ngrok URL = %NGROK_URL%

REM Split host and port
for /f "tokens=1,2 delims=:" %%a in ("%NGROK_URL%") do (
    set DB_HOST=%%a
    set DB_PORT=%%b
)

echo DB_HOST = %DB_HOST%
echo DB_PORT = %DB_PORT%

REM Set environment variables for this session
setx DB_HOST "%DB_HOST%" >nul
setx DB_PORT "%DB_PORT%" >nul

echo Environment variables set!

REM Start Laravel
php artisan serve
pause
