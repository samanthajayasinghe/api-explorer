<?php

/**
 * @author Samantha Jayasinghe
 *
 * Adapter interface
 */

namespace APIExplorer\Adapter;

interface IAdapter
{

    /**
     * @return get Access token
     */
    public function getAuthorizationUrl();

    /**
     * @return Execute end point
     */
    public function executeEndPoint();

    /**
     * @param $type
     * @param $params
     *
     * @return mixed
     */
    public function getAccessToken($type, $params=array());
}
