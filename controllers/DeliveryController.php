<?php
require_once ROOT . '/models/Delivery.php';
require_once ROOT . '/controllers/Controller.php';

class DeliveryController extends Controller
{
    private $delivery = null;

    public function __construct()
    {
        $this->delivery = new Delivery();
    }

    public function readAll()
    {
        return $this->delivery->readAll();
    }

    public function getDeliveryByMethod($deliveryMethod)
    {
        return $this->delivery->getDeliveryByMethod($deliveryMethod);
    }

    /**
     * @return null
     */
    public function getDeliveryMethod()
    {
        return $this->delivery->getDeliveryMethod();
    }

    /**
     * @param null $deliveryMethod
     */
    public function setDeliveryMethod($deliveryMethod): void
    {
        $this->delivery->setDeliveryMethod($deliveryMethod);
    }

    /**
     * @return null
     */
    public function getDeliveryCost()
    {
        return $this->delivery->getDeliveryCost();
    }

    /**
     * @param null $deliveryCost
     */
    public function setDeliveryCost($deliveryCost): void
    {
        $this->delivery->setDeliveryCost($deliveryCost);
    }
}