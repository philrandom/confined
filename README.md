# Confined : An online-courses web hosting platform



This website is currently hosted at the following address : https://confined.site/

![frontpage](/assets/frontpage.PNG)

This website is an online-courses web hosting platform (LAMP stack).

There are two types of users : regular users and administrators.

Users can:
* Upload courses or new chapters of existing courses (The uploads are reviewed by admins before going live), with questionnaires to validate the courses.
* Search for courses, and validate them by completing their questionnaires (a questionnaire is validated if all your answers are right).
* Request commits to existing courses or chapters, which will be reviewed by admins.
* Attach files (images, documents) to a course to illustrate better (adding a thumbnail for the frontpage display is highly recommended).
* Track their progress on courses with the quizz validations.

Admins can:
* Read courses,
* Review requests from users and accept them,
* Have an access to the versions of every course/chapter uploaded with the course versionning system,
* Instantly publish and modify any course or chapter on the website,
* Add questionnaires, files, etc...
* Delete any course or chapter.

Non-users cannot upload or modify courses. Anyone can register as a user on the website and start uploading and modifying courses.


## Website architecture


The connexion to the website is done with the "index.php" file (default root). It is best to deny any http request to the php files of the website and redirect them to the root (the .htaccess file redirects every request to the root). The URLs are cleaned up. Navigating the website is done with the accessibility features : buttons, links, search bar...

The website is organized in an module/views style: 
* The module directory contains the backend code : courses files management, user connection/registeration, questionnaires checking, search engine.
* The views directory contains the visual web pages of the website : frontpage, courses viewing/editing views, user informations view (dashboard), course adding, connection/registeration.
The etc folder is used for server configuration.

The courses are stored in the data directory. They are identified by a unique MD5 hash code. Each hash code is a course/chapter identifier (two chapters of different courses can have the same name, but they will have a different hash code) keeping the information of the last author. For instance, the "OS/linux/file/1" (for the author which has the id "1") chapter has the corresponding hash code : "65988e4dff155fc2422f67dc957f8ee4", whereas the "java/memory/file/1" page has the corresponding hash code : "44ea542321a6489aebd9418208f4ce1f".
Depending on the etc configuration, the attachments are stored in an "attachement" folder or in each hash code directory.

The questionnaires are stored in the database in the "qcm" (multiple choice questionnaire) table. Each questionnaire is associated to an unique course hash code.
The "file_ref" table stores each version-author-file modification, and the "tag" table stores each tag occurence with its associated hash code (and tag weight).
The user info is stored in the "user" table, which is associated to the "score" table, storing each questionnaire score of the user to courses.


## Server-side installation


### Operating system

You can use any of your choice. We personally used Linux (LAMP stack).

### Web server setup

#### Apache
For `apache`, use the `.htaccess` file:
```
<IfModule mod_rewrite.c>
    ErrorDocument 404 /index.php
</IfModule>
```
#### Nginx
or for `nginx`:
```
error_page  404  /index.php;
```

### MySQL environnement setup

To set up your MySQL environnement, run the following scripts in order (in the backup_sql or assets/sql folder):
```
user.sql
file_ref.sql
tag.sql
qcm.sql
score.sql
```

### PHP setup

In your `php.ini` configuration file:

```
php_value post_max_size 100M
```
(100M as on github)

### Website architecture configuration

Tweak the environnement variables with the following files:
```
/etc/sql.php
/etc/file_dispatcher/config.php
```


## Licensing

This project is under Apache 2.0. Feel free to contribute, use it, and share it. We encourage you to contribute or host confined on your own server for educational purpose. Obviously due to the licence you could use it for free for any purpose. Keep in mind this product is delivered under AS-IS specification, wich means that we are not respondible for any disfunctionnement.
