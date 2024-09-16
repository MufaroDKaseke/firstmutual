# First Mutual Health Portal


## Requirements

1. PHP min v7.6(e.g XAMPP) [click here to download XAMPP](https://www.apachefriends.org/download.html)
2. MySql Database (i.e included in XAMPP)
3. Sass compiler (i.e npm install -g sass)
4. Composer [click here to download](https://getcomposer.org/download/)


## Setting up

1. Open terminal in C:/xampp/htdocs/
2. Clone the repository `git clone  https://github.com/MufaroDKaseke/firstmutual.git`
3. Open firstmutual folder inside text editor




## Compiling Sass

### 1. Styles

`sass --watch src/scss/style.scss:dist/css/style.min.css src/scss/dashboard.scss:dist/css/dashboard.min.css --style=compressed`

### 2. Custom Bootstrap

`sass --watch src/scss/custom.scss:dist/css/bootstrap.min.css --style=compressed`


## Usertypes

- admin
- staff
- user

## Reminders

- Remember to safe load the ENV library in config.php

## Session Variables

- user_id
- user_type
- username
- email
- user_is_logged_in


## Libraries
- Bootstrap
- Fontawesome
- animate.css
- jquery
- vlucas/phpdotenv

## File Structure

```

├── app
│   ├── config
│   ├── controllers
│   ├── helper
│   ├── models
│   ├── services
│   ├── tests
├── dist
│   ├── css
│   ├── img
│   ├── js
│   ├── lib
├── src
│   ├── scss
├── node_modules
├── composer.json
├── composer.lock
├── package.json
├── package-lock.json
├── index.php
├── login.php
└── logout.php


```