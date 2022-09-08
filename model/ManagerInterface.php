<?php

namespace model;

interface ManagerInterface
{
    public function __construct(\PDO $db);
}