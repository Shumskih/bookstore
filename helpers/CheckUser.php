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

        $result = $stmt->fetch();

        if (empty($result)) {
            return false;
        } else {
            $user = self::userFactory($result['id'],
              $result['name'],
              $result['surname'],
              $result['mobile_phone'],
              $result['email']);
        }

        return $user;
    }

    public static function userFactory($id, $name, $surname, $mobilePhone, $email) : \User
    {
        $user = new User();
        $user->setId($id);
        $user->setName($name);
        $user->setSurname($surname);
        $user->setMobilePhone($mobilePhone);
        $user->setEmail($email);

        return $user;
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