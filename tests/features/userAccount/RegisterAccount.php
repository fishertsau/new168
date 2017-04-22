<?php


trait RegisterAccount
{
    protected function registerAccount(array $params)
    {
        return $this->json('post', "/register", $params);
    }
}