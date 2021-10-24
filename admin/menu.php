<?php
/**
 * XoopsGrowl
 * 	jGrowl Replacement using Bootstrap 4 or 5
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright       (c) 2000-2016 XOOPS Project (www.xoops.org)
 * @license             GNU GPL 2 (https://www.gnu.org/licenses/gpl-2.0.html)
 * @package             xoopsgrowl
 * @since               2.5.11
 * @author              XOOPS Module Team
 * @author              DejaDingo
 */

// defined('XOOPS_ROOT_PATH') || exit('XOOPS root path not defined');

use Xmf\Module\Admin;
use XoopsModules\Xoopsgrowl\{
    Helper
};

include_once __DIR__ . '/admin_header.php';

$pathIcon32 = Admin::menuIconPath('');

$helper = Helper::getInstance();
$helper->loadLanguage('main');

$adminmenu[] = [
    'title' => _XOOPSGROWL_MI_HOME,
    'link' => 'admin/index.php',
    'icon' => $pathIcon32 . '/home.png',
];

$adminmenu[] = [
    'title' => _XOOPSGROWL_MI_ABOUT,
    'link' => 'admin/about.php',
    'icon' => $pathIcon32 . '/about.png',
];

