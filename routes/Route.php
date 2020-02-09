<?php


class Route
{
    private static string $uri;
    private static string $uriParams;
    private static array $foundOrNotFound = [];
    private static bool $isError;

    public function run()
    {
        include_once 'web.php';

        self::pageNotFound();
    }

    public static function get(string $uri, string $controller)
    {
        if ($uri == self::getUri()) {
            $array = explode('@', $controller);
            $class = $array[0];
            $method = $array[1];

            self::instantiateClassAndMethod($class, $method);
        } else {
            self::$isError = false;
            array_unshift(self::$foundOrNotFound, false);
        }
    }

    private static function instantiateClassAndMethod(string $class, string $method)
    {
        if (class_exists($class, true)) {
            $controller = new $class();

            if (method_exists($controller, $method)) {
                array_unshift(self::$foundOrNotFound, true);
                $controller->$method();
            } else {
                self::throwException($class, $method);
            }
        } else {
            self::throwException($class, $method);
        }
    }

    private static function pageNotFound()
    {
        if (!self::$isError && !in_array(true, self::$foundOrNotFound)) echo '404';
    }

    private static function throwException(string $class, string $method)
    {
        if(!$method) {
            self::$isError = true;
            echo 'Method ' . $method . '() not found in ' . $class . '<br>';
            echo 'File: ' . __FILE__ . '<br>';
            echo 'Class: ' . __CLASS__ . '<br>';
            echo 'Line: ' . __LINE__ . '<br>';
        } else {
            self::$isError = true;
            echo 'Class ' . $class . ' not found ' . '<br>';
            echo 'File: ' . __FILE__ . '<br>';
            echo 'Class: ' . __CLASS__ . '<br>';
            echo 'Line: ' . __LINE__ . '<br>';
        }
    }

    public static function name(string $routeName)
    {

    }

    /**
     * @return string
     */
    public static function getUri(): string
    {
        self::setUri();

        return self::$uri;
    }

    /**
     */
    public static function setUri(): void
    {
        $uri = explode('?', $_SERVER['REQUEST_URI']);
        self::$uri = $uri[0];
    }

    /**
     * @return string
     */
    public function getUriParams(): string
    {
        $this->setUriParams();

        return self::$uriParams;
    }

    /**
     */
    public function setUriParams(): void
    {
        $this->uriParams = $_SERVER['QUERY_STRING'];
    }


}