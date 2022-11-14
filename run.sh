#!/bin/bash

# docker dynamic variables
SQL_ROOTPASS=$(head -c 24 /dev/random | base64)
SQL_DBPASS=$(head -c 12 /dev/random | base64)
SQL_DBNAME="hitchTeeheeDB"
SQL_USER="hitchTeehee"
SQL_PORT=3306
PMA_PORT=8081
PORT=8080
HOST_NAME="hitch.teehee"

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


echo "running docker in: ${MODE} mode"
YML="$PROD"
[[ "${MODE}" == "DEV" ]] && YML="$DEV"

compose "$YML"

