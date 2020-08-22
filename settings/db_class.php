<?php

//include database credentials file
require 'db_cred.php';

/**
 *@author David Sampah
 *@version 1.1
 */
class db_connection
{
  //properties
  public $db = null;
  public $results = null;

  //connect
  /**
   *Database connection
   *@return boolean
   **/
  function db_connect()
  {
    //connection
    $this->db = mysqli_connect(SERVER, USERNAME, PASSWD, DATABASE);

    //test the connection
    if (mysqli_connect_errno()) {
      return false;
    } else {
      return true;
    }
  }

  //execute a query
  /**
   *Query the Database
   *@param takes a connection and sql query
   *@return boolean
   **/
  function db_query($sqlQuery)
  {
    if (!$this->db_connect()) {
      return false;
    } elseif ($this->db == null) {
      return false;
    }

    //run query
    $this->results = mysqli_query($this->db, $sqlQuery);

    if ($this->results == false) {
      return false;
    } else {
      return true;
    }
  }

  //execute a query with mysqli real escape string
  //to save guard from sql injection
  /**
   *Query the Database
   *@param takes a connection and sql query
   *@return boolean
   **/
  function db_query_escape_string($sqlQuery)
  {
    //run query
    $this->results = mysqli_query($this->db, $sqlQuery);

    if ($this->results == false) {
      return false;
    } else {
      return true;
    }
  }

  //fetch data
  /**
   *get select data
   *@return a record
   **/
  function db_fetch()
  {
    //check if result was set
    if ($this->results == null) {
      return false;
    } elseif ($this->results == false) {
      return false;
    }

    //return a record
    return mysqli_fetch_assoc($this->results);
  }

  //count data
  /**
   *get select data
   *@return a count
   **/
  function db_count()
  {
    //check if result was set
    if ($this->results == null) {
      return false;
    } elseif ($this->results == false) {
      return false;
    }

    //return a record
    return mysqli_num_rows($this->results);
  }

  //execute a query that returns the just inserted id
  /**
   *Query the Database
   *@param takes a connection and sql query
   *@return returns the just inserted id
   **/
  function db_query_id($sqlQuery)
  {
    if (!$this->db_connect()) {
      return false;
    } elseif ($this->db == null) {
      return false;
    }

    //run query
    $this->results = mysqli_query($this->db, $sqlQuery);

    if ($this->results == false) {
      return false;
    } else {
      //get the just inserted id
      return mysqli_insert_id($this->db);
    }
  }

  //execute a query with mysqli real escape string and return the just inserted id
  //to safeguard from sql injection
  /**
   *Query the Database
   *@param takes a connection and sql query
   *@return boolean
   **/
  function db_query_escape_string_id($sqlQuery)
  {
    //run query
    $this->results = mysqli_query($this->db, $sqlQuery);

    if ($this->results == false) {
      return false;
    } else {
      //get the just inserted id
      return mysqli_insert_id($this->db);
    }
  }
}
?>
