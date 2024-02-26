CREATE TABLE student (
	id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    nim CHAR(13),
    phone VARCHAR(20),
    major_id INT,
    FOREIGN KEY (major_id) REFERENCES major(id)
);