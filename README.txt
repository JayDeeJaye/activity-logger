ActivityTracker 1.0 16 December 2015

CONTENTS OF THIS FILE
---------------------
   
 * Introduction
 * Requirements and Notes
 * Installation
 


INTRODUCTION
------------

ActivityTracker is a web application for tracking time spent in all kinds of
activities. The goal of ActivityTracker is to allow teams and individuals to
log and report on how they are dividing their time across multiple and sometimes
competing tasks. When used as a diary of time spent, ActivityTracker can help
teams and individuals improve productivity and prioritize work.

ActivityTracker is a term project for CSC 535 Software Engineering. Our team members
are

* Udeme Ekpo
* Julianne Johnson
* Amit Vyas



REQUIREMENTS AND NOTES
----------------------

ActivityTracker is a PHP and MySQL web application.

ActivityTracker requires:

- A web server. Apache (version 2.0 or greater) is recommended.
- PHP 5.5 (or greater) (http://www.php.net/).
- MySQL 5.0.15 (or greater) (http://www.mysql.com/).

If you are installing ActivityTracker on a hosted web server, 
please contact your provider for information on these requirements and how
to install new applications.

Note that all directories mentioned in this document are always relative to the
directory of your ActivityTracker installation, and commands are meant to 
be run from this directory (except for the initial commands that create 
that directory).



INSTALLATION
------------

1. Extract ActivityTracker.

    ActivityTracker is available as a tar archive and a zip archive.    
    To extract the files, on a typical Unix/Linux command line, use
    the following commands:

        tar -zxvf activitytracker.tar.gz

    This will create a new directory activitytracker/ containing all files and
    directories. Then, to move the contents of that directory into a directory
    within your web server's document root or your public HTML directory,
    continue with this command:
    
        mv activitytracker/* /path/to/your/installation

    On Windows, use the Explorer to extract the .zip file into your install
    directory.

2. Create the ActivityTracker database.

    In the following examples, 'username' is an example MySQL user
    which has the CREATE and GRANT privileges. Use the appropriate user name for
    your system.

    First, you must create a new database for ActivityTracker

      mysqladmin -u username -p create activity_tracker

    MySQL will prompt for the 'username' database password and then create the
    initial database files. Next you must log in and set the access database rights:

      mysql -u username -p

    Again, you will be asked for the 'username' database password. At the MySQL
    prompt, enter the following command:

      GRANT SELECT, INSERT, UPDATE, DELETE, CREATE
      ON activity_tracker.*
      TO 'username'@'localhost' IDENTIFIED BY 'password';

    where

     'username@localhost' is the username of your MySQL account
     'password' is the password required for that username

    Note: Unless your database user has all of the privileges listed above, you will
    not be able to run ActivityTracker.

    If successful, MySQL will reply with:

      Query OK, 0 rows affected
      
    Finally, run the database/ACTIVITY_TRACKER_db.sql script with the command
    
        SOURCE /path/to/your/installation/database/ACTIVITY_TRACKER_db.sql ;
        
    This script will create the tables needed by ActivityTracker.

3. Set your database connection information

    Edit connectvars.php and change the values of the following variables to 
    match your installation:
    
    DB_USER         - the user to which you granted privileges to the 
                      activity_tracker database
    DB_PASSWORD     - the password for DB_USER
    
4. Verify your installation

    Open a browser and navigate to the url you assigned to the ActivityTracker
    installation, e.g., http://www.example.com/activitytracker/
    
    If you do not see the launch page, check the web server logs for
    issues, resolve them, and try again.


