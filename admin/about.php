<?php
//
// ---------------------------------------------------
// File: admin/about.php
// Version: 1.0
// Date-Time: 2008/02/18 14:53:14
// Author: timgno
// Email: risorseweb@netsons.org
// URL: http://www.risorseweb.netsons.org
// ---------------------------------------------------
//

include "admin_header.php";

xoops_cp_header();
$myts = &MyTextSanitizer::getInstance();

include "info_header.php";
am_menuheader();

// Author Information
$sform = new XoopsThemeForm(_AM_RS_AUTHOR_INFO, "", "");
if  ( $versioninfo->getInfo('author_realname'))
	$author_name = $versioninfo->getInfo('author') . " (" . $versioninfo->getInfo('author_realname') . ")";
else
	$author_name = $versioninfo->getInfo('author');
$sform -> addElement(new XoopsFormLabel(_AM_RS_AUTHOR_NAME, $author_name));
$author_sites = $versioninfo -> getInfo('author_website');
$author_site_info = "";
foreach($author_sites as $site){
	$author_site_info .= "<a href='" . $site['url'] . "' target='blank'>" . $site['name'] . "</a>; ";
}
$sform -> addElement(new XoopsFormLabel(_AM_RS_AUTHOR_WEBSITE, $author_site_info));
$sform -> addElement(new XoopsFormLabel(_AM_RS_AUTHOR_EMAIL, "<a href='mailto:" . $versioninfo -> getInfo('author_email') . "'>" . $versioninfo -> getInfo('author_email') . "</a>"));
$sform -> addElement(new XoopsFormLabel(_AM_RS_AUTHOR_CREDITS, $versioninfo -> getInfo('credits')));
$sform -> display();
echo "<br />";
$sform = new XoopsThemeForm(_AM_RS_MODULE_INFO, "", "");
$sform -> addElement(new XoopsFormLabel(_AM_RS_MODULE_STATUS, $versioninfo -> getInfo('status')));
$sform -> addElement(new XoopsFormLabel(_AM_RS_MODULE_XOOPSVERSION, $versioninfo -> getInfo('xoopsversion')));
$sform -> addElement(new XoopsFormLabel(_AM_RS_MODULE_DEMO, "<a href='" . $versioninfo -> getInfo('demo_site_url') . "' target='blank'>" . $versioninfo -> getInfo('demo_site_name') . "</a>"));
$sform -> addElement(new XoopsFormLabel(_AM_RS_MODULE_SUPPORT, "<a href='" . $versioninfo -> getInfo('support_site_url') . "' target='blank'>" . $versioninfo -> getInfo('support_site_name') . "</a>"));
$sform -> display();
echo "<br />";
$file = "../info/readme.txt";
if (@file_exists($file))
{
    $fp = @fopen($file, "r");
    $readmetext = @fread($fp, filesize($file));
    @fclose($file);
	$sform = new XoopsThemeForm(_AM_RS_ABOUT, "", "");
	ob_start();
	echo "<div class='even' align='left'>".$myts->displayTarea($readmetext)."</div>";
	$sform -> addElement(new XoopsFormLabel('', ob_get_contents(), 0));
	ob_end_clean();
	$sform -> display();
	unset($file);
}

xoops_cp_footer();
?>
