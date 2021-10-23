
--------------------------------------------------------------------------------
Copy the contents (folders/files) of this directory into your theme directory
--------------------------------------------------------------------------------

Incorporate these files into your Bootstrap 4.x or Bootstrap 5.x theme as follows:

1)	css/xoopsgrowl.css
	- either include this file in your theme.tpl
	- or copy the contents into your theme's css/my_xoops.css

2) bootstrap.xgrowl.js
	- this must be included after bootstrap.min.js
	- if you include bootstrap.min.js in the <head> section, no other updates are required.
		This file will be automatically included whenever it is required for notification.
	- if you include bootstrap.min.js at the end of your <body>,
		you must add the include for bootstrap.xgrowl.js after the main Bootstrap file there.
		--- THIS IS NOT CURRENTLY WORKING ---
