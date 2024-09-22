# First Mutual Health Portal


## Developer Requirements

1. PHP min v7.6(e.g XAMPP) [click here to download XAMPP](https://www.apachefriends.org/download.html)
2. MySql Database (i.e included in XAMPP)
3. Sass compiler (i.e npm install -g sass)
4. Composer [click here to download](https://getcomposer.org/download/)
5. Git v2.46.1

## Production Requirements

1. Microsoft Azure Virtual Machine - Ubuntu Server v24.04.1
2. Apache 2.4.43
3. PHP minimum v7.6
4. MySQL v8.4
5. Git v2.46.1


## Frontend Technology

1. HTML/CSS
2. JS
3. Bootstrap (CSS Framework)
4. JQuery (Events)

## Backend Technology

1. PHP (Core)
2. MySQL (Database)


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
├── dashboard
│   ├── admin
│   ├── staff
│   ├── user
├── node_modules
├── composer.json
├── composer.lock
├── package.json
├── package-lock.json
├── index.php
├── login.php
└── logout.php


```


## Database Tables

1. admins
  - admin_id
  - username
  - password
  - firstname
  - surname
  - phone_number
  - email
2. staff
  - staff_id
  - username
  - password
  - firstname
  - surname
  - nat_id_number
  - email
  - phone_number
  - staff_type
3. users
  - user_id
  - username
  - password
  - firstname
  - surname
  - nat_id_number
  - dob
  - phone_number
  - email
  - med_aid
4. medical_aid
  - med_id
  - employer
  - issue_date
  - expiry_date
5. stock
  - stock_id
  - name
  - description
  - threshold
  - price
  - balance
6. stock_entries
  - stock_id
  - supplier
  - date
  - amount
7. prescriptions
  - presc_id
  - user_id
  - img
  - uploaded_on
8. sales
  - sale_id
  - sale_date
  - presc_id
  - staff_id
  - total