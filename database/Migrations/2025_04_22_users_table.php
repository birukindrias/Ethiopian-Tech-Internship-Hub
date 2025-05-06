<?php
    
    class users{
        public function up()
        {
           return "CREATE TABLE IF NOT EXISTS  users (
                      id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
                      name VARCHAR(50),
                      pimg VARCHAR(50),
                      email VARCHAR(50),
                      password VARCHAR(50)
           )
           ;";
        }
        public function down()
        {
           return  "DROP TABLE IF EXISTS  users;";
     }
    }
    