-- Создание таблицы ЧЕЛОВЕК
CREATE TABLE PEOPLE (
    PersonID INT PRIMARY KEY AUTO_INCREMENT,
    FullName VARCHAR(100),
    PassportData VARCHAR(100)
);

-- Создание таблицы АВТОМОБИЛИ с ссылкой на таблицу ЧЕЛОВЕК
CREATE TABLE CARS (
    CarID INT PRIMARY KEY AUTO_INCREMENT,
    Model VARCHAR(100),
    Year INT,
    LicensePlate VARCHAR(20),
    InsuranceCost INT,
    OwnerID INT,
    FOREIGN KEY (OwnerID) REFERENCES PEOPLE(PersonID)
);

-- Создание таблицы ВИДЫ_НАРУШЕНИЙ
CREATE TABLE VIOLATION_TYPES (
    ViolationTypeID INT PRIMARY KEY AUTO_INCREMENT,
    ViolationType VARCHAR(100) UNIQUE,
    FineAmount INT
);

-- Создание таблицы VIOLATION_FACTS с изменениями
CREATE TABLE VIOLATION_FACTS (
    ViolationDate DATE,
    DriverID INT,
    CarID INT,
    ViolationTypeID INT,
    FOREIGN KEY (DriverID) REFERENCES PEOPLE(PersonID),
    FOREIGN KEY (CarID) REFERENCES CARS(CarID),
    FOREIGN KEY (ViolationTypeID) REFERENCES VIOLATION_TYPES(ViolationTypeID)
);