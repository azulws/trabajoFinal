create database if not exists tpFinal;

use tpFinal;

CREATE TABLE roles(
    role_id INT AUTO_INCREMENT,
    role_description VARCHAR(255),
    CONSTRAINT pk_role_id PRIMARY KEY roles(role_id));
    
     insert into roles(role_description) values ("admin"),("user");
    -- select * from roles;
    -- drop table cinemas;
    
CREATE TABLE cinemas(
    cinema_id INT AUTO_INCREMENT,
    cinema_name VARCHAR(255) NOT NULL,
    ticket_value FLOAT,
    address VARCHAR(255),
    CONSTRAINT pk_cinema_id PRIMARY KEY cinemas(cinema_id));
    
   -- select * from cinemas;
   -- drop table cinemas;
   -- delete from cinemas where cinema_id>0;
   
CREATE TABLE rooms(
	room_id int auto_increment,
	capacity int,
    room_name varchar(255) unique,
    cinema_id int,
    constraint pk_room_id primary key room(room_id),
    constraint fk_cinemaRoom_id foreign key rooms(cinema_id) references cinemas(cinema_id));
    
CREATE TABLE movies(
    movie_id INT,
    title VARCHAR(255) NOT NULL,
    release_date DATE,
    movie_description VARCHAR(1023),
    poster VARCHAR(255),
    points SMALLINT,
    runtime INT,
    CONSTRAINT pk_movie_id PRIMARY KEY movies(movie_id));
	
    -- select * from movies;
	-- delete from movies where movie_id>0;
    
CREATE TABLE genres(
    genre_id INT AUTO_INCREMENT,
    genre_description VARCHAR(255),
	CONSTRAINT genre_id PRIMARY KEY genres(genre_id));
    
    -- select * from genres;
   
CREATE TABLE genresByMovies(
    genreByMovie_id INT AUTO_INCREMENT,
    movie_id INT,
    genre_id INT,
    CONSTRAINT pk_genreByMovie_id PRIMARY KEY genresByMovie (genreByMovie_id),
	CONSTRAINT fk_movie_id FOREIGN KEY genresByMovie(movie_id) REFERENCES movies(movie_id),
	CONSTRAINT fk_genre_id FOREIGN KEY genresByMovie(genre_id) REFERENCES genres(genre_id));

	-- select * from genresByMovies;

CREATE TABLE movieFunctions(
	movieFunction_id INT AUTO_INCREMENT,
	start_datetime DATETIME,
    room_id INT,
	movie_id INT,
	CONSTRAINT pk_movieFunction_id PRIMARY KEY movieFunctions(movieFunction_id),
	CONSTRAINT fk_roomFunction_id FOREIGN KEY movieFunctions(room_id) REFERENCES rooms(room_id),
	CONSTRAINT fk_movieFunction_id FOREIGN KEY movieFunctions(movie_id) REFERENCES movies(movie_id));

	-- select * from movieFunctions;
    -- delete from movieFunctions where movieFunction_id>=0;
    -- drop table movieFunctions;
    
CREATE TABLE users (
    user_id INT AUTO_INCREMENT,
    userName VARCHAR(255),
    last_name VARCHAR(255),
    email VARCHAR(255) UNIQUE,
    pass VARCHAR(255),
    dni INT UNIQUE,
    role_id INT,
    CONSTRAINT pk_user_id PRIMARY KEY users(user_id),
    CONSTRAINT fk_role_id FOREIGN KEY users(role_id) REFERENCES roles(role_id));


insert into users(userName,last_name,email,pass,dni,role_id) values ("admin","admin","admin@admin.com","admin",1234,1),("user","user","user@user.com","user",54321,2);
-- select * from users;

CREATE TABLE creditCards(
    creditCard_id INT AUTO_INCREMENT,
    numberCard varchar(255) unique,
    creditCard_description varchar(255),
    security_code int,
    expiration_date date,
    user_email varchar(255),
    CONSTRAINT pk_creditCard_id PRIMARY KEY creditCards(creditCard_id),
    CONSTRAINT fk_user_email FOREIGN KEY creditCards(user_email) REFERENCES users(email));
    
    -- drop table creditCards;

    
CREATE TABLE buyouts(
	buyout_id int auto_increment,
    discount float,
    buy_date datetime,
    total float,
    cantTicket int,
    user_email varchar(255),
    creditCard_id int,
	constraint pk_buyout_id primary key(buyout_id),
    constraint fk_user_emailBuyout foreign key(user_email) references users(email),
    constraint fk_creditCard_id foreign key(creditCard_id) references creditCards(creditCard_id)
);

	-- drop table buyouts;
	-- delete from buyouts where buyout_id>0;
	-- select * from buyouts;
    
CREATE TABLE tickets(
	ticket_id int auto_increment,
    qr varchar(255),
    movieFunction_id int,
    buyout_id int,
    constraint pk_ticket_id primary key(ticket_id),
    constraint fk_buyout_id foreign key(buyout_id) references buyouts(buyout_id),
    constraint fk_movieFunctionTicket_id foreign key(movieFunction_id) references movieFunctions(movieFunction_id)
);

	-- drop table tickets;
    -- delete from tickets where ticket_id>0;
    -- select * from tickets;