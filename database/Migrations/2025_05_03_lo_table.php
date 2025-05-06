<?php
    
  class lo{
      public function up()
      {
         return "CREATE TABLE IF NOT EXISTS  lo (
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    username TEXT NOT NULL,
                    email TEXT NOT NULL,
                    password TEXT NOT NULL
         );";
      }
      public function down()
      {
         return  "DROP TABLE IF EXISTS  lo;";
   }
  }
  