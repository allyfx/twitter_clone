<h1 align='center'>📣 Twitter Clone</h1>
<blockquote align='center'>A clone of the social media Twitter, with php and mysql made during the web development course to practice the mvc structure.</blockquote>

## 💡What is it?
Twitter Clone is an application developed during the Web Development course to practice structuring mvc.Twitter Clone is an application developed during the Web Development course to practice structuring mvc. It allows you to create an account, follow people, be followed and post new tweets.

## 💾 Configure database
To run this application you first need to configure your database.
- Download xampp on your computer (or another software you like) and run Apache and mysql.

- Go to `localhost:phpmyadmin` and on the sql tab run this sql query:

```mysql
  create database twitter_clone;

  use twitter_clone;

  create table usuarios(
    id int not null primary key AUTO_INCREMENT,
    nome varchar(100) not null,
    email varchar(150) not null,
    senha varchar(32) not null
  );

  create table tweets(
    id int not null PRIMARY KEY AUTO_INCREMENT,
    id_usuario int not null,
    tweet varchar(140) not null,
    data datetime default current_timestamp
  );

  create table usuarios_seguidores(
    id int not null primary key auto_increment,
    id_usuario int not null,
    id_usuario_seguindo int not null
  );
```
- Open an terminal and go to the public folder of the project, run `php -S localhost:<port>` to open the server.

## 🚧Built With
- PHP
- MySql
- HTML
- CSS
