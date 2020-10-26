# RITSoft

## Installation

- Docker

  You can find the instructions to install docker [here](https://docs.docker.com/engine/install/)

- Docker compose

  You can find instructions to install docker-compose [here](https://docs.docker.com/compose/install/)

## Getting Started

- Clone the repository

  ```bash
   git clone https://github.com/RITct/RITSoft --recurse-submodules
  ```

- Open the cloned repository folder in terminal

  ```bash
   cd RITSoft
  ```

- Start the server
  
  ```bash
  docker-compose up -d
  ```

  You can see the website at [localhost](http://localhost)

  Use the same command to reload the server after you have made changes to the docker-compose.yml.

  If you changed Dockerfile do

  ```bash
  docker-compose up -d --build
  ```

  to rebuild the image.

- To stop the server

  ```bash
  docker-compose down
  ```

## Database details

|Username|Password|Database|
|--------|--------|--------|
|ritsoftv2|ritsoftv2|ritsoftv2|

You can access the database

- at [localhost/access.php](http://localhost/access.php)

## RITSoft Login Details

You can see 'login' table to find the details of all users. Here are some guidelines to use the table.

- All students have Admission number as username

- All HoDs have "hod" followed by dept. name followed by "@somedomain.com".

- We have two sample faculty, one from MCA department and the other from Applied Science.

- administrator, admissionuser and officeuser are the other users.

- All users, except HoDs and faculty have username followed by "passwd" as
their password.

  ex: Student username and password
  - username: 15BA10451
  - password: 15BA10451passwd

The username and passwords of all non student users are given here.

| User | Password|
|------|---------|
|administrator|administratorpasswd|
admissionuser|admissionuserpasswd|
|hodarch@somedomain.com|hodarchpasswd|
|hodce@somedomain.com|hodcepasswd|
|hodcse@somedomain.com|hodcsepasswd|
|hodece@somedomain.com|hodecepasswd|
|hodeee@somedomain.com|hodeeepasswd|
|hodmathematics@somedomain.com|hodmathematicspasswd|
|hodmca@somedomain.com|hodmcapasswd|
|hodme@somedomain.com|hodmepasswd|
|officeuser|officeuserpasswd|
|faculty1@somedomain.com|faculty1passwd|
|faculty2@somedomain.com|faculty2passwd|

## User Guide

[Google Docs Link](https://docs.google.com/document/d/1IxwGnyp3-Usa7A1bgY1PJqLkj46pQ63hXa-4JT0jkXI/edit?usp=sharing)

## Contributing

To start contributing,

- Fork this repository.

  You will see a fork button top right of page.

- Look into the issues tab for open issues that interest you.

- Get an issue assigned to you.

- Start hacking!

- Make a pull request.
