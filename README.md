to run this project , you need a database named"psg" and run the below queries one by one.

*Note*: Don't forget to copy the code files in Xampp/htdocs

step 1:====>

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    roll_no VARCHAR(20) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

step 2:====>

ALTER TABLE users
ADD COLUMN email VARCHAR(100),
ADD COLUMN father_name VARCHAR(100),
ADD COLUMN mother_name VARCHAR(100),
ADD COLUMN photo VARCHAR(255);


step3 :====>

ALTER TABLE users
ADD COLUMN dob DATE,
ADD COLUMN cgpa DECIMAL(4,2),
ADD COLUMN mark_10 INT,
ADD COLUMN mark_12 INT NULL,
ADD COLUMN aadhar_no VARCHAR(12),
ADD COLUMN marksheet_10 VARCHAR(255),
ADD COLUMN marksheet_12 VARCHAR(255);

step 4:====>

ALTER TABLE users
ADD COLUMN father_photo VARCHAR(255),
ADD COLUMN mother_photo VARCHAR(255),
ADD COLUMN community_certificate VARCHAR(255),
ADD COLUMN father_occupation VARCHAR(100),
ADD COLUMN mother_occupation VARCHAR(100),
ADD COLUMN father_salary DECIMAL(10,2),
ADD COLUMN mother_salary DECIMAL(10,2),
ADD COLUMN annual_income DECIMAL(10,2),
ADD COLUMN address TEXT,
ADD COLUMN gender ENUM('Male', 'Female', 'Other'),
ADD COLUMN student_phone VARCHAR(15),
ADD COLUMN father_phone VARCHAR(15),
ADD COLUMN mother_phone VARCHAR(15);

