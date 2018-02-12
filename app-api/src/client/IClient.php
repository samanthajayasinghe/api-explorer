<?php
/**
 * @author Samantha Jayasinghe
 *
 * Http Client interface
 */

namespace APIExplorer\Client;

interface IClient
{
    /**
     * @param HTTPRequest $request
     *
     * @return HTTPResponse
     */
    public function get(HTTPRequest $request);
    /**
     * @param HTTPRequest $request
     *
     * @return HTTPResponse
     */
    public function post(HTTPRequest $request);
    /**
     * @param HTTPRequest $request
     *
     * @return HTTPResponse
     */
    public function put(HTTPRequest $request);
    /**
     * @param HTTPRequest $request
     *
     * @return HTTPResponse
     */
    public function delete(HTTPRequest $request);
}
