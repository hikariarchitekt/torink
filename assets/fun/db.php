<?php

    class DB{
                private static function connect() {
                $pdo = new PDO('mysql:host=u-cdbr-west-03.cleardb.net;dbname=heroku_6f99952be751037;charset=utf8', 'bf94901823e79d', '1ea1dacc');
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $pdo;
        }

        public static function query($query,$params=array()) {
                $statement = self::connect()->prepare($query);
                $statement->execute($params);
                if (explode(' ', $query)[0] == 'SELECT') {
                $data = $statement->fetchAll();
                return $data;
                }
        }
    }
