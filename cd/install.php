<?php
require_once "pdo.php";

$sql = "
CREATE TABLE users (
  user_id INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(128),
  email VARCHAR(128),
  password VARCHAR(128),
  PRIMARY KEY(user_id)
);

INSERT INTO users (name,email,password)
VALUES ('UMSI','umsi@umich.edu','php123');

CREATE TABLE Profile (
  profile_id INT NOT NULL AUTO_INCREMENT,
  user_id INT NOT NULL,
  first_name VARCHAR(128),
  last_name VARCHAR(128),
  email VARCHAR(128),
  headline VARCHAR(255),
  summary TEXT,
  PRIMARY KEY(profile_id),
  CONSTRAINT profile_ibfk_1
    FOREIGN KEY (user_id)
    REFERENCES users (user_id)
    ON DELETE CASCADE
);
";

$pdo->exec($sql);
echo "Tables installed successfully";
