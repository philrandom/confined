# file_dispatcher

It's a dynamic method of tagging and hierarchization


```
/OS/linux/network/socket.md
/C/network/socket.md
/python/django/socket.md
```

Then you can find all this courses by searching tag-name `socket`.
But if you want to search socket in C you could search by using tag `socket` `C`.

Now you are reading course of `C`. How to know the next chapter ? This module aims to classify with a tree view.

> It's user friendly, you can choose to navigate with tag or with tree view

## SQL view

Dosn't use LONGTEXT due to lack of performances.


### table : file_ref

| h_code | author | last_colab | v | date | active |
|--------|--------|------------|---|------|---|
|098f6bcd4621d373cade4e832627b4f6| 23 | 56 | 6 | 20/04/2020|true|
|098f6bcd4621d373cade4e832627b4f6| 23 | 47 | 5 | 20/04/2019|false|
|098f6bcd4621d373cade4e832627b4f6| 23 | 24 | 3 | 20/04/2019|false|
|098f6bcd4621d373cade4e832627b4f6| 23 | 23 | 2 | 20/04/2019|false|
|098f6bcd4621d373cade4e832627b4f6| 23 | 47 | 1 | 20/06/2018|false|
|098f6bcd4621d373cade4e832627b4f6| 23 | 23 | 0 | 19/06/2018|false|

### table : tag

| h_code | tag | weight |
|--------|--------|------------|
|098f6bcd4621d373cade4e832627b4f6| C | 1 |
|098f6bcd4621d373cade4e832627b4f6| network | 2 |
|098f6bcd4621d373cade4e832627b4f6| socket | 3 |
