<?php
require_once ROOT . '/models/Address.php';


class AddressController
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