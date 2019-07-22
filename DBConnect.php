<?php

    class Database
    {
        private $_host='localhost';
        private $_port=3306;
        private $_username='root';
        private $_password='';
        private $_dbname='manager_cabaret';
        private $_options=array(
            PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_OBJ,
            PDO::ATTR_EMULATE_PREPARES=>false,
            PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8'
        );

        private $_query;
        private $_cursor = NULL;
        private static $_instance;

        private function getInstance()
        {
            if (!self::$_instance) {
                try {
                    self::$_instance=new PDO(
                        "mysql:host={$this->_host}; port={$this->_port}; dbname={$this->_dbname}",
                        $this->_username,
                        $this->_password,
                        $this->_options);
                } catch (PDOException $errorConnect) {
                    throw new PDOException($errorConnect->getMessage(), $errorConnect->getCode());
                }
            }
            return self::$_instance;
        }

        protected function setQuery($query) {
            $this->_query = $query;
        }

        protected function executeQuery($params)
        {
            $this->_cursor = $this->getInstance()->prepare($this->_query);
            $this->_cursor->execute($params);
            return $this->_cursor;
        }

        protected function loadAllRows($params) {
            $this->_cursor = $this->getInstance()->prepare($this->_query);
            if (!$result = $this->_cursor->execute($params)) {
                return false;
            }
            return $this->_cursor->fetchAll();
        }

        protected function loadRow($params) {
            $this->_cursor = $this->getInstance()->prepare($this->_query);
            if (!$result = $this->_cursor->execute($params)) {
                return false;
            }
            return $this->_cursor->fetch();
        }
        protected function loadCount($params) {
            $this->_cursor = $this->getInstance()->prepare($this->_query);
            if (!$result = $this->_cursor->execute($params)) {
                return false;
            }
            return $this->_cursor->rowCount();
        }

        protected function disconnect() {
            self::$_instance = null;
        }

    }
