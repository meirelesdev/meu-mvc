<?php
session_start();

$config = array(
        "BASE_URL" => "http://localhost/Ferraretto/Web_Governanca",
        "db" => array(
                "host" => "localhost",
                "dbname" => "ferraretto",
                "user" => "postgres",
                "pass" => "root",
                "port" => "5432",
                "schema_cph" => '"CPH".',
                "schema_gov" => '"GOV_MOBILE".'
));

?>