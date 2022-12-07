#!/bin/bash

# docker dynamic variables
SQL_ROOTPASS="ZT38pvp4fCj2Pj5Mf7E6yLhHr4CYcFyS"
SQL_DBPASS="Ez44hEcrc9gBQmet"
SQL_DBNAME="hitchTeeheeDB"
SQL_USER="hitchTeehee"
SQL_PORT=3306
PMA_PORT=8081
PORT=8080
HOST_NAME="hitch.teehee"
WS_PORT=8082

# bash script variables
PROD="docker-prod.yml"
DEV="docker-dev.yml"
MODEFILE=".MODE"
MODE="${1:-PROD}"

# create new random password on .env
cat > .env << EOM
SQL_ROOTPASS=${SQL_ROOTPASS}
SQL_DBPASS=${SQL_DBPASS}
SQL_DBNAME=${SQL_DBNAME}
SQL_USER=${SQL_USER}
SQL_PORT=${SQL_PORT}
PMA_PORT=${PMA_PORT}
PORT=${PORT}
HOST_NAME=${HOST_NAME}
WS_PORT=${WS_PORT}
EOM

# let owner know the password and port
cat << EOM
root cred:
  root:${SQL_ROOTPASS}
db cred:
  ${SQL_USER}:${SQL_DBPASS}
running at port:
  web: ${PORT}
  sql: ${SQL_PORT}
  pma: ${PMA_PORT}
EOM


# function to run and reset docker compose
function compose () {

  # create temp file to store mode
  TEMPMODE=$MODE
  [[ -f "$MODEFILE" ]] && TEMPMODE="$(cat $MODEFILE;)"

  docker-compose -f "$TEMPMODE" down
  echo "$MODE" > $MODEFILE
  docker-compose -f "$1" up
}

# function to move default files to host
function setupDB () {
  [[ -d "./db-data/" ]] && echo "db is ready" || cp -r ./default/db-data/ ./
}

echo "running docker in: ${MODE} mode"
YML="$PROD"
[[ "${MODE}" == "DEV" ]] && YML="$DEV"

compose "$YML"

