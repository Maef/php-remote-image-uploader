<?php
/**
 * A library for uploading image to some hosting services
 * like picasa, imgur, imageshack, imgur etc..
 *
 * @author     Phan Thanh Cong <ptcong90@gmail.com>
 * @copyright  2010-2014 Phan Thanh Cong.
 * @license    http://www.opensource.org/licenses/mit-license.php  MIT License
 * @website    http://ptcong.com
 */

class ChipVN_ImageUploader_Manager
{
    const VERSION = '5.2.13'; // Jan 19, 2015

    /**
     * Create a plugin for uploading.
     *
     * @param  string                             $plugin
     * @return ChipVN_ImageUploader_Plugins_Abstract
     */
    public static function make($plugin)
    {
        $prefix = 'ChipVN_ImageUploader_Plugins_';
        foreach (array($prefix.'Abstract', $class = $prefix.ucfirst($plugin)) as $name) {
            if (!class_exists($name, false)) {
                require self::getClassFile($name);
            }
        }

        return new $class();
    }

    /**
     * Gets class file.
     *
     * @param  string $class
     * @return string
     */
    protected static function getClassFile($class)
    {
        return strtr($class, array(
            'ChipVN' => dirname(dirname(__FILE__)),
            '_'      => DIRECTORY_SEPARATOR,
        )).'.php';
    }
}
