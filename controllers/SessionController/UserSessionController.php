<?php
require_once ROOT . '/models/Session/UserSession.php';

class UserSessionController
{
    private $userSession = null;

    public function __construct()
    {
        $this->userSession = new UserSession();
    }

    function create($user)
    {
        $this->userSession->create($user);
    }

    function read()
    {
        return $this->userSession->read();
    }

    function update($user)
    {
        $this->userSession->update($user);
    }

    function delete()
    {
        $this->userSession->delete();
    }

    public function setRoleUser()
    {
        $this->userSession->setRoleUser();
    }

    public function setRoleContentManager()
    {
        $this->userSession->setRoleContentManager();
    }

    public function setRoleSuperUser()
    {
        $this->userSession->setRoleSuperUser();
    }
}