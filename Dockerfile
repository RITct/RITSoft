FROM ubuntu:14.04
RUN apt-get update && apt-get -y install git && apt-get -y install apache2 && apt-get -y install mysql-server && apt-get -y install php5-mysql && apt-get -y install php5 libapache2-mod-php5
COPY ritsoftv2/ /var/www/html/ritsoftv2/

