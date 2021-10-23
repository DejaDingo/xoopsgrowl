![alt XOOPS CMS](https://xoops.org/images/logoXoops4GithubRepository.png)
## XoopsGrowl module for [XOOPS CMS 2.5.11+](https://xoops.org)
[![Software License](https://img.shields.io/badge/license-GPL-brightgreen.svg?style=flat)](https://www.gnu.org/licenses/gpl-2.0.html)

[![Latest Pre-Release](https://img.shields.io/github/tag/DejaDingo/xoopsgrowl.svg?style=flat)](https://github.com/DejaDingo/xoopsgrowl/tags/)
[![Latest Version](https://img.shields.io/github/release/DejaDingo/xoopsgrowl.svg?style=flat)](https://github.com/DejaDingo/xoopsgrowl/releases/)

**XoopsGrowl** is a module for [XOOPS CMS](https://xoops.org) to configure an alternative to the jGrowl notification using Bootstrap Alerts.

This module can be used with either Bootstrap 4.x or Bootstrap 5.x themes.

	• The primary purpose is to add some events to setup the notification on redirect.
	• There is no Admin (except the Help Overview/Instructions) or Main for this module.
	• If the module is loaded it is enabled.

It is currently not possible to override core events, so this module installs two new events which
Bootstrap themes can use, along with four trivial core hacks,
to replace the default Xoops template based redirection with a redirect notification
based on Bootstrap Alerts.

The core hacks have no impact on system operation unless:

	• the XoopsGrowl module is installed
	• and the jGrowl redirect notification option is NOT selected

Current and upcoming "next generation" versions of XOOPS CMS are crafted on GitHub at: https://github.com/XOOPS
