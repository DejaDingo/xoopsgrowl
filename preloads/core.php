<?php
/**
 * XoopsGrowl
 * 	jGrowl Replacement using Bootstrap 4 or 5
 *  XoopsGrowl Preloads
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright           {@link http://xoops.org/ XOOPS Project}
 * @license             {@link https://www.gnu.org/licenses/gpl-2.0.html GNU GPL 2 or later}
 * @package             XoopsGrowl
 * @since               2.5.11
 * @author              XOOPS Module Team
 * @author              DejaDingo
 */

// defined('XOOPS_ROOT_PATH') || exit('XOOPS root path not defined');

/**
 * Class XoopsgrowlCorePreload
 */
class XoopsgrowlCorePreload extends XoopsPreloadItem
{
    /**
     * @param $args
     */
    public static function eventCoreIncludeCommonEnd($args)
    {
        require __DIR__ . '/autoloader.php';
    }

    /**
     * @param $args
     */
    public static function eventXgrowlIncludeFunctionsRedirectheader($args)
    {
        global $xoopsConfig;
        if (isset($xoopsConfig['redirect_message_ajax']) && $xoopsConfig['redirect_message_ajax']) {
            return;
        }
        $url = $args[0];
        if (preg_match("/[\\0-\\31]|about:|script:/i", $url)) {
            if (!preg_match('/^\b(java)?script:([\s]*)history\.go\(-\d*\)([\s]*[;]*[\s]*)$/si', $url)) {
                $url = XOOPS_URL;
            }
        }
        if (!headers_sent()) {
            if (is_array($args[1])) {
                $opts = $args[1];
            } else {
                $opts['life'] = $args[1];
            }

            $_SESSION['redirect_message'] = $args[2];
            $_SESSION['redirect_options'] = $opts;
            header('Location: ' . preg_replace('/[&]amp;/i', '&', $url));
            exit();
        }

    }

    /**
     * @param $args
     */
    public static function eventXgrowlHeaderAddmeta($args)
    {
        global $xoopsConfig;
        if (isset($xoopsConfig['redirect_message_ajax']) && $xoopsConfig['redirect_message_ajax']) {
            return;
        }

        if (!empty($_SESSION['redirect_message'])) {
            //  WARNING: bootstrap.xgrowl.js must be loaded AFTER your theme's bootstrap.min.js file
            //  If you include bootstrap.min.js at the end of your theme's theme.tpl,
            //      you must include this file after it there.
            //  If you include bootstrap.min.js in the <head> section of your theme's theme.tpl,
            //      you may uncomment the following line.
            $GLOBALS['xoTheme']->addScript('js/bootstrap.xoopsgrowl.js');
            $message = $_SESSION['redirect_message'];
            $options = "glue:'before'";
            if (!empty($_SESSION['redirect_options'])) {
                foreach ($_SESSION['redirect_options'] as $name => $value) {
                    //  Convert seconds to milliseconds
                    if ($name == 'life') {
                        //  Compatibility with current hard coded value for life
                        if ($value < 3) $value = 3;
                        $value = $value * 1000;
                    };
                    if (is_string($value)) $value = "'$value'";
                    $options .= ", $name:$value";
                }
            }
            $GLOBALS['xoTheme']->addScript('', array('type' => 'text/javascript'),
                "document.addEventListener('DOMContentLoaded', (() => {
                    xoopsGrowl('$message', { $options });
                }))");
        }
    }
}
