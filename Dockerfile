FROM ubuntu:14.04
RUN apt-get update && apt-get -y install nano git apache2 mysql-server php5-mysql php5 libapache2-mod-php5
COPY ritsoftv2/ /var/www/html/ritsoftv2/
COPY ritsoft.sql /
COPY create-and-grant.sql /
COPY startup.sh /
RUN apt-get -y install dos2unix
RUN dos2unix /startup.sh ritsoft.sql create-and-grant.sql
#RUN find /var/www/html/ritsoftv2/ -type f -print0 | xargs -0 dos2unix
CMD chmod +x startup.sh && ./startup.sh && /bin/bash
