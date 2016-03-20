#!/usr/bin/env bash
clear
echo "Start deploy? (y/n)"
read REPLY
if [ $REPLY = 'y' ]; then
  echo "deploy started..."
  git checkout master
  git pull origin master
  composer install
fi
echo "completed"

echo "You want created config? (y/n)"
read REPLY

if [ $REPLY = 'y' ]; then
  cp config/db.php.sample config/db.php
  nano config/db.php
  echo "Config created"
fi



