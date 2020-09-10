FROM ubuntu:14.04
RUN apt-get update && apt-get -y install nano git apache2 mysql-server php5-mysql php5 libapache2-mod-php5
COPY ritsoftv2/ /var/www/html/ritsoftv2/
COPY ritsoft.sql /
COPY create-and-grant.sql /
COPY startup.sh /
CMD chmod +x startup.sh && ./startup.sh && /bin/bash
