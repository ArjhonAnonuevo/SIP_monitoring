CREATE TABLE IF NOT EXISTS attendance (
    id INT AUTO_INCREMENT PRIMARY KEY,
    morning_timein TIME NOT NULL,
    lunch_timeout TIME NOT NULL,
    after_lunch_timein TIME NOT NULL,
    end_of_day_timeout TIME NOT NULL,
    attendance_date DATE NOT NULL,
    rendered_hours INT NOT NULL,
    username VARCHAR(255),
    CONSTRAINT username FOREIGN KEY (username) REFERENCES interns_account(username)
);

