<?php

########################################################################
# Extension Manager/Repository config file for ext: "gh_randomcontent"
#
# Auto generated 19-07-2008 14:35
#
# Manual updates:
# Only the data in the array - anything else is removed by next write.
# "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'GH Random Content',
	'description' => 'This frontend plugin shows a random content element from selected page(s). It is based on onet_randomcontent, but provides more flexibility.',
	'category' => 'plugin',
	'shy' => 0,
	'version' => '0.2.0',
	'dependencies' => 'cms',
	'conflicts' => '',
	'priority' => '',
	'loadOrder' => '',
	'module' => '',
	'state' => 'beta',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
	'clearcacheonload' => 0,
	'lockType' => '',
	'author' => 'Gregor Hermens',
	'author_email' => 'gregor.hermens@a-mazing.de',
	'author_company' => '@mazing',
	'CGLcompliance' => '',
	'CGLcompliance_note' => '',
	'constraints' => array(
		'depends' => array(
			'typo3' => '3.5.0-0.0.0',
			'php' => '3.0.0-0.0.0',
			'cms' => '',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:16:{s:9:"ChangeLog";s:4:"59bc";s:10:"README.txt";s:4:"9fa9";s:12:"ext_icon.gif";s:4:"d4fb";s:17:"ext_localconf.php";s:4:"4026";s:14:"ext_tables.php";s:4:"7ceb";s:15:"flexform_ds.xml";s:4:"d6a7";s:13:"locallang.xml";s:4:"e273";s:16:"locallang_db.xml";s:4:"fd98";s:14:"pi1/ce_wiz.gif";s:4:"ac64";s:36:"pi1/class.tx_ghrandomcontent_pi1.php";s:4:"214d";s:44:"pi1/class.tx_ghrandomcontent_pi1_wizicon.php";s:4:"8bc8";s:13:"pi1/clear.gif";s:4:"cc11";s:17:"pi1/locallang.xml";s:4:"ba12";s:14:"doc/manual.sxw";s:4:"1fa8";s:19:"doc/wizard_form.dat";s:4:"ca9a";s:20:"doc/wizard_form.html";s:4:"c2f6";}',
	'suggests' => array(
	),
);

?>