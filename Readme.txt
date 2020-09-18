Take terminal and give the following
------------------------------------

cd ritsoft
sudo docker build -t ritsoft .
sudo docker run -it -p 81:80 --name ritsoftv2 ritsoft
(You may use any suitable port number, but use the same below also)

Then open the browser and give 127.0.0.1:81/ritsoftv2

For subsequent executions, you can give

sudo docker container start -i -a ritsoftv2

You can exit from the container using 'exit' at the command prompt

When rebuilding the image, you have to first delete the existing container
   Ensure the container is exited
   sudo docker container rm ritsoftv2
   sudo docker build -t ritsoft .
   sudo docker run -it -p 81:80 --name ritsoftv2 ritsoft
   Rest as above

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


RITSoft Login Details
*********************

You can see 'login' table to find the details of all users. Here are some guidelines to use the table.
1. All students have Admission number as username
2. All HoDs have "hod" followed by dept. name followed by "@somedomain.com"
3. administrator, admissionuser and officeuser are the other users
4. All users, except HoDs have username followed by "passwd" as their password
5. The username and passwords of all non student users are given here.

administrator	administratorpasswd
admissionuser	admissionuserpasswd
hodarch@somedomain.com	hodarchpasswd
hodce@somedomain.com	hodcepasswd
hodcse@somedomain.com	hodcsepasswd
hodece@somedomain.com	hodecepasswd
hodeee@somedomain.com	hodeeepasswd
hodmathematics@somedomain.com	hodmathematicspasswd
hodmca@somedomain.com	hodmcapasswd
hodme@somedomain.com	hodmepasswd
officeuser	officeuserpasswd

Students have the format
15BA10451	15BA10451passwd

Happy Coding...!!
