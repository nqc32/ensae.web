GRANT USAGE ON *.* TO 'sec_user'@'localhost' IDENTIFIED BY PASSWORD '*624D63BCE691D1E74B483F8634CA1C97538A9F18';

GRANT SELECT, INSERT, UPDATE, DELETE ON `secure_login`.* TO 'sec_user'@'localhost';