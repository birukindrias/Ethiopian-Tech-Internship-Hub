<?php
namespace App\config;
trait Texts
{
   public  $filemig = '<?php
    use App\config\App;
    
    class ' . lcfirst($filename) . '{
        public function up()
        {
            $SQL_QUERY = "CREATE TABLE IF NOT EXISTS  ' . lcfirst($filename) . ' (
                      id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
                      username VARCHAR(50),
                      pimg VARCHAR(50),
                      email VARCHAR(50),
                      password VARCHAR(50)
           )
           ENGINE = INNODB;";
            App::$app->database->pdo->exec($SQL_QUERY);
            App::$app->database->log("' . lcfirst($filename) . 's Table Created");
    
        }
        public function down()
        {
           $SQL_QUERY = "DROP TABLE IF EXISTS  ' . lcfirst($filename) . ';";
           App::$app->database->log("Droping ' . lcfirst($filename) . '");
           App::$app->database->pdo->exec($SQL_QUERY);
        }
    }
    ';
}
