<?php # MySqlUnicode.php
# Copyright (c) 2006 by Dr. Herong Yang, http://www.herongyang.com/
# 
   $con = mysql_connect('localhost', 'uv9205', 'marsa962tropo') or die("Fallo en la conexion<br>");;
   print "\nDefault settings...\n";
   $rs = mysql_query("SHOW VARIABLES LIKE 'character_set_%'");
   while ($row = mysql_fetch_array($rs)) {
      print "    ".$row[0].'   '.$row[1]."\n";
   }

   print "\nUpdated settings...\n";
   $rs = mysql_query("SET NAMES 'utf8'");
   $rs = mysql_query("SHOW VARIABLES LIKE 'character_set_%'");
   while ($row = mysql_fetch_array($rs)) {
      print "    ".$row[0].'   '.$row[1]."\n";
   }

   print "\nCreating a table in UTF-8...\n";
   //$rs = mysql_query('DROP DATABASE MyBase');
   //$rs = mysql_query('CREATE DATABASE MyBase CHARACTER SET utf8');
   //$rs = mysql_query('USE MyBase');
   mysql_select_db('uv9205_gersa');
   $rs = mysql_query('CREATE TABLE MyTable (ID INTEGER,'
      .' Message VARCHAR(80))');

   print "\nInserting some rows to the table...\n";
   $str = "Hello!";
   $rs = mysql_query("INSERT INTO MyTable VALUES ( 1, '$str')");
   $str = "\xC2\xA1Hola!";
   $rs = mysql_query("INSERT INTO MyTable VALUES ( 2, '$str')");
   $str = "\xE4\xBD\xA0\xE5\xA5\xBD!";
   $rs = mysql_query("INSERT INTO MyTable VALUES ( 3, '$str')");
      
   print "\nQuery some rows from the table...\n";
   $rs = mysql_query('SELECT * FROM MyTable WHERE ID < 10');
   print "   ".mysql_field_name($rs,0)."   "
      .mysql_field_name($rs,1)."\n";
   while ($row = mysql_fetch_array($rs)) {
      print "    ".$row[0].'   '.$row[1]."=(\x".bin2hex($row[1]).")\n";
   }
   mysql_free_result($rs);   
   mysql_close($con);
?>