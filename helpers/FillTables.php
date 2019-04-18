<?php

/**
 * According to /sql/TablesData.php the class drop all tables from database then
 * create tables and populate it with faker https://github.com/fzaninotto/Faker
 */
class FillTables
{

    private static $pdo;

    private $tables = null;
    private $relations = null;
    private $users = null;
    private $addresses = null;
    private $roles = null;
    private $delivery = null;
    private $statuses = null;
    private $images = null;

    /**
     * This is main function, which need to be called to do all work.
     * The parameters must be assoc arrays of tables and relations.
     * The example of arrays is in /sql/TablesData.php
     *
     * @param array $tables
     * @param array $relations
     * @param array $users
     * @param array $addresses
     * @param array $roles
     * @param array $delivery
     * @param array $statuses
     * @param array $images
     */
    public static function faker(
      array $tables,
      array $relations,
      array $users,
      array $addresses,
      array $roles,
      array $delivery,
      array $statuses,
      array $images
    ) {
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

            if ($table == 'statuses') {
                self::populateStatus($statuses);
            }

            if ($table == 'images') {
                self::populateImages($images);
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

            if ($table == 'books_images') {
                self::populateBooksImages($relations);
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

        try {
            self::$pdo->beginTransaction();

            $query
                     = 'INSERT INTO books VALUES (null, :title, :authorName, :authorSurname, :description, :pages, :price, now(), null, :inStock, :quantity)';
            $article = self::$pdo->prepare($query);
            for ($i = 0; $i < 10; $i++) {

                $bookTitle     = $faker->sentence($nbWords = 6, $variableNbWords = true);
                $authorName    = $faker->sentence($nbWords = 1, $variableNbWords = true);
                $authorSurname = $faker->sentence($nbWords = 1, $variableNbWords = true);
                $description   = '';
                $pages         = rand(150, 1200);
                $price         = rand(10, 400);
                $inStock       = true;
                $quantity      = rand(1, 10);

                $desc = $faker->paragraphs($nb = 5, $asText = false);
                foreach ($desc as $d) {
                    $description .= $d . "<br>";
                }

                $article->execute([
                  'title'         => $bookTitle,
                  'authorName'    => $authorName,
                  'authorSurname' => $authorSurname,
                  'description'   => $description,
                  'pages'         => $pages,
                  'price'         => $price,
                  'inStock'       => $inStock,
                  'quantity'      => $quantity,
                ]);
            }
            self::$pdo->commit();
        } catch (PDOException $e) {
            self::$pdo->rollBack();
            echo 'Can\'t populate books<br>' . $e->getMessage();
        }
    }

    public static function populateCategories()
    {
        echo 'Populate categories<br>';
        echo '------------<br>';
        $faker = Faker\Factory::create();

        try {
            self::$pdo->beginTransaction();
            $query    = 'INSERT INTO categories VALUES (null, :name)';
            $category = self::$pdo->prepare($query);
            for ($i = 0; $i < 5; $i++) {
                $categoryName = $faker->sentence($nbWords = 1, $variableNbWords = true);
                $category->execute([
                  'name' => $categoryName,
                ]);
            }
            self::$pdo->commit();
        } catch (PDOException $e) {
            self::$pdo->rollBack();
            echo 'Can\'t populate categories<br>' . $e->getMessage();
        }

    }

    public static function populateCategoriesBooks(array $relations)
    {
        echo 'Populate Categories_Books<br>';
        echo '------------<br>';
        try {
            self::$pdo->beginTransaction();

            foreach ($relations['categoriesBooksRelations'] as $category => $relations) {
                foreach ($relations as $r) {
                    $query = "INSERT INTO categories_books VALUES ($category, $r)";
                    self::$pdo->query($query);
                }
            }
            self::$pdo->commit();
        } catch (PDOException $e) {
            self::$pdo->rollBack();
            echo 'Can\'t populate categories_books<br>' . $e->getMessage();
        }
    }

    public static function populateUsers(array $users)
    {
        echo 'Populate Users<br>';
        echo '------------<br>';

        try {
            self::$pdo->beginTransaction();
            $query    = 'INSERT INTO users VALUES (null, :name, :surname, null, :email, :password)';
            $category = self::$pdo->prepare($query);

            foreach ($users as $user) {
                $name     = $user['name'];
                $surname  = $user['surname'];
                $email    = $user['email'];
                $password = password_hash($user['password'], PASSWORD_DEFAULT);

                $category->execute([
                  'name'     => $name,
                  'surname'  => $surname,
                  'email'    => $email,
                  'password' => $password,
                ]);
            }
            self::$pdo->commit();
        } catch (PDOException $e) {
            self::$pdo->rollBack();
            echo 'Can\'t populate users<br>' . $e->getMessage();
        }
    }

    public static function populateAddresses(array $addresses)
    {
        echo 'Populate addresses<br>';
        echo '------------<br>';

        try {
            self::$pdo->beginTransaction();
            $query
                      = 'INSERT INTO addresses VALUES (null, :country, :district, :city, :street, :building, :apartment, :postcode)';
            $category = self::$pdo->prepare($query);

            foreach ($addresses as $address) {
                $country   = $address['country'];
                $district  = $address['district'];
                $city      = $address['city'];
                $street    = $address['street'];
                $building  = $address['building'];
                $apartment = $address['apartment'];
                $postcode  = $address['postcode'];

                $category->execute([
                  'country'   => $country,
                  'district'  => $district,
                  'city'      => $city,
                  'street'    => $street,
                  'building'  => $building,
                  'apartment' => $apartment,
                  'postcode'  => $postcode,
                ]);
            }
            self::$pdo->commit();
        } catch (PDOException $e) {
            self::$pdo->rollBack();
            echo 'Can\'t populate addresses<br>' . $e->getMessage();
        }
    }

    public static function populateUsersAddresses(array $relations)
    {
        echo 'Populate Users_Addresses<br>';
        echo '------------<br>';

        try {
            self::$pdo->beginTransaction();
            foreach ($relations['usersAddressesRelations'] as $user => $relations) {
                foreach ($relations as $r) {
                    $query = "INSERT INTO users_addresses VALUES ($user, $r)";
                    self::$pdo->query($query);
                }
            }
            self::$pdo->commit();
        } catch (PDOException $e) {
            self::$pdo->rollBack();
            echo 'Can\'t populate users_addresses<br>' . $e->getMessage();
        }

    }

    public static function populateRoles(array $roles)
    {
        echo 'Populate Roles<br>';
        echo '------------<br>';

        try {
            self::$pdo->beginTransaction();
            $query    = 'INSERT INTO roles VALUES (null, :name, :description)';
            $category = self::$pdo->prepare($query);

            foreach ($roles as $role) {
                $name        = $role['name'];
                $description = $role['description'];

                $category->execute([
                  'name'        => $name,
                  'description' => $description,
                ]);
            }

            self::$pdo->commit();
        } catch (PDOException $e) {
            self::$pdo->rollBack();
            echo 'Can\'t populate roles<br>' . $e->getMessage();
        }
    }

    public static function populateUsersRoles($relations)
    {
        echo 'Populate Users_Roles<br>';
        echo '------------<br>';

        try {
            self::$pdo->beginTransaction();

            foreach ($relations['usersRolesRelations'] as $user => $relations) {
                foreach ($relations as $r) {
                    $query = "INSERT INTO users_roles VALUES ($user, $r)";
                    self::$pdo->query($query);
                }
            }

            self::$pdo->commit();
        } catch (PDOException $e) {
            self::$pdo->rollBack();
            echo 'Can\'t populate users_roles<br>' . $e->getMessage();
        }
    }

    public static function populateDelivery(array $delivery)
    {
        echo 'Populate Delivery<br>';
        echo '------------<br>';

        try {
            self::$pdo->beginTransaction();
            $query = 'INSERT INTO deliveries VALUES (null, :deliveryMethod, :deliveryCost)';
            $stmt  = self::$pdo->prepare($query);
            foreach ($delivery as $d) {
                $deliveryMethod = $d['deliveryMethod'];
                $deliveryCost   = $d['deliveryCost'];

                $stmt->execute([
                  'deliveryMethod' => $deliveryMethod,
                  'deliveryCost'   => $deliveryCost,
                ]);
            }
            self::$pdo->commit();
        } catch (PDOException $e) {
            self::$pdo->rollBack();
            echo 'Can\'t populate delivery<br>' . $e->getMessage();
        }
    }

    public static function populateStatus(array $statuses)
    {
        echo 'Populate Status<br>';
        echo '------------<br>';

        try {
            self::$pdo->beginTransaction();
            $query = 'INSERT INTO statuses VALUES (null, :status)';
            $stmt  = self::$pdo->prepare($query);

            foreach ($statuses as $status) {
                $status = $status['status'];

                $stmt->execute([
                  'status' => $status,
                ]);
            }
            self::$pdo->commit();
        } catch (PDOException $e) {
            self::$pdo->rollBack();
            echo 'Can\'t populate status<br>' . $e->getMessage();
        }
    }

    public static function populateImages(array $images)
    {
        echo 'Populate Images<br>';
        echo '------------<br>';

        try {
            self::$pdo->beginTransaction();
            $query = 'INSERT INTO images (path) VALUES (:path)';
            $stmt  = self::$pdo->prepare($query);
            foreach ($images as $i) {
                $path = $i;

                $stmt->execute([
                  'path' => $path
                ]);
            }
            self::$pdo->commit();
        } catch (PDOException $e) {
            self::$pdo->rollBack();
            echo 'Can\'t populate images<br>' . $e->getMessage();
        }
    }

    public static function populateBooksImages($relations)
    {
        echo 'Populate Books_Images<br>';
        echo '------------<br>';

        try {
            self::$pdo->beginTransaction();

            foreach ($relations['booksImagesRelations'] as $book => $relations) {
                foreach ($relations as $r) {
                    $query = "INSERT INTO books_images (book_id, image_id) VALUES ($book, $r)";
                    self::$pdo->query($query);
                }
            }

            self::$pdo->commit();
        } catch (PDOException $e) {
            self::$pdo->rollBack();
            echo 'Can\'t populate books_images<br>' . $e->getMessage();
        }
    }

    /**
     * @return null
     */
    public function getTables()
    {
        return $this->tables;
    }

    /**
     * @param null $tables
     */
    public function setTables($tables): void
    {
        $this->tables = $tables;
    }

    /**
     * @return null
     */
    public function getRelations()
    {
        return $this->relations;
    }

    /**
     * @param null $relations
     */
    public function setRelations($relations): void
    {
        $this->relations = $relations;
    }

    /**
     * @return null
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @param null $users
     */
    public function setUsers($users): void
    {
        $this->users = $users;
    }

    /**
     * @return null
     */
    public function getAddresses()
    {
        return $this->addresses;
    }

    /**
     * @param null $addresses
     */
    public function setAddresses($addresses): void
    {
        $this->addresses = $addresses;
    }

    /**
     * @return null
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param null $roles
     */
    public function setRoles($roles): void
    {
        $this->roles = $roles;
    }

    /**
     * @return null
     */
    public function getDelivery()
    {
        return $this->delivery;
    }

    /**
     * @param null $delivery
     */
    public function setDelivery($delivery): void
    {
        $this->delivery = $delivery;
    }

    /**
     * @return null
     */
    public function getStatuses()
    {
        return $this->statuses;
    }

    /**
     * @param null $statuses
     */
    public function setStatuses($statuses): void
    {
        $this->statuses = $statuses;
    }


}