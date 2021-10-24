<div id="help-template" class="outer">
    <h1 class="head">Help:
        <a class="ui-corner-all tooltip" href="<{$xoops_url}>/modules/<{$smarty.const._XOOPSGROWL_MI_DIRNAME}>/admin/index.php"
        title="<{$smarty.const.XOOPSGROWL_MI_BACK_2_ADMIN}><{$smarty.const._XOOPSGROWL_MI_MD_NAME}>">
            <{$smarty.const._XOOPSGROWL_MI_MD_NAME}>
            <img src="<{xoAdminIcons home.png}>"
                alt="<{$smarty.const.XOOPSGROWL_MI_BACK_2_ADMIN}> <{$smarty.const._XOOPSGROWL_MI_MD_NAME}>">
        </a></h1>

    <h4 class="odd">DESCRIPTION</h4>
    <div class="even">
        <br>XoopsGrowl is a module for configuring an alternative to the jGrowl notification using Bootstrap Alerts.
        <br>This module can be used with either Bootstrap 4.x or Bootstrap 5.x themes.
        <ul>
            <li>There is no Admin (except this Help) or Main for this module</li>
            <li>If the module is loaded it is enabled</li>
            <li>The primary purpose is to add some events to setup the notification on redirect</li>
        </ul>
    </div>

    <h4 class="odd">INSTALL/UNINSTALL</h4>
    <div class="even"><br><b>Background:</b>
        <br><br>It is currently not possible to override core events, so this module installs two new events which
        Bootstrap themes can use, along with four trivial core hacks,
        to replace the default Xoops template based redirection with a redirect notification
        based on Bootstrap Alerts.
        <br>The core hacks have no impact on system operation unless:
        <ul>
            <li>the XoopsGrowl module is installed</li>
            <li>and the jGrowl redirect notification option is NOT selected</li>
        </ul>
    </div>
    <div class="even">
    <br>Follow the standard installation process –
        extract the module folder into the ../modules directory. Install the
        module through Admin -> System Module -> Modules.
        <br><br>
        Detailed instructions on installing modules are available in the
        <a href="https://xoops.gitbook.io/xoops-operations-guide/" target="_blank">XOOPS Operations Manual</a>
    </div>
    <div class="even">
        <br>Install the Core Hacks (see below).
        <br><br>
    </div>

    <h4 class="odd">CORE HACKS</h4>
    <div class="even">
        <br><b>[1]</b> In ../include/functions.php, in function redirect_header(), after line 722:

        <div class="xoopsQuote"><blockquote><pre>
    $xoopsPreload->triggerEvent('core.include.functions.redirectheader', array($url, $time, $message, $addredirect, $allowExternalLink));</pre>
        </blockquote></div>

        insert:

        <div class="xoopsQuote"><blockquote><pre>
    //  ===========  Core Hack ==========
    //  For Module XoopsGrowl
    //      This event installs vanilla JavaScript into the DOM to invoke Bootstrap 4 or 5 Alert notifications.
    //      If the XoopsGrowl module is not installed, this event is ignored.
    //      The event handler does not return.  Instead it overrides the default Xoops template notification below.
    //
    //      When used with the XoopsGrowl module:
    //      -   $time can (optionally) be declared as an array of request specific XoopsGrowl options
    if (is_array($time)) {
        $opts = $time;
        //  Compatibility: Ensure $time is available if the XoopsGrowl event is ignored
        $time = isset($opts['life']) ? $opts['life'] : 3;
    } else {
        $opts['life'] = $time;
    }
    $xoopsPreload->triggerEvent('xgrowl.include.functions.redirectheader', array($url, $opts, $message, $addredirect, $allowExternalLink));
    //  ===========  Core Hack ==========</pre>
        </blockquote></div>

        <br><b>[2]</b> In ../header.php, after line 61:

        <div class="xoopsQuote"><blockquote><pre>
    $xoopsPreload->triggerEvent('core.header.addmeta');</pre>
        </blockquote></div>

        insert:

        <div class="xoopsQuote"><blockquote><pre>
    //  ===========  Core Hack ==========
    //  For Module XoopsGrowl
    //      This event adds properties to the $_SYSTEM global which will be used to invoke Bootstrap 4 or 5 Alert notifications.
    //      See Core Hack in redirect_header() in functions.php for additional information.
    //      This code change has no effect when the XoopsGrowl module is not installed.
    $xoopsPreload->triggerEvent('xgrowl.header.addmeta');
    //  ===========  Core Hack ==========</pre>
        </blockquote></div>

        <br><b>[3]</b> In ../modules/system/preloads/core.php, after line 67:

        <div class="xoopsQuote"><blockquote><pre>
    if (!empty($_SESSION['redirect_message'])) {</pre>
        </blockquote></div>

        insert:

    <div class="xoopsQuote"><blockquote><pre>
    //  ===========  Core Hack ==========
    //  For Module XoopsGrowl
    //      This code change has no effect when the XoopsGrowl module is not installed.
    //
    //  Ensure we only apply these scripts when using the jGrowl notification alternative.
    global $xoopsConfig;
    if (!(isset($xoopsConfig['redirect_message_ajax']) && $xoopsConfig['redirect_message_ajax'])) {
        return;
    }
    //  ===========  Core Hack ==========</pre>
        </blockquote></div>

        <br><b>[4] </b>In ../modules/system/preloads/core.php, after line 118:

        <div class="xoopsQuote"><blockquote><pre>
    unset($_SESSION['redirect_message']);</pre>
        </blockquote></div>

        insert:

    <div class="xoopsQuote"><blockquote><pre>
    //  ===========  Core Hack ==========
    //  For Module XoopsGrowl
    //      This code change has no effect when the XoopsGrowl module is not installed.
    unset($_SESSION['redirect_options']);
    //  ===========  Core Hack ==========</pre>
        </blockquote></div>

    </div>

    <h4 class="odd">UPDATE YOUR THEME</h4>
    <div class="even">
        <br>Copy the contents (folders/files) of the ../modules/xoopsgrowl/extra directory into your theme directory.
        <br>Incorporate the extra js and css files into your Bootstrap 4.x or Bootstrap 5.x theme as follows:
        <br><br>
        <b>css/xoopsgrowl.css</b>
            <ul>
                <li>either include this file in your theme.tpl</li>
                <li>or copy the contents into your theme's css/my_xoops.css</li>
            </ul>
        <b>js/bootstrap.xgrowl.js</b>
            <ul>
                <li>this must be included after bootstrap.min.js</li>
                <li>if you include bootstrap.min.js in the &lt;head&gt; section, no other updates are required.
                <br>This file will be automatically included whenever it is required for notification</li>
                <li>if you include bootstrap.min.js at the end of your &lt;body&gt;,
                <br>you must add the include for bootstrap.xgrowl.js after the main Bootstrap file there.</li>
            </ul>
    </div>

    <h4 class="odd">TRANSLATIONS</h4>
    <p class="even">Only the English language files are currently available for this module.
        <br><br>Translations are on <a href="https://www.transifex.com/xoops/" target="_blank">Transifex</a> and in
        our <a href="https://github.com/XoopsLanguages/" target="_blank">XOOPS Languages Repository on GitHub</a>.</p>

    <h4 class="odd">SUPPORT</h4>
    <p class="even">If you have questions about this module and need help, you can visit our <a
            href="https://xoops.org/modules/newbb/viewforum.php?forum=28/" target="_blank">Support Forums on XOOPS
        Website</a></p>

    <h4 class="odd">DEVELOPMENT</h4>
    <p class="even">This module is Open Source and we would love your help in making it better! You can fork this module
        on <a href="https://github.com/XoopsModulesArchive/ZZZZZZZZ" target="_blank">GitHub</a><br><br>
        But there is more happening on GitHub:<br><br>
        - <a href="https://github.com/xoops" target="_blank">XOOPS Core</a> <br>
        - <a href="https://github.com/XoopsModules25x" target="_blank">XOOPS Modules</a><br>
        - <a href="https://github.com/XoopsThemes" target="_blank">XOOPS Themes</a><br><br>
        Go check it out, and <strong>GET INVOLVED</strong>
    </p>

</div>
