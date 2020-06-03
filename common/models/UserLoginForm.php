<?php

namespace common\models;

class UserLoginForm extends AbstractLoginForm
{
    /**
     * Finds a normal user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByUserNameAndType($this->username,'NORMAL');
        }

        return $this->_user;
    }
}