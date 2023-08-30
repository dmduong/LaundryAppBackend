<?php

namespace App\Exceptions;

use Exception;

class ResourceNotFoundException extends Exception
{
    protected $resourceType;

    public function __construct($message = 'Resource not found.', $resourceType = 'Resource')
    {
        parent::__construct($message);
        $this->resourceType = $resourceType;
    }

    public function getResourceType()
    {
        return $this->resourceType;
    }
}
