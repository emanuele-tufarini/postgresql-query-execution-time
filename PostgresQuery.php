<?php

/**
 * This file contains a class for executing queries on a PostgreSQL database.
 * It also calculates the execution time of the query.
 */

/** credenziali di accesso al database postgres */
require "Connection.php";

/** inserire la query sql dentro al file Query.sql */
$query = file_get_contents("Query.sql");

/** classe per testare le query sul database postgres */
class PostgresQuery {
    /**
     * Executes the query on the PostgreSQL database.
     * 
     * @param string $query The SQL query to be executed.
     * @param string $host The host name of the PostgreSQL server.
     * @param int $port The port number of the PostgreSQL server.
     * @param string $dbname The name of the PostgreSQL database.
     * @param string $user The username for connecting to the PostgreSQL server.
     * @param string $password The password for connecting to the PostgreSQL server.
     * @return PDOStatement The result of the query execution.
     */
    public function query($query, $host, $port, $dbname, $user, $password) {
        $conn = "pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password";
        $pdo = new PDO($conn);
        $response = $pdo->query($query);
        return $response;
    }
    
    /**
     * Calculates the execution time of the query.
     * 
     * @param string $query The SQL query to be executed.
     * @param string $host The host name of the PostgreSQL server.
     * @param int $port The port number of the PostgreSQL server.
     * @param string $dbname The name of the PostgreSQL database.
     * @param string $user The username for connecting to the PostgreSQL server.
     * @param string $password The password for connecting to the PostgreSQL server.
     * @return float The execution time of the query in seconds.
     */
    public function time($query, $host, $port, $dbname, $user, $password) {
        $timeStart = microtime(true); 
        $pg = $this->query($query, $host, $port, $dbname, $user, $password);
        $timeEnd = microtime(true);
        /** per convertire in minuti dividere per 60 */
        $executionTime = ($timeEnd - $timeStart);
        return $executionTime;        
    }
    
}

/** istanzia la classe */
$pg = new PostgresQuery();

$list = array();
while ($nTest >= 1) {
    $executionTime = $pg->time($query, $host, $port, $dbname, $user, $password); // Assign the value returned by Time method to $executionTime
    $list[] = $executionTime;
    $nTest = $nTest - 1;
}

/** stampa il tempo di risposta del server */
var_dump($list);