Take terminal and give the following
------------------------------------

cd ritsoft
sudo docker build -t ritsoft .
sudo docker run -it -p 81:80 --name ritsoftv2 ritsoft
(You may use any suitable port number, but also use the same below)

Then open the browser and give 127.0.0.1:81/ritsoftv2

For subsequent executions, you can give

sudo docker container start -i -a ritsoftv2

Database details
****************

root password - nil (blank)

username - ritsoftv2
password - ritsoftv2
database - ritsoftv2

You can access the database through 
mysql -uroot ritsoftv2
or
mysql -uritsoftv2 -pritsoftv2 ritsoftv2
inside the container

or using browser
127.0.0.1:81/ritsoftv2/access.php

