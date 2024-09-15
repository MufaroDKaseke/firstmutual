# First Mutual Health Portal


## Requirements

1. PHP server(e.g XAMPP)
2. MySql Database
3. Sass compiler(i.e npm install -g sass)


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
- 
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
