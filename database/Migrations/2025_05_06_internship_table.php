<?php
                
              class internship{
                  public function up()
                  {
                    return "CREATE TABLE IF NOT EXISTS  internship (
                                id INTEGER PRIMARY KEY AUTOINCREMENT,
                                `name`  TEXT NOT NULL ,
                                website  TEXT NOT NULL ,
                                `address`  TEXT NOT NULL ,
                                paid  TEXT NOT NULL ,
                                techStack  TEXT NOT NULL ,
                                duration  TEXT NOT NULL ,
                                appliedVia  TEXT NOT NULL ,
                                recruitmentProcess  TEXT NOT NULL ,
                                examDetails  TEXT NOT NULL ,
                                extraAdvice  TEXT NOT NULL ,
                                project  TEXT NOT NULL ,
                                realProject  TEXT NOT NULL ,
                                schedule  TEXT NOT NULL ,
                                mentorship  TEXT NOT NULL ,
                                environment  TEXT NOT NULL ,
                                `certificate`  TEXT NOT NULL ,
                                suggestion  TEXT NOT NULL ,
                                fullTimePossibility  TEXT NOT NULL 
                    );";
                  }
                  public function down()
                  {
                    return  "DROP TABLE IF EXISTS  internship;";
              }
              } 
  