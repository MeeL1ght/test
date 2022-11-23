<?php

namespace Moi\App\Utils;

/**
 * Represents a UUID
 * @class
 */
class UUID
{
    /**
     * Create a UUID | strlen: 13
     * @return string
     */
    public static function create(): string
    {
        return uniqid();
    }
};
