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
    public function Query($query, $host, $port, $dbname, $user, $password) {
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
    public function Time($query, $host, $port, $dbname, $user, $password) {
        $time_start = microtime(true); 
        $pg = $this->Query($query, $host, $port, $dbname, $user, $password);
        $time_end = microtime(true);
        /** per convertire in minuti dividere per 60 */
        $execution_time = ($time_end - $time_start);
        return $execution_time;        
    }
    
}

/** istanzia la classe */
$pg = new PostgresQuery();

$n = 10;
$list = array();
while ($n >= 0) {
    $execution_time = $pg->Time($query, $host, $port, $dbname, $user, $password); // Assign the value returned by Time method to $execution_time
    $list[] = $execution_time;
    $n = $n - 1;
}

/** stampa il tempo di risposta del server */
var_dump($list);
//echo ("Tempo di risposta: " . $execution_time . " secondi");