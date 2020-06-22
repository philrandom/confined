# Confined
An online course web platform developped for a school project
  
## installation

### Server
please use `SSL` connexion, all commits are passed through `post` method
#### Apache
for `apache` use `.htaccess` :
```
ErrorDocument 404 /index.php
```
#### Nginx
or for `nginx`:
```
error_page  404  /index.php;
```
### PHP

in `php.ini` :

```
php_value post_max_size 100M
```
(100M as on github)

### Config

see configuration in 
```
/etc/sql.php
/etc/file_dispatcher/config.php
```

### SQL env

run scripts in this order :
```
user.sql
file_ref.sql
tag.sql
qcm.sql
score.sql
```
