<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Результат</title>
    <style>
        body {
            font-family: 'Courier New', monospace;
            margin: 0;
            padding: 0;
            background-color: #ffdae0;
        }
        .maincontent {
            padding: 20px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }
        header {
            background-color: #FFC0CB;
            color: white;
            padding: 10px 0;
            text-align: center;
        }
        header a {
            display: inline-block;
            padding: 10px 20px;
            color: white;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        header a:hover {
            background-color: #FF69B4;
        }

    </style>
</head>
<body>
    <header>
        <a href="index.php">Запросы в бд</a>
        <a href="showtable.php">Посмотреть бд</a>
    </header>
    <div class="maincontent">
<?php

include("dbconnect.php");

$query = $_POST['query'];

if ($query === "1") {
   
    $year = $_POST['year'];

    $sql_query = "SELECT CARS.*, PEOPLE.FullName 
                  FROM CARS 
                  JOIN PEOPLE ON CARS.OwnerID = PEOPLE.PersonID 
                  WHERE Year = ?;";
    
    $stmt = $db->prepare($sql_query);
    $stmt->execute([$year]);
    $result = $stmt->fetchAll();
    
    if (count($result) > 0) {
        echo "<table>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Модель</th>";
        echo "<th>Год выпуска</th>";
        echo "<th>Госномер</th>";
        echo "<th>Страховая стоимость</th>";
        echo "<th>ФИО владельца</th>";
        echo "</tr>";
        foreach ($result as $row) {
            echo "<tr>";
            echo "<td>" . $row['CarID'] . "</th>";
            echo "<td>" . $row['Model'] . "</td>";
            echo "<td>" . $row['Year'] . "</td>";
            echo "<td>" . $row['LicensePlate'] . "</td>";
            echo "<td>" . $row['InsuranceCost'] . "</td>";
            echo "<td>" . $row['FullName'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Ничего не найдено.";
    }
    
} elseif ($query === "2") {

    $symbol = $_POST['symbol'];

    $sql_query = "SELECT CARS.*, PEOPLE.FullName 
                  FROM CARS 
                  JOIN PEOPLE ON CARS.OwnerID = PEOPLE.PersonID 
                  WHERE PEOPLE.PassportData LIKE ?";
    
    $stmt = $db->prepare($sql_query);
    $stmt->execute([$symbol . '%']);
    
    $result = $stmt->fetchAll();
    
    if (count($result) > 0) {
        echo "<table>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Модель автомобиля</th>";
        echo "<th>Год выпуска</th>";
        echo "<th>Госномер</th>";
        echo "<th>Страховая стоимость</th>";
        echo "<th>ФИО владельца</th>";
        echo "</tr>";
        foreach ($result as $row) {
            echo "<tr>";
            echo "<td>" . $row['CarID'] . "</td>";
            echo "<td>" . $row['Model'] . "</td>";
            echo "<td>" . $row['Year'] . "</td>";
            echo "<td>" . $row['LicensePlate'] . "</td>";
            echo "<td>" . $row['InsuranceCost'] . "</td>";
            echo "<td>" . $row['FullName'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Ничего не найдено.";
    }       

} elseif ($query === "3") {
    
    $min_cost = $_POST['min_cost'];
    $max_cost = $_POST['max_cost'];
    
    $sql_query = "SELECT CARS.*, PEOPLE.FullName 
        FROM CARS 
        JOIN PEOPLE ON CARS.OwnerID = PEOPLE.PersonID 
        WHERE InsuranceCost BETWEEN ? AND ?";

    $stmt = $db->prepare($sql_query);
    $stmt->execute([$min_cost, $max_cost]);

    $result = $stmt->fetchAll();

    if (count($result) > 0) {
        echo "<table>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Модель автомобиля</th>";
        echo "<th>Год выпуска</th>";
        echo "<th>Госномер</th>";
        echo "<th>Страховая стоимость</th>";
        echo "<th>ФИО владельца</th>";
        echo "</tr>";
        foreach ($result as $row) {
            echo "<tr>";
            echo "<td>" . $row['CarID'] . "</td>";
            echo "<td>" . $row['Model'] . "</td>";
            echo "<td>" . $row['Year'] . "</td>";
            echo "<td>" . $row['LicensePlate'] . "</td>";
            echo "<td>" . $row['InsuranceCost'] . "</td>";
            echo "<td>" . $row['FullName'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Ничего не найдено.";
    }    

} elseif ($query === "4") {
    
    $license_plate = $_POST['license_plate'];
    
    $sql_query = "SELECT CARS.*, PEOPLE.FullName 
        FROM CARS 
        JOIN PEOPLE ON CARS.OwnerID = PEOPLE.PersonID 
        WHERE LicensePlate = ?";

    $stmt = $db->prepare($sql_query);
    $stmt->execute([$license_plate]);

    $result = $stmt->fetchAll();

    if (count($result) > 0) {
        echo "<table>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Модель автомобиля</th>";
        echo "<th>Год выпуска</th>";
        echo "<th>Госномер</th>";
        echo "<th>Страховая стоимость</th>";
        echo "<th>ФИО владельца</th>";
        echo "</tr>";
        foreach ($result as $row) {
            echo "<tr>";
            echo "<td>" . $row['CarID'] . "</td>";
            echo "<td>" . $row['Model'] . "</td>";
            echo "<td>" . $row['Year'] . "</td>";
            echo "<td>" . $row['LicensePlate'] . "</td>";
            echo "<td>" . $row['InsuranceCost'] . "</td>";
            echo "<td>" . $row['FullName'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Ничего не найдено.";
    }    

} elseif ($query === "5") {
    
    $min_date = $_POST['min_date'];
    $max_date = $_POST['max_date'];
    
    $sql_query = "SELECT
        VIOLATION_FACTS.ViolationDate,
        PEOPLE.FullName AS DriverFullName,
        CARS.LicensePlate AS CarLicensePlate,
        VIOLATION_TYPES.ViolationType
    FROM
        VIOLATION_FACTS
    JOIN
        PEOPLE ON VIOLATION_FACTS.DriverID = PEOPLE.PersonID
    JOIN
        CARS ON VIOLATION_FACTS.CarID = CARS.CarID 
    JOIN
        VIOLATION_TYPES ON VIOLATION_FACTS.ViolationTypeID = VIOLATION_TYPES.ViolationTypeID
    WHERE
        VIOLATION_FACTS.ViolationDate BETWEEN ? AND ?";
    
    $stmt = $db->prepare($sql_query);
    $stmt->execute([$min_date, $max_date]);
    
    $result = $stmt->fetchAll();

    $sql_query = "SELECT * FROM PEOPLE";
    $stmt = $db->prepare($sql_query);
    $stmt->execute();
    $People = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $people_names = [];
    foreach ($People as $people) {
        $people_names[$people['FullName']] = $people['FullName'];
    }

    $sql_query = "SELECT * FROM VIOLATION_TYPES";
    $stmt = $db->prepare($sql_query);
    $stmt->execute();
    $Vi_types = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $vi_type_name = [];
    foreach ($Vi_types as $vi_type) {
        $vi_type_name[$vi_type['ViolationType']] = $vi_type['ViolationType'];
    }

    if (count($result) > 0) {
        echo "<table>";
        echo "<tr>";
        echo "<th>Дата нарушения ПДД</th>";
        echo "<th>ФИО водителя</th>";
        echo "<th>Госномер автомобиля</th>";
        echo "<th>Вид нарушения ПДД</th>";
        echo "</tr>";
        foreach ($result as $row) {
            echo "<tr>";
            echo "<td>" . $row['ViolationDate'] . "</td>";
            echo "<td>" . $row['DriverFullName'] . "</td>";
            echo "<td>" . $row['CarLicensePlate'] . "</td>";
            echo "<td>" . $vi_type_name[$row['ViolationType']] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Ничего не найдено.";
    }    

} elseif ($query === "6") {

    $sql_query = "SELECT CARS.*, PEOPLE.FullName, (InsuranceCost * 0.1) AS InsurancePayment 
        FROM CARS
        JOIN PEOPLE ON CARS.OwnerID = PEOPLE.PersonID";

    $stmt = $db->prepare($sql_query);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($result) > 0) {
        echo "<table>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Модель автомобиля</th>";
        echo "<th>Год выпуска</th>";
        echo "<th>Госномер</th>";
        echo "<th>Страховая стоимость</th>";
        echo "<th>ФИО владельца</th>";
        echo "<th>Страховой взнос</th>";
        echo "</tr>";
        foreach ($result as $row) {
            echo "<tr>";
            echo "<td>" . $row['CarID'] . "</td>";
            echo "<td>" . $row['Model'] . "</td>";
            echo "<td>" . $row['Year'] . "</td>";
            echo "<td>" . $row['LicensePlate'] . "</td>";
            echo "<td>" . $row['InsuranceCost'] . "</td>";
            echo "<td>" . $row['FullName'] . "</td>";
            echo "<td>" . $row['InsurancePayment'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Ничего не найдено.";
    }  
    
} elseif ($query === "7") {

    $sql_query = "SELECT Model, AVG(InsuranceCost) AS AverageInsuranceCost
        FROM CARS
        GROUP BY Model;
    ";

    $stmt = $db->prepare($sql_query);
    $stmt->execute();

    $result = $stmt->fetchAll();

    echo "<table>";
    echo "<tr>";
    echo "<th>Модель автомобиля</th>";
    echo "<th>Средняя страховая стоимость</th>";
    echo "</tr>";

    foreach ($result as $row) {
        echo "<tr>";
        echo "<td>" . $row['Model'] . "</td>";
        echo "<td>" . $row['AverageInsuranceCost'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";

} elseif ($query === "8") {
    
    $sql_query = "SELECT Year, MIN(InsuranceCost) AS MinInsuranceCost, 
            MAX(InsuranceCost) AS MaxInsuranceCost
        FROM CARS
        GROUP BY Year;
    ";

    $stmt = $db->prepare($sql_query);
    $stmt->execute();

    $result = $stmt->fetchAll();

    echo "<table>";
    echo "<tr>";
    echo "<th>Год выпуска</th>";
    echo "<th>Минимальная страховая стоимость</th>";
    echo "<th>Максимальная страховая стоимость</th>";
    echo "</tr>";

    foreach ($result as $row) {
        echo "<tr>";
        echo "<td>" . $row['Year'] . "</td>";
        echo "<td>" . $row['MinInsuranceCost'] . "</td>";
        echo "<td>" . $row['MaxInsuranceCost'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} elseif ($query === "9") {
    
    $min_insurance_cost = $_POST['min_insurance_cost'];

    $sql_query = "SELECT CARS.*, PEOPLE.FullName
        FROM CARS 
        JOIN PEOPLE ON CARS.OwnerID = PEOPLE.PersonID
        WHERE InsuranceCost > ?;";

    $stmt = $db->prepare($sql_query);
    $stmt->execute([$min_insurance_cost]);

    $result = $stmt->fetchAll();

    if (count($result) > 0) {
        echo "<table>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Модель автомобиля</th>";
        echo "<th>Год выпуска</th>";
        echo "<th>Госномер</th>";
        echo "<th>Страховая стоимость</th>";
        echo "<th>ФИО владельца</th>";
        echo "</tr>";
        foreach ($result as $row) {
            echo "<tr>";
            echo "<td>" . $row['CarID'] . "</td>";
            echo "<td>" . $row['Model'] . "</td>";
            echo "<td>" . $row['Year'] . "</td>";
            echo "<td>" . $row['LicensePlate'] . "</td>";
            echo "<td>" . $row['InsuranceCost'] . "</td>";
            echo "<td>" . $row['FullName'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Ничего не найдено.";
    }
}
?>
</div>
</body>
</html>