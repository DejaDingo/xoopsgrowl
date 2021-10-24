/**
 * Inspired by jGrowl by Stan Lemon
 * 		(https://github.com/stanlemon/jGrowl)
 *
 * ORIGINAL COPYRIGHT:
 * -----------------------------------------------------------------------
 * Copyright (c) 2012 Stan Lemon
 *
 *	Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
 *
 *	The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
 *
 *	THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 * -----------------------------------------------------------------------
 *
 *  XoopsGrowl
 * 	jGrowl Replacement using Bootstrap 4 or 5
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright       (c) 2021 XOOPS Project (www.xoops.org)
 * @license             GNU GPL 2 (https://www.gnu.org/licenses/gpl-2.0.html)
 * @package             xoopsgrowl
 * @since               2.5.11
 * @author              XOOPS Module Team
 * @author              DejaDingo

 * This class implements only the relevant subset of the original jGrowl functionality.
 * It uses only vanilla JavaScript because Bootstrap 5 no longer requires jQuery,
 * 	and jQuery can therefore be eliminated from the theme's load requirements.
 *
 * The defaults may be overridden when constructing the the appropriate concrete class.
 *
 * Install the module XoopsGrowl and follow instructions in the Help tab there
 * 	to use Bootstrap's Alert for redirect_header() notifications in your Bootstrap 4 or 5 theme.
 *
 */

//	========================================================================
//	Do not load the file more than once
//	Allows positioning the include after the primary bootstrap file at the end of the <body>
//	========================================================================
//
if ( typeof window['XoopsGrowlAbstract'] === 'undefined' ) {

	class XoopsGrowlAbstract {

		defaults = {
			header:				'',						//	Not implemented yet
			sticky:				false,					//	Not implemented yet
			position:			'center',				//	Not implemented yet
			glue:				'before',
			type:				'info',
			life:				3000,
			log:				function() {},			//	Not implemented yet
			animate:			true,
			beforeOpen:			function() {},			//	Not impelemented yet
			afterOpen:			function() {},			//	Not implemented yet
			beforeClose:		function() {}			//	Not implemented yet
		}

		constructor( msg, opts ) {
			this.bsVersion = bootstrap.Tooltip.VERSION;
			this.options = this.defaults;
			this.message = msg;
			self = this;
			for ( var key in opts ) {
				self.options[key] = opts[key];
			}
		}

		/**
		 * Update the DOM to include the desired Alert node and set it up to auto-close
		 *
		 * @return  {void}
		 */
		raiseAlert() {
			//	alert("BS[" + this.constructor.name + "] = " + this.message);
			var alertNode = this.render(this.message);
			this.autoClose(alertNode, this.options['life']);
		}

		/**
		 * Add the appropriate Bootstrap Alert node to the DOM
		 *
		 * @param   {string}  message  The message text
		 *
		 * @return  {DOM DIV node}     The constructed Alert node
		 */
		render( message ) {
			//	Override in subclass to add Alert node as lastChild to #xGrowl node
			//	Return the constructed Alert node
		}

		/**
		 * Trigger a timeout to auto-close the Bootstrap Alert node
		 *
		 * @param   {DOM DIV node}  alertNode  The constructed Alert node
		 * @param   {integer}       time       The timeout duration (in milliseconds)
		 *
		 * @return  {void}
		 */
		autoClose( alertNode, time ) {
			setTimeout( function () {
				var alert = new bootstrap.Alert( alertNode );
				alert.close();
			}, time );
		}

	}

	/**
	 * Construct, insert and return a Bootstrap 4 based Alert node
	 */
	class XoopsGrowlBS4 extends XoopsGrowlAbstract {

		render( message ) {
			var type = this.options['type'];
			var animate = this.options['animate'] ? ' fade show' : '';
			var alertPlaceholder = document.getElementById('xGrowl');

			var alertNode = document.createElement('div')
			alertNode.innerHTML = `<div class="alert alert-${type} alert-dismissible${animate}" role="alert">${message}<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>`;

			alertPlaceholder.append(alertNode)
			return alertNode;
		}

	}

	/**
	 * Construct, insert and return a Bootstrap 5 based Alert node
	 */
	class XoopsGrowlBS5 extends XoopsGrowlAbstract {

		render( message ) {
			var type = this.options['type'];
			var animate = this.options['animate'] ? ' fade show' : '';
			var alertPlaceholder = document.getElementById('xGrowl');

			var alertNode = document.createElement('div')
			alertNode.innerHTML = `<div class="alert alert-${type} alert-dismissible${animate}" role="alert">${message}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>`;

			alertPlaceholder.append(alertNode)
			return alertNode;
		}

	}

	/**
	 * External function to be called on Document ready
	 *
	 * @param   {string}  msg   The message text (may include HTML markup)
	 * @param   {array}   opts  Call specific changes to the default options
	 *
	 * @return  {DOM DIV node}  The constructed alert node
	 */
	var xoopsGrowl = function( msg , opts ) {
		// Create the placeholder container node
		var xGrowl = document.getElementById('xGrowl');
		if ( null === xGrowl ) {
			var placeholder = document.createElement('div');
			placeholder.id = 'xGrowl';
			if ( opts['glue'] == 'before' ) {
				document.body.prepend(placeholder);
			} else {
				document.body.append(placeholder);
			}
		}

		//	Instantiate the appropriate class and raise the Alert
		let message = {};
		if ( bootstrap.Tooltip.VERSION.substring(0, 1) > '4' ) {
			message = new XoopsGrowlBS5( msg, opts );
		} else {
			message = new XoopsGrowlBS4( msg, opts );
		}
		message.raiseAlert();

	}

}
