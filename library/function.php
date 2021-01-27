<?php
require "koneksi.php";
$error = "";

/**
 * Read data
 *
 * Read all record in table
 *
 * @param string $query sql query
 * @return array all record
 * @throws Exception basic exception if command failed
 **/
function read(string $query)
{
    global $conn;
    global $error;
    try {
        // baca data
        $result = $conn->query($query);
        // bungkus data
        $rows = [];
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        // kembalikan isi data
        return $rows;
    } catch (Exception $e) {
        $error = "Read data error : $e";
    }
}

/**
 * Add data
 *
 * Add a record to table
 *
 * @param string $table table name
 * @param string $values values to be insert
 * @return int number of affected_rows if command success
 * @throws Exception basic exception if command failed
 **/
function add(string $table, string $values)
{
    global $conn;
    global $error;
    try {
        $conn->query("INSERT INTO $table VALUES($values)");
        return $conn->affected_rows;
    } catch (Exception $e) {
        $error = "Add data error : $e";
    }
}
/**
 * edit data
 *
 * edit a record in a table
 *
 * @param string $table table name
 * @param string $param parameter of changed values
 * @param string $condition the condion of query
 * @return int number of affected_rows if command success
 * @throws Exception basic exception if command failed
 **/
function update(string $table, string $param, string $condition)
{
    global $conn;
    global $error;
    try {
        $conn->query("UPDATE $table SET $param WHERE $condition");
        return $conn->affected_rows;
    } catch (Exception $e) {
        $error = "Update data error : $e";
    }
}

/**
 * delete data
 *
 * delete a record by their condition
 *
 * @param string $table table name
 * @param string $condition the condion of query
 * @return int number of affected_rows if command success
 * @throws Exception basic exception if command failed
 **/
function delete(string $table, string $condition)
{
    global $conn;
    global $error;
    try {
        $conn->query("DELETE FROM $table WHERE $condition");
        return $conn->affected_rows;
    } catch (Exception $e) {
        $error = "Delete error : $e";
    }
}
