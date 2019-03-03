<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/consts.php';


/**
 * According to /sql/tablesData.php the class drop all tables from database then
 * create tables and populate it with faker https://github.com/fzaninotto/Faker
 */
class FillTables
{

  private static $pdo;

  /**
   * This is main function, which need to be called to do all work.
   * The parameters must be assoc arrays of tables and relations.
   * The example of arrays is in /sql/tablesData.php
   *
   * @param array $tables
   * @param array $relations
   *
   */
  public static function faker(array $tables, array $relations, array $users, array $addresses)
  {
    echo 'In faker<br>';

    self::$pdo = ConnectionUtil::getConnection();

    $count = count($tables);

    if ($count > 0) {
      foreach ($tables as $table => $columns) {
        if (substr_count($table, '_') > 0) {
          self::dropTable($table);
        }
      }

      foreach ($tables as $table => $columns) {
        self::dropTable($table);
      }
    } else {
      echo 'В createTablesData.php нет таблиц!';
    }

    foreach ($tables as $table => $columns) {
      self::createTable($table, $columns);

      if ($table == 'books') {
        self::populateBooks();
      }

      if ($table == 'categories') {
        self::populateCategories();
      }

      if ($table == 'categories_books') {
        self::populateCategoriesBooks($relations);
      }

      if ($table == 'users') {
        self::populateUsers($users);
      }

      if ($table == 'addresses') {
        self::populateAddresses($addresses);
      }

      if ($table == 'users_addresses') {
        self::populateUsersAddresses($relations);
      }

      //        if ($table == 'users_articles')
      //            populateUsersArticles($pdo, $relations);
    }
  }

  public static function populateBooks()
  {
    echo 'populate books<br>';
    $faker = Faker\Factory::create();

    for ($i = 0; $i < 10; $i++) {

      $bookTitle     = $faker->sentence($nbWords = 6, $variableNbWords = true);
      $authorName    = $faker->sentence($nbWords = 1, $variableNbWords = true);
      $authorSurname = $faker->sentence($nbWords = 1, $variableNbWords = true);
      $description   = '';
      $pages         = rand(150, 1200);
      $img           = '';
      $price         = rand(10, 400);

      $desc = $faker->paragraphs($nb = 5, $asText = false);
      foreach ($desc as $d) {
        $description .= $d . "<br>";
      }

      $query
               = 'INSERT INTO books VALUES (null, :title, :authorName, :authorSurname, :description, :pages, :img, :price)';
      $article = self::$pdo->prepare($query);
      $article->execute([
        'title'         => $bookTitle,
        'authorName'    => $authorName,
        'authorSurname' => $authorSurname,
        'description'   => $description,
        'img'           => $img,
        'pages'         => $pages,
        'price'         => $price,
      ]);
    }
  }

  public static function populateCategories()
  {
    echo 'Populate categories<br>';
    $faker = Faker\Factory::create();

    for ($i = 0; $i < 5; $i++) {

      $categoryName = $faker->sentence($nbWords = 1, $variableNbWords = true);

      $query    = 'INSERT INTO categories VALUES (null, :name)';
      $category = self::$pdo->prepare($query);
      $category->execute([
        'name' => $categoryName,
      ]);
    }
  }

  public static function populateCategoriesBooks(array $relations)
  {
    foreach ($relations['categoriesBooksRelations'] as $category => $relations)
    {
      foreach ($relations as $r) {
        $query = "INSERT INTO categories_books VALUES ($category, $r)";
        self::$pdo->query($query);
      }
    }
  }

  public static function populateUsers(array $users)
  {
    foreach ($users as $user) {
      $name     = $user['name'];
      $surname  = $user['surname'];
      $email    = $user['email'];
      $password = md5($user['password'] . 'bookstore');

      try {
        $query
                  = 'INSERT INTO users VALUES (null, :name, :surname, null, :email, :password)';
        $category = self::$pdo->prepare($query);
        $category->execute([
          'name'     => $name,
          'surname'  => $surname,
          'email'    => $email,
          'password' => $password,
        ]);
      } catch (PDOException $e) {
        $e->getMessage();
      }
    }
  }

  public static function populateAddresses(array $addresses)
  {
    foreach ($addresses as $address) {
      $country   = $address['country'];
      $region    = $address['region'];
      $city      = $address['cuty'];
      $street    = $address['street'];
      $building  = $address['building'];
      $apartment = $address['apartment'];

      try {
        $query = 'INSERT INTO addresses VALUES (null, :country, :region, :city, :street, :building, :apertment)';
        $category = self::$pdo->prepare($query);
        $category->execute([
          'country'   => $country,
          'region'    => $region,
          'city'      => $city,
          'street'    => $street,
          'building'  => $building,
          'apartment' => $apartment,
        ]);
      } catch (PDOException $e) {
        $e->getMessage();
      }
    }
  }

  public static function populateUsersAddresses(array $relations)
  {
      foreach ($relations['usersAddressesRelations'] as $user => $relations) {
          foreach ($relations as $r) {
              $query = "INSERT INTO users_addresses VALUES ($user, $r)";
              self::$pdo->query($query);
          }
      }
  }

  //function populateUsersArticles(PDO $pdo, array $relations)
  //{
  //    foreach ($relations['usersArticlesRelations'] as $user => $relations) {
  //        foreach ($relations as $r) {
  //            $query = "INSERT INTO users_articles VALUES ($user, $r)";
  //            $pdo->query($query);
  //        }
  //    }
  //}
  //
  //function isTableExists(PDO $pdo, string $table) : bool
  //{
  //    try {
  //        $result = $pdo->query("SELECT * from $table LIMIT 1");
  //    } catch (Exception $e) {
  //        return false;
  //    }
  //
  //    return $result !== false;
  //}
  //
  public static function dropTable(string $table): bool
  {
    echo 'Drop table<br>';
    try {
      $result = self::$pdo->query("DROP TABLE IF EXISTS $table");
    } catch (PDOException $e) {
      $e->getMessage();
      return false;
    }

    return $result !== false;
  }
  //
  //function tablesList(PDO $pdo) {
  //    $query = 'SHOW TABLES';
  //    $tables = [];
  //
  //    try {
  //        $query = $pdo->query($query);
  //    } catch (PDOException $e) {
  //        echo 'Ошибка извлечения списка таблиц';
  //    }
  //
  //    while ($t = $query->fetch()) {
  //        array_push($tables, $t[0]);
  //    }
  //
  //    return $tables;
  //}
  //
  public static function createTable(string $table, string $columns)
  {
    echo 'Create table<br>';
    try {
      $query = "CREATE TABLE $table ($columns)";
      self::$pdo->query($query);
    } catch (PDOException $e) {
      echo "Can't create table $table<br>" . $e->getMessage();
    }
  }
}