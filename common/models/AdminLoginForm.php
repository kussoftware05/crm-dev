<?php

namespace common\models;

/**
 * Login form
 */
class AdminLoginForm extends AbstractLoginForm
{
    /**
     * Finds a admin user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByUserNameAndType($this->username);
        }

        return $this->_user;
    }
}
