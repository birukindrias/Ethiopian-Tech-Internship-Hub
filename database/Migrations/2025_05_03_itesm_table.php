<?php
    
    class itesm{
        public function up()
        {
           return "CREATE TABLE IF NOT EXISTS  itesm (
                      id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
                      username VARCHAR(50),
                      pimg VARCHAR(50),
                      email VARCHAR(50),
                      password VARCHAR(50)
           )
           ;";
        }
        public function down()
        {
           return  "DROP TABLE IF EXISTS  itesm;";
     }
    }
    