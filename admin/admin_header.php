<?php
/**
 * XoopsGrowl
 *    jGrowl Replacement using Bootstrap 4 or 5
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

use Xmf\Module\Admin;
use XoopsModules\Xoopsgrowl\Helper;

/** @var Admin $adminObject */
/** @var Helper $helper */

require dirname(__DIR__) . '/preloads/autoloader.php';

require dirname(__DIR__, 3) . '/include/cp_header.php';

$adminObject = Admin::getInstance();

$helper = Helper::getInstance();
// Load language files
$helper->loadLanguage('admin');
$helper->loadLanguage('modinfo');
