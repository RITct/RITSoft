#! /bin/bash
service apache2 start
service mysql start
#sleep 2
mysql -uroot <  create-and-grant.sql
mysql -uritsoftv2 -pritsoftv2 ritsoftv2 < ritsoft.sql

