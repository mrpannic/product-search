DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS tokens;

CREATE TABLE users (
            id int unsigned AUTO_INCREMENT PRIMARY KEY, 
            username varchar(255) UNIQUE,
            password varchar(255),
            first_name varchar(255),
            last_name varchar(255)
        );

CREATE TABLE tokens (
    user_id varchar(255),
    token varchar(255)
);