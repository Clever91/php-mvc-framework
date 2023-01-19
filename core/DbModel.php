<?php

namespace app\core;

use app\core\interface\IDbModel;
use PDO;

abstract class DbModel extends Model implements IDbModel
{
    private PDO $pdo;
    
    public function __construct()
    {
        $this->pdo = Application::$app->db->pdo;
        parent::__construct();
    }
    
    //It is possibale that the child can overrite this method
    protected function beforeSave(): bool
    {
        return true;
    }

    public function validate(): bool
    {
        if (!parent::validate()) {
            return false;
        }
        foreach ($this->rules() as $attribute => $rules) {
            $value = $this->{$attribute};
            foreach ($rules as $rule) {
                $ruleName = $rule;
                if (is_array($rule)) {
                    $ruleName = $rule[0];
                }
                if ($ruleName === self::RULE_UNIQUE) {
                    $className = $rule["class"] ?? get_called_class();
                    $uniqueAttr = $rule["attribute"] ?? $attribute;
                    $tableName = $className::tableName();
                    $sql = "SELECT * FROM {$tableName} WHERE $uniqueAttr = :attribute";
                    $statement = $this->pdo->prepare($sql);
                    $statement->bindValue(":attribute", $value);
                    $statement->execute();
                    if ($statement->fetchObject()) {
                        $params = is_array($rule) ? $rule : ["class" => $className, "attribute" => $uniqueAttr];
                        $this->addRuleError($attribute, self::RULE_UNIQUE, $params);
                    }
                }
            }
        }
        return empty($this->getErrors());
    }

    final public function save(): bool
    {
        if ($this->beforeSave()) {
            $params = [];
            $values = [];
            foreach ($this->attributes() as $attribute) {
                $params[$attribute] = $this->{$attribute};
                $values[] = ":{$attribute}";
            }
            $tableName = $this->tableName();
            $values = implode(",", $values);
            $columns = implode(",", $this->attributes());
            $sql = "INSERT INTO {$tableName}({$columns}) VALUES({$values})";
            $statement = $this->pdo->prepare($sql);
            foreach ($params as $key => $value)
                $statement->bindValue($key, $value);
            $statement->execute();
            return true;
        }
        return false;
    }
}