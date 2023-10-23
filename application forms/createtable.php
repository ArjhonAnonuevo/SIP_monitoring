        <?php
        include "database.php";
        $conn = new mysqli($servername, $username, $password, "interns_application");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $info = "CREATE TABLE IF NOT EXISTS application (
            id INT AUTO_INCREMENT PRIMARY KEY,
            given_name VARCHAR(255) NOT NULL,
            middle_name VARCHAR(255) NOT NULL,
            family_name VARCHAR(255) NOT NULL,
            address VARCHAR(255) NOT NULL,
            place_birth VARCHAR(30) NOT NULL,
            birthday DATE,
            age VARCHAR(15) NOT NULL,
            gender VARCHAR(15),
            contact VARCHAR(30) NOT NULL,
            landline VARCHAR(30),
            primary_email VARCHAR(255) NOT NULL,
            secondary_email VARCHAR(255) NOT NULL
        )";

        $file = "CREATE TABLE IF NOT EXISTS files (
            file_id INT AUTO_INCREMENT PRIMARY KEY,
            school_id LONGBLOB,  
            regi LONGBLOB,               
            schedule LONGBLOB,
            form1 LONGBLOB,
            form2 LONGBLOB, 
            form3 LONGBLOB,
            form4 LONGBLOB, 
            id INT,
            FOREIGN KEY (id) REFERENCES application(id)
        )";

        $names = "CREATE TABLE IF NOT EXISTS file_names (
            id INT AUTO_INCREMENT PRIMARY KEY,
            file_id INT NOT NULL,
            school_name VARCHAR(255) NOT NULL,
            regi_name VARCHAR(255) NOT NULL,
            schedule_name VARCHAR(255) NOT NULL,
            form1_name VARCHAR(255) NOT NULL,
            form2_name VARCHAR(255) NOT NULL,
            form3_name VARCHAR(255) NOT NULL,
            form4_name VARCHAR(255) NOT NULL,
            FOREIGN KEY (file_id) REFERENCES files (file_id)
        )";

        if ($conn->query($info) === TRUE && $conn->query($file) === TRUE && $conn->query($names) === TRUE) {
        } else {
            echo "Error creating tables: " . $conn->error;
        }

        $conn->close();
        ?>
