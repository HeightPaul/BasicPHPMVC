<?php

namespace test\libs;

/**
 * @brief   request class for accessing POST,GET, URI parameters.
 */

class Request
{
    /**
     * @brief    Getter for URI.
     *
     * @return   string
     */

    public function getUri()
    {
        return $_SERVER['REQUEST_URI'];
    }

    /**
     * @brief    Getter for GET request with all its parameters from URI.
     *
     * @return   array
     */

    public function getQueryParams()
    {
        return $_GET;
    }

    /**
     * @brief    getter for POST request with all its parameters from URI.
     *
     * @return   array
     */

    public function getPostParams()
    {
        return $_POST;
    }
}