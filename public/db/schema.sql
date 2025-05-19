CREATE DATABASE IF NOT EXISTS blog_data;
USE blog_data;

CREATE TABLE IF NOT EXISTS posts (
    id INT PRIMARY KEY,
    user_id INT,
    title VARCHAR(255),
    body TEXT
);

CREATE TABLE IF NOT EXISTS comments (
    id INT PRIMARY KEY,
    post_id INT,
    name VARCHAR(255),
    email VARCHAR(255),
    body TEXT,
    FOREIGN KEY (post_id) REFERENCES posts(id)
);
