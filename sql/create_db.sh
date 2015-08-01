#!/usr/bin/env bash


if [ -z "$HELP_ME_ROOT_DIR" ]; then 
    echo "HELP_ME_ROOT_DIR variable must be set to the root of the project."
    exit 1
fi
export SQL_DIR="$HELP_ME_ROOT_DIR/sql"
export DB_NAME="butt_sniffer"

# Create the data base first.
mysql -e "drop database if exists $DB_NAME" "$@"
mysql -e "create database if not exists $DB_NAME" "$@"

for sql_file in $SQL_DIR/*.sql; do
    echo "executing $sql_file"
    mysql "$@" $DB_NAME < $sql_file;
done



