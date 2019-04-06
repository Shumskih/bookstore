<?php
require_once ROOT . '/models/Model.php';

class Delivery implements Model
{

    private $id = null;

    private $deliveryMethod = null;

    private $deliveryCost = null;

    private $pdo = null;

    public function __construct()
    {
        $this->pdo = ConnectionUtil::getConnection();
    }

    function create($model)
    {
        // TODO: Implement create() method.
    }

    function read($id)
    {
        // TODO: Implement read() method.
    }

    function readAll()
    {
        try {
            $query      = SqlQueries::GET_ALL_DELIVERIES;
            $deliveries = $this->pdo->query($query)->fetchAll();
        } catch (PDOException $e) {
            echo 'Can\'t get all deliveries<br>' . $e->getMessage();
        }

        return $deliveries;
    }

    function update($model)
    {
        // TODO: Implement update() method.
    }

    function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function getDeliveryByMethod($deliveryMethod) : \Delivery
    {
        try {
            $query = SqlQueries::GET_DELIVERY_BY_METHOD;
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([
              'deliveryMethod' => $deliveryMethod
            ]);
        } catch (PDOException $e) {
            echo 'Can\'t get delivery by method<br>' . $e->getMessage();
        }

        $result = $stmt->fetch();

        $this->id = $result['id'];
        $this->deliveryMethod = $result['deliveryMethod'];
        $this->deliveryCost = $result['deliveryCost'];

        unset($result);

        return $this;
    }

    /**
     * @return null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param null $deliveryId
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return null
     */
    public function getDeliveryMethod()
    {
        return $this->deliveryMethod;
    }

    /**
     * @param null $deliveryMethod
     */
    public function setDeliveryMethod($deliveryMethod): void
    {
        $this->deliveryMethod = $deliveryMethod;
    }

    /**
     * @return null
     */
    public function getDeliveryCost()
    {
        return $this->deliveryCost;
    }

    /**
     * @param null $deliveryCost
     */
    public function setDeliveryCost($deliveryCost): void
    {
        $this->deliveryCost = $deliveryCost;
    }


}