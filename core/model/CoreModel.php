<?php 
require_once 'database/DatabaseDriver.php';

class CoreModel extends DatabaseDriver {
    function __construct() {
        parent::__construct();
    }

    public function selectFirst($fieldValue, $table) {
        if($fieldValue) {
            $field = isset(array_keys($fieldValue)[0]) ? array_keys($fieldValue)[0] : false;
            $value = isset(array_values($fieldValue)[0]) ? array_keys($fieldValue)[0] : false;
            if($field && $value) {
                $stmt = $this->_pdo->prepare('SELECT * FROM ' . $table . ' WHERE ' . $field . ' = :' . $field);
                $stmt->execute($fieldValue);
                return $stmt->fetch();
            }
        }
        return false;
    }

    public function save($fieldsToSave, $table) {
        if($fieldsToSave) {
            if(is_array($fieldsToSave)) {
                foreach ($fieldsToSave as $key => $value) {
                    if(!$key || !$value) {
                        return false;
                    }
                }
                $keys = array_keys($fieldsToSave);
                $fields = implode(',', $keys);
                foreach ($keys as $key => $value) {
                    $keys[$key] = ':' . $value;
                }
                $values = implode(',', $keys);
                if ($fields && $values) {
                    $sql = 'INSERT INTO ' . $table . ' (' . $fields . ',created_at,updated_at) VALUES (' . $values . ',:created_at,:updated_at)';
                    $stmt = $this->_pdo->prepare($sql);
                    $fieldsToSave['created_at'] = $fieldsToSave['updated_at'] = date('Y-m-d h:i:s');
                    $stmt->execute($fieldsToSave);
                    return $this->_pdo->lastInsertId();
                }
            }
        }
        return false;
    }

    public function selectWhere($fields, $table) {
        if($fields) {
            if(is_array($fields)) {
                foreach ($fields as $key => $value) {
                    if(!$key || !$value) {
                        return false;
                    }
                }
                $where = array();
                $firstKey = array_keys($fields)[0];
                foreach ($fields as $field => $value) {
                    if ($field == $firstKey) {
                        $where[] = $field . '=:' . $field; 
                    } else {
                        $where[] = ' AND ' . $field . '=:' . $field; 
                    }
                }
                $where = implode('', $where);
                $sqlQuery = 'SELECT * FROM ' . $table . ' WHERE ' . $where;
                $stmt = $this->_pdo->prepare($sqlQuery);
                $stmt->execute($fields);
                return $stmt->fetchAll();
            }
        }
        return false;
    }
}