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
    public static function faker(array $tables, array $relations, array $users, array $addresses, array $roles, array $delivery)
    {
        echo 'In faker<br>';
        echo '------------<br>';

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
            echo 'В createTablesData.php нет таблиц!<br>';
        }

        foreach ($tables as $table => $columns) {
            self::createTable($table, $columns);

            if ($table == 'books') {
                self::populateBooks();
            }

            if ($table == 'categories') {
                self::populateCategories();
            }

            if ($table == 'users') {
                self::populateUsers($users);
            }

            if ($table == 'addresses') {
                self::populateAddresses($addresses);
            }

            if ($table == 'roles') {
                self::populateRoles($roles);
            }

            if ($table == 'deliveries') {
                self::populateDelivery($delivery);
            }

            if ($table == 'categories_books') {
                self::populateCategoriesBooks($relations);
            }

            if ($table == 'users_addresses') {
                self::populateUsersAddresses($relations);
            }

            if ($table == 'users_roles') {
                self::populateUsersRoles($relations);
            }
        }
    }

    public static function dropTable(string $table): bool
    {
        echo 'Drop table ' . $table . '<br>';
        echo '------------<br>';
        try {
            $result = self::$pdo->query("DROP TABLE IF EXISTS $table");
        } catch (PDOException $e) {
            $e->getMessage();
            return false;
        }

        return $result !== false;
    }

    public static function createTable(string $table, string $columns)
    {
        echo 'Create table ' . $table . '<br>';
        echo '------------<br>';
        try {
            $query = "CREATE TABLE $table ($columns)";
            self::$pdo->query($query);
        } catch (PDOException $e) {
            echo "Can't create table $table<br>" . $e->getMessage();
        }
    }

    public static function populateBooks()
    {
        echo 'Populate books<br>';
        echo '------------<br>';
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
                     = 'INSERT INTO books VALUES (null, :title, :authorName, :authorSurname, :description, :pages, :img, :price, now())';
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
        echo '------------<br>';
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
        echo 'Populate Categories_Books<br>';
        echo '------------<br>';
        foreach ($relations['categoriesBooksRelations'] as $category => $relations) {
            foreach ($relations as $r) {
                $query = "INSERT INTO categories_books VALUES ($category, $r)";
                self::$pdo->query($query);
            }
        }
    }

    public static function populateUsers(array $users)
    {
        echo 'Populate Users<br>';
        echo '------------<br>';
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
        echo 'Populate addresses<br>';
        echo '------------<br>';
        foreach ($addresses as $address) {
            $country   = $address['country'];
            $district  = $address['district'];
            $city      = $address['city'];
            $street    = $address['street'];
            $building  = $address['building'];
            $apartment = $address['apartment'];
            $postcode  = $address['postcode'];

            try {
                $query
                          = 'INSERT INTO addresses VALUES (null, :country, :district, :city, :street, :building, :apartment, :postcode)';
                $category = self::$pdo->prepare($query);
                $category->execute([
                  'country'   => $country,
                  'district'  => $district,
                  'city'      => $city,
                  'street'    => $street,
                  'building'  => $building,
                  'apartment' => $apartment,
                  'postcode'  => $postcode,
                ]);
            } catch (PDOException $e) {
                $e->getMessage();
            }
        }
    }

    public static function populateUsersAddresses(array $relations)
    {
        echo 'Populate Users_Addresses<br>';
        echo '------------<br>';
        foreach ($relations['usersAddressesRelations'] as $user => $relations) {
            foreach ($relations as $r) {
                $query = "INSERT INTO users_addresses VALUES ($user, $r)";
                self::$pdo->query($query);
            }
        }
    }

    public static function populateRoles(array $roles)
    {
        echo 'Populate Roles<br>';
        echo '------------<br>';
        foreach ($roles as $role) {
            $name        = $role['name'];
            $description = $role['description'];

            try {
                $query    = 'INSERT INTO roles VALUES (null, :name, :description)';
                $category = self::$pdo->prepare($query);
                $category->execute([
                  'name'        => $name,
                  'description' => $description,
                ]);
            } catch (PDOException $e) {
                $e->getMessage();
            }
        }
    }

    public static function populateUsersRoles($relations)
    {
        echo 'Populate Users_Roles<br>';
        echo '------------<br>';
        foreach ($relations['usersRolesRelations'] as $user => $relations) {
            foreach ($relations as $r) {
                $query = "INSERT INTO users_roles VALUES ($user, $r)";
                self::$pdo->query($query);
            }
        }
    }

    public static function populateDelivery(array $delivery)
    {
        echo 'Populate Delivery<br>';
        echo '------------<br>';
        foreach ($delivery as $d) {
            $deliveryMethod = $d['deliveryMethod'];
            $deliveryCost   = $d['deliveryCost'];

            try {
                $query = 'INSERT INTO deliveries VALUES (null, :deliveryMethod, :deliveryCost)';
                $stmt  = self::$pdo->prepare($query);
                $stmt->execute([
                  'deliveryMethod' => $deliveryMethod,
                  'deliveryCost'   => $deliveryCost,
                ]);
            } catch (PDOException $e) {
                echo 'Can\'t create delivery<br>' . $e->getMessage();
            }
        }
    }
}