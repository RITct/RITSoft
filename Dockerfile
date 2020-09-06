FROM ubuntu:14.04
RUN apt-get update && apt-get -y install git apache2 mysql-server php5-mysql php5 libapache2-mod-php5
COPY ritsoftv2/ /var/www/html/ritsoftv2/

