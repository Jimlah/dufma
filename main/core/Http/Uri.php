<?php

namespace App\Core\Http;

use InvalidArgumentException;

use App\Core\Interfaces\UriInterface;

class Uri implements UriInterface
{
    /**
     * Url host name
     * 
     * @var string
     */
    private $host = '';

    /**
     * Url scheme
     * 
     * @var string
     */
    private $scheme = '';

    /**
     * Query string
     * 
     * @var string
     */
    private $query = '';

    /**
     * Url port
     * 
     * @var int|null
     */
    private $port = null;

    /**
     * Url pathname
     * 
     * @var string
     */
    private $path = '/';

    /**
     * Query string in array format
     * 
     * @var string[]
     */
    private $parsed_query;
    
    /**
     * Uri constructor
     * 
     * @param string|null $url
     */
    public function __construct($url = null)
    {
        if($url) $this->parse($url);
    }

    /**
     * Uri behaviour when treated as string
     * 
     * @return string
     */
    public function __toString() {
        return $this->getFullUrl();
    }

    /**
     * Return full url
     * 
     * @return string
     */
    public function getFullUrl()
    {
        $query = ($this->query) ? '?' . $this->query : '';
        return $this->getUrl() . $query;
    }

    /**
     * Get url pathname
     * 
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Get url port
     * 
     * @return int|null
     */
    public function getPort() {
        return $this->port;
    }

    /**
     * Returns url without query string
     * 
     * @return string
     */
    public function getUrl($with_scheme = true)
    {
        $url = $with_scheme ?$this->scheme : '';
        $url .= '://' . $this->host . $this->path;

        return $url;
    }

    /**
     * Returns url without scheme
     * 
     * @return string
     */
    public function getUrlWithoutScheme() {
        return $this->getUrl(false);
    }

    /**
     * Return url host name
     * 
     * @return string
     */
    public function getHost() {
        return $this->host;
    }

    /**
     * Return url scheme
     * 
     * @return string
     */
    public function getScheme() {
        return $this->scheme;
    }

    /**
     * Return query
     * 
     * @param name
     * 
     * @return string
     */
    public function getQuery($name) {
        return $this->parsed_query[$name] ?? null;
    }

    /**
     * Return query params
     * 
     * @return string
     */
    public function getQueryParams() {
        return $this->query;
    }

    /**
     * Check if string is a valid url
     * 
     * @param $str String to check
     * 
     * @return bool
     */
    public function isUri($str)
    {
        return filter_var($str, FILTER_VALIDATE_URL);
    }

    /**
     * Check if url matches specified $path
     *
     * @param string $path Path to check match
     * @return boolean
     */
    public function matches($path)
    {
        return !!preg_match("#^{$path}#", $this->getPath());
    }

    /**
     * Parse url string to provide all details
     * 
     * @param string $url Url to parse
     * 
     * @return void
     */
    public function parse($url)
    {
        if(!$this->isUri($url)) {
            throw new InvalidArgumentException('Argument "$url" is not a valid url');
        }

        #Let's get scheme
        $url_scheme = explode(':', $url)[0];
        $this->scheme = $url_scheme;

        #Let's get host name
        $url_host_vars = explode($url_scheme . '://', $url)[1];
        $url_host = explode('/', $url_host_vars)[0];
        $this->host = $url_host;

        #Get query string
        $query_string = explode('?', $url)[1] ?? null;
        $this->query = $query_string;

        #Get port number
        $url_port = explode(':', $url_host);
        $this->port = $url_port[0] ?? null;

        #Get url path
        $url_path_vars  = explode('/', $url_host_vars);
        $url_path_chunks = array_slice($url_path_vars, 1);
        $url_path_join = implode('/', $url_path_chunks);
        $url_path = '/' . explode('?', $url_path_join)[0];
        $this->path = (substr($url_path, -1, 1) === '/') ? $url_path : $url_path . '/';

        #Parse query params
        $this->parseQueryParams();
    }

    /**
     * Parse query string to array
     * 
     * @return string[]
     */
    private function parseQueryParams()
    {
        $query = $this->query;
        $data = array();

        if(!$query) return $data;

        $query_vars = explode('&', $query);

        foreach($query_vars as $query_var)
        {
            $query_details = explode('=', $query_var);

            $index = $query_details[0];
            $value = $query_details[1] ?? '';

            $data[$index] = $value;
        }

        $this->parsed_query = $data;
        return $this;
    }
}