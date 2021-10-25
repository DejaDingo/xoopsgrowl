<?php

namespace XoopsModules\Xoopsgrowl;

/**
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.

 * @copyright           {@link http://xoops.org/ XOOPS Project}
 * @license             {@link https://www.gnu.org/licenses/gpl-2.0.html GNU GPL 2 or later}
 * @package             XoopsGrowl
 * @since               2.5.11
 * @author              XOOPS Development Team
 */

//defined('XOOPS_ROOT_PATH') || die('Restricted access');

/**
 * Class Helper
 */
class Helper extends \Xmf\Module\Helper
{
    public $debug;

    /**
     * @param bool $debug
     */
    public function __construct($debug = false)
    {
        if (null === $this->dirname) {
            $dirname       = \basename(\dirname(__DIR__));
            $this->dirname = $dirname;
        }
        parent::__construct($this->dirname);
    }

    /**
     * @param bool $debug
     *
     * @return \XoopsModules\Xoopsgrowl\Helper
     */
    public static function getInstance(bool $debug = false): Helper
    {
        static $instance;
        if (null === $instance) {
            $instance = new static($debug);
        }

        return $instance;
    }

    /**
     * @return string
     */
    public function getDirname(): string
    {
        return $this->dirname;
    }

    /**
     * Get an Object Handler
     *
     * @param string $name name of handler to load
     *
     * @return bool|\XoopsObjectHandler|\XoopsPersistableObjectHandler
     */
    public function getHandler($name)
    {
        $ret   = false;

        $class =  __NAMESPACE__ . '\\' . \ucfirst($name) . 'Handler';
        if (!\class_exists($class)) {
            throw new \RuntimeException("Class '$class' not found");
        }
        /** @var \XoopsMySQLDatabase $db */
        $db     = \XoopsDatabaseFactory::getDatabaseConnection();
        $helper = self::getInstance();
        $ret    = new $class($db, $helper);
        $this->addLog("Getting handler '$name'");
        return $ret;
    }
}
