CREATE DATABASE IF NOT EXISTS inline;
USE inline;
CREATE TABLE posts
(
    id      INT auto_increment PRIMARY KEY,
    user_id INT,
    title   VARCHAR(255),
    body    TEXT
);
CREATE TABLE comments
(
    id      INT auto_increment PRIMARY KEY,
    post_id INT,
    name    VARCHAR(255),
    email   VARCHAR(255),
    body    TEXT
);
ALTER TABLE comments
    ADD FOREIGN KEY (post_id) REFERENCES posts (id)
