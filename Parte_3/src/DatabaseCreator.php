<?php

class DatabaseCreator
{
    function getDbConnection()
    {
        $host = 'database';
        $username = 'user_db';
        $password = 'Pestillo123';
        $database = 'quizz_app';

        try {
            $mysqli = new mysqli($host, $username, $password, $database);

            if ($mysqli->connect_error) {
                error_log('Connection failed: ' . $mysqli->connect_error);

                throw new mysqli_sql_exception('Connection failed: ' . $mysqli->connect_error);
            }
            return $mysqli;
        } catch (mysqli_sql_exception $e) {
            error_log('Error: ' . $e->getMessage());
            die('Error: ' . $e->getMessage());
        }
    }
}