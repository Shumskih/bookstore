<?php
require_once ROOT . '/models/Address.php';
require_once ROOT . '/controllers/Controller.php';


class AddressController extends Controller
{
    private $address;

    public function __construct()
    {
        $this->address = new Address();
    }

    public function update($address)
    {
        $this->address->update($address);
    }
}