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

 // ------------------- Information ------------------- //
$modversion                   = [];
$modversion['name']           = _XOOPSGROWL_MI_MD_NAME;
$modversion['version']        = 1.00;
$modversion['description']    = _XOOPSGROWL_MI_MD_DESC;
$modversion['author']         = 'DejaDingo';
$modversion['credits']        = 'The XOOPS Project';
$modversion['license']        = 'GNU GPL 2.0 or later';
$modversion['license_url']    = 'www.gnu.org/licenses/gpl-2.0.html';
$modversion['help']           = 'page=help';
$modversion['image']          = 'assets/images/logo.png';
$modversion['dirname']        = _XOOPSGROWL_MI_DIRNAME;
$modversion['dirmoduleadmin'] = '/Frameworks/moduleclasses/moduleadmin';
$modversion['icons16']        = '../../Frameworks/moduleclasses/icons/16';
$modversion['icons32']        = '../../Frameworks/moduleclasses/icons/32';
$modversion['module_status']       = 'Beta';
$modversion['release_date']        = '2021/10/11';
$modversion['module_website_url']  = 'https://xoops.org/';
$modversion['module_website_name'] = 'XOOPS';
$modversion['min_php']             = '5.7';
$modversion['min_xoops']           = '2.5.11';
$modversion['min_admin']           = '1.2';

/**
 *	There is no Admin (except for Help) or Main to this module
 *	If the module is loaded it is enabled
 *	The primary purpose is to add some events to setup the notification on redirect
 */

// Admin things
$modversion['hasAdmin'] = 1;
$modversion['system_menu'] = 1;
$modversion['adminindex'] = 'admin/index.php';
$modversion['adminmenu'] = 'admin/menu.php';
// Main Menu
$modversion['hasMain'] = 0;
// Install/Update
//	$modversion['onInstall'] = 'include/oninstall.php';
//	$modversion['onUninstall'] = 'include/onuninstall.php';
//	$modversion['onUpdate'] = 'include/onupdate.php';
// Search
$modversion['hasSearch'] = 0;
// Comments
$modversion['hasComments'] = 0;
// Notification
$modversion['hasNotification'] = 0;

// ------------------- Help files ------------------- //
$modversion['helpsection'] = [
    ['name' => _XOOPSGROWL_MI_HELP_OVERVIEW, 'link' => 'page=help'],
];

// ------------------- Mysql ------------------- //
//	- none -

// ------------------- Blocks ------------------- //
//	- none -

// ------------------- Templates ------------------- //
//	- none -

// ------------------- Config ------------------- //
//	- none -
