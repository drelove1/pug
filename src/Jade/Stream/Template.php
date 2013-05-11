<?php
/**
 * @Author      ronan.tessier@vaconsulting.lu
 * @Date        11/05/13
 * @File        Stream.php
 */

namespace Jade\Stream;

/**
 * Creates a wrapper in order to allow the Zend PhpRenderer
 * to include the compiled file.
 * Class Template
 * @package Jade\Stream
 */
class Template {

    /**
     * @var int
     */
    private $position = 0;
    /**
     * @var string
     */
    private $data = '';

    /**
     * @param $path
     * @return bool
     */
    public function stream_open($path)
    {
        // strip the url from $path
        $data = substr(strstr($path, ';'), 1);
        $this->data = base64_decode($data);
        return true;
    }

    /**
     * @return null
     */
    public function stream_stat()
    {
        return null;
    }

    /**
     * @param $count
     * @return string
     */
    public function stream_read($count)
    {
        $ret = substr($this->data, $this->position, $count);
        $this->position += strlen($ret);
        return $ret;
    }

    /**
     * @return int
     */
    public function stream_tell()
    {
        return $this->position;
    }

    /**
     * @return bool
     */
    public function stream_eof()
    {
        return $this->position >= strlen($this->data);
    }
}