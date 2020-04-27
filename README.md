# confined
School Project

## Enoncé

cours :
  - liste
  - lecture
  - creation
  
QCM :
  - relié à chaque parties
  - AJAX
  - scores
  
Dashboard :
  - user progression
  - modification
  
## installation

for `apache` use `.htaccess` :
```
ErrorDocument 404 /index.php
```

or for `nginx`:
```
error_page  404  /index.php;
```

in `php.ini` :

```
php_value post_max_size 100M
```
(100M as on github)

see configuration in 
```
/etc/sql.php
/etc/file_dispatcher/config.php
```

run in this order :
```
user.sql
file_ref.sql
tag.sql
```
