# file_dispatcher
hierarchize of files by indexing them in db.  

```
/data/																						origine
	|-----098f6bcd4621d373cade4e832627b4f6/					name_of_the_file
							|--------1													version
							|--------2													version
```

DB will precise all the structure path

```
/section/cours/chapter/file
------------------------------------
/OS/linux/security/af98300	SELINUX
/OS/linux/security/be36544	firewall
/OS/linux/desktop/dea55321	gnome
/OS/linux/desktop/2323cce		kde
/OS/win_serv/web/95959614		IIS
/OS/win_serv/web/634aaaff		fast_cgi
```


section	|	cours	| chapter		| key	|	end |
--------|-------|-----------|-------|	---- |
OS			|	linux	|	security	|	af98300 |	SELINUX |
OS			|	linux	|	security	|	be36544 |	firewall |
OS|linux|security|be36544|firewall
OS|linux|desktop|dea55321|gnome
OS|linux|desktop|2323cce|kde
OS|win_serv|web|95959614|IIS
OS|win_serv|web|634aaaff|fast_cgi


key | id_author | actual_version | date_creation | id_last_contributor |
----|---------|----------------|------|----|
af98300 | 951 | 11 | 19/04/2020 | 456|
