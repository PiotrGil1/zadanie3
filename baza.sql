create table users(id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, username VARCHAR(255), password VARCHAR(255));
INSERT INTO users (username, password)
VALUES
('admin', 'test');

ALTER TABLE users ADD UNIQUE (username);
