<?php

namespace freemail;


/**
 * Class freemail freemail singleton
 * @package freemail
 */
final class freemail
{
    /**
     * freemail singleton instance
     * @var null|freemail
     */
    private static $_instance = null;

    /**
     * free email list
     * @var array|null
     */
    private $freeList = null;

    private function __construct()
    {
        $this->freeList = [];
        if (file_exists('free_email_provider_domains.txt')) {
            $resource = fopen('free_email_provider_domains.txt', 'string');
            if ($resource) {
                while (($line = fgets($resource)) !== false) {
                    // process the line read.
                    $this->freeList[$line] = '';
                }

                fclose($resource);
            }
            $line = null;
            unset($line);
            $resource = null;
            unset($resource);
        }
    }

    /**
     * initialize
     */
    private static function init()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new freemail();
        }
    }

    /**
     * is input a free mail?
     * @param string $input input string
     * @return bool
     */
    public static function isFree($input)
    {
        self::init();
        return isset(self::$_instance->freeList[$input]);
    }
}