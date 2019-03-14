<?php
require_once 'consts.php';
require_once 'ConnectionUtil.php';
require_once ROOT . '/sql/SqlQueries.php';

class CheckUser
{

    private static $pdo;

    public static function isUserExists($email, $password)
    {
        try {
            $query     = SqlQueries::GET_USER;
            self::$pdo = ConnectionUtil::getConnection();
            $stmt      = self::$pdo->prepare($query);
            $stmt->execute([
              'email'    => $email,
              'password' => $password
            ]);
        } catch (PDOException $e) {
            echo 'Can\'t get user from database<br>' . $e->getMessage();
        }

        $user = $stmt->fetch();

        if (empty($user)) {
            return false;
        }

        return true;
    }

    public static function isEmailExists($email)
    {
        try {
            $query     = SqlQueries::GET_EMAIL;
            self::$pdo = ConnectionUtil::getConnection();
            $stmt      = self::$pdo->prepare($query);
            $stmt->execute([
              'email'    => $email
            ]);
        } catch (PDOException $e) {
            echo 'Can\'t get user from database<br>' . $e->getMessage();
        }

        $user = $stmt->fetch();

        if (empty($user)) {
            return false;
        }

        return true;
    }
}