<?php

namespace model;

interface ManagerInterface
{
    public function __construct(MyPDO $db);
}