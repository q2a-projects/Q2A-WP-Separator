<?php
ini_set('max_execution_time', 300); //300 seconds = 5 minutes

class database{
    var $last_query; //Saved result of the last query made
    var $last_result; //Results of the last query made
    var $func_call; //A textual description of the last query/get_row/get_var call
    var $link; //database link
    var $lastquery; //last query
    var $result; //query result
 
    // Connect to MySQL database
    function database() {
        $this->link=mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die('Server connetion not possible.');
        //Set All Charsets to UTF8
        mysql_query("SET character_set_results=utf8 , character_set_client=utf8 , character_set_connection=utf8 , character_set_database=utf8 , character_set_server=utf8");
        mysql_select_db(DB_NAME) or die('Database connection not possible.');
    }
    /** Query the database.
      * @param $query The query.
      * @return The result of the query into $lastquery, to use with fetchNextObject().
      */
    function query( $query ){
        $this->lastquery=$query;
        $this->result=@mysql_query( $query, $this->link );
        return $this->result;
    }
    /** Do the same as query() but do not return nor store result.
      * Should be used for INSERT, UPDATE, DELETE...
      * @param $query The query.
      * @param $debug If true, it output the query and the resulting table.
      */
    function execute($query)
    {
      @mysql_query($query);
    }
    /** Convenient method for mysql_fetch_object().
      * @param $result The ressource returned by query().
      * @return An ARRAY representing a data row.
      */
    function fetchArray($result){
    if ($result == NULL)
        $result = $this->result;
    if ($result == NULL || mysql_num_rows($result) < 1)
        return NULL;
    else
        return mysql_fetch_assoc($result);
    }
 
    /** Close the connecion with the database server.
      * It's usually unneeded since PHP do it automatically at script end.
      */
    function close()
    {
      mysql_close($this->link);
    }
    /** Get the number of rows of a query.
      * @param $result The ressource returned by query(). If NULL, the last result returned by query() will be used.
      * @return The number of rows of the query (0 or more).
      */
    function numRows($result = NULL)
    {
      if ($result == NULL)
        return @mysql_num_rows($this->result);
      else
        return mysql_num_rows($result);
    }
}


