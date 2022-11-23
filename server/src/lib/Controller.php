<?php

namespace Moi\App\Lib;

/**
 * Represents a controller
 * @class
 */
class Controller
{
    /**
     * GET method
     * @param string $param
     * @return mixed
     */
    protected function get(string $param): mixed
    {
        if (!isset($_GET[$param])) return NULL;

        return $_GET[$param];
    }

    /**
     * POST method
     * @param string $param
     * @return mixed
     */
    protected function post(string $param): mixed
    {
        if (!isset($_POST[$param])) return NULL;

        return $_POST[$param];
    }
};
