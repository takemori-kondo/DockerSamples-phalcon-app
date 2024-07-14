CREATE USER 'common'@'localhost'  IDENTIFIED BY 'password_common';
CREATE USER 'common'@'127.0.0.1'  IDENTIFIED BY 'password_common';
CREATE USER 'common'@'172.16.0.%' IDENTIFIED BY 'password_common';
GRANT ALL PRIVILEGES ON *.* TO 'common'@'localhost';
GRANT ALL PRIVILEGES ON *.* TO 'common'@'127.0.0.1';
GRANT ALL PRIVILEGES ON *.* TO 'common'@'172.16.0.%';
flush privileges;