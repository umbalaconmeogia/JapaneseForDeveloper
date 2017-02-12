<?php
namespace batsg\helpers;

/**
 * Helper function for file and directory.
 */
class HFile
{
    /**
     * Generate directory path by connecting sub directory.
     * @param string $param...
     * @return string
     */
    public static function connectPath()
    {
        return implode(DIRECTORY_SEPARATOR, func_get_args());
    }
}