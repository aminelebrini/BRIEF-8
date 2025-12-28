CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(200) NOT NULL,
    lastname VARCHAR(200) NOT NULL,
    email VARCHAR(255) UNIQUE,
    password VARCHAR(200) NOT NULL,
    role ENUM('reader', 'admin') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(150) NOT NULL,
    publication_year INT NOT NULL,
    status ENUM('available','borrowed') NOT NULL DEFAULT 'available',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE IF NOT EXISTS borrows (
  id INT AUTO_INCREMENT PRIMARY KEY,
  reader_id INT NOT NULL,   
  book_id INT NOT NULL,    
  borrow_date DATETIME NOT NULL,
  return_date DATETIME,
  FOREIGN KEY (reader_id) REFERENCES users(id),
  FOREIGN KEY (book_id) REFERENCES books(id)
);

