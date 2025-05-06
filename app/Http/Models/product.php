<?php
namespace App\App\models;

use App\config\Model;
class Product extends Model 
{
  

    public static function tableName(): string
    {
        return "products";
    }
    public function rules(): array
    {
        return [
          "product"=> [self::RULE_REQUIRED],
        ];
    }
    public function attrs(): array
    {
        return [
           

        ];
    }
      
}
