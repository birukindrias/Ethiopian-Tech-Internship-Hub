<?php

namespace App\config;

class Request
{
    protected array $data;

    public function __construct()
    {
        $this->data = $_POST ?: [];

    // Then check for JSON data from php://input
    if (empty($this->data)) {
        $this->data = json_decode(file_get_contents('php://input'), true) ?: [];
    }

    // Finally, fallback to GET data if POST and JSON are both empty
    if (empty($this->data)) {
        $this->data = $_GET;
    }

    // Debug output to see the data
    // var_dump($this->data);
    // return $this->data;
    }

    public function get($key, $default = null)
    {
        return $this->data[$key] ?? $default;
    }

    public function all()
    {
        return $this->data;
    }

    public function validate(array $rules)
    {
        $errors = [];
        $validated = [];

        foreach ($rules as $field => $ruleString) {
            $value = $this->get($field);
            $rulesArray = explode('|', $ruleString);

            foreach ($rulesArray as $rule) {
                $ruleName = $rule;
                $param = null;

                if (str_contains($rule, ':')) {
                    [$ruleName, $param] = explode(':', $rule, 2);
                }

                switch ($ruleName) {
                    case 'required':
                        if (empty($value)) {
                            $errors[$field][] = 'Field is required.';
                        }
                        break;

                    case 'max':
                        if (strlen($value) > (int)$param) {
                            $errors[$field][] = "Must be at most $param characters.";
                        }
                        break;

                    case 'min':
                        if (strlen($value) < (int)$param) {
                            $errors[$field][] = "Must be at least $param characters.";
                        }
                        break;

                    case 'email':
                        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                            $errors[$field][] = "Invalid email format.";
                        }
                        break;

                    case 'string':
                        if (!is_string($value)) {
                            $errors[$field][] = "Must be a string.";
                        }
                        break;

                    case 'unique':
                        [$table, $column] = explode(',', $param);
                        // Assuming DB::table()->where()->exists() returns bool
                        if (\App\config\Database::table($table)->where($column, $value)->exists()) {
                            $errors[$field][] = "Already taken.";
                        }
                        break;
                }
            }

            $validated[$field] = $value;
        }

        if (!empty($errors)) {
            http_response_code(422);
            echo json_encode(['errors' => $errors]);
            exit;
            // return false;
        }

        return $validated;
    }
}
