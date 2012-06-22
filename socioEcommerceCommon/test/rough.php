<?php

$mysqli = new mysqli('localhost', 'user', 'password', 'world');

/* check connection */

if (mysqli_connect_errno()) {

    printf("Connect failed: %s\n", mysqli_connect_error());

    exit();
}

$stmt = $mysqli->prepare("INSERT INTO CountryLanguage VALUES (?, ?, ?, ?)");

$stmt->bind_param('sssd', $code, $language, $official, $percent);

$code = 'DEU';

$language = 'Bavarian';

$official = "F";

$percent = 11.2;

/* execute prepared statement */

$stmt->execute();

printf("%d Row inserted.\n", $stmt->affected_rows);

/* close statement and connection */

$stmt->close();

/* Clean up table CountryLanguage */

$mysqli->query("DELETE FROM CountryLanguage WHERE Language='Bavarian'");

printf("%d Row deleted.\n", $mysqli->affected_rows);

/* close connection */

$mysqli->close();








$mysqli = new mysqli("localhost", "user", "password", "world");

if (mysqli_connect_errno()) {

    printf("Connect failed: %s\n", mysqli_connect_error());

    exit();

}

/* prepare statement */

if ($stmt = $mysqli->prepare("SELECT Code, Name FROM Country WHERE Code LIKE ? LIMIT 5")) {

    $stmt->bind_param("s", $code);

    $code = "C%";

    $stmt->execute();

    /* bind variables to prepared statement */

    $stmt->bind_result($col1, $col2);

    /* fetch values */

    while ($stmt->fetch()) {

        printf("%s %s\n", $col1, $col2);

    }

    /* close statement */

    $stmt->close();

}

/* close connection */

$mysqli->close();





?>


