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
ErrorDocument 404 /404.php
```

or for `nginx`:
```
error_page  404  /404.php;
```

in `php.ini` :

```
php_value post_max_size 20M
```
