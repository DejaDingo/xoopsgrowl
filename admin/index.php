<?php
/**
 * XoopsGrowl
 * 	jGrowl Replacement using Bootstrap 4 or 5
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

/**
 * @copyright      {@link http://xoops.org/ XOOPS Project}
 * @license        {@link https://www.gnu.org/licenses/gpl-2.0.html GNU GPL 2 or later}
 * @package             xoopsgrowl
 * @since               2.5.11
 * @author              XOOPS Module Team
 * @author              DejaDingo
 */

use Xmf\Module\Admin;

include_once __DIR__ . '/admin_header.php';
xoops_cp_header();

$adminObject = Admin::getInstance();

$adminObject->addInfoBox(_XOOPSGROWL_AM_DASHBOARD);
$adminObject->addInfoBoxLine(_XOOPSGROWL_AM_DESC1);
$adminObject->addInfoBoxLine('');
$adminObject->addInfoBoxLine(_XOOPSGROWL_AM_DESC2);
$adminObject->addInfoBoxLine(_XOOPSGROWL_AM_DESC3);
$adminObject->addInfoBoxLine(_XOOPSGROWL_AM_DESC4);

$adminObject->displayNavigation(basename(__FILE__));
$adminObject->displayIndex();

include_once __DIR__ . '/admin_footer.php';
