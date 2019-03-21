<?php

namespace FreeMail;

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
        if (file_exists(__DIR__ . '/free_email_provider_domains.txt')) {
            $resource = fopen(__DIR__ . '/free_email_provider_domains.txt', 'r');
            if ($resource) {
                while (($line = fgets($resource)) !== false) {
                    // process the line read.
                    $this->freeList[str_replace(["\r", "\n", "\r\n", "\n\r"], '', $line)] = '';
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
        if (strpos($input, '@')) {
            $input = substr($input, strpos($input, '@') + 1);
        }
        self::init();
        return isset(self::$_instance->freeList[$input]);
    }
}
