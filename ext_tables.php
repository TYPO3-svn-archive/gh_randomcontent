<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

t3lib_div::loadTCA('tt_content');
$TCA['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY.'_pi1']='layout,select_key';

t3lib_extMgm::addPlugin(Array('LLL:EXT:gh_randomcontent/locallang_db.php:tt_content.list_type_pi1', $_EXTKEY.'_pi1'),'list_type');

t3lib_extMgm::addStaticFile($_EXTKEY,'static/','Random Content');

$TCA['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY.'_pi1']='pages,layout,select_key';

$TCA['tt_content']['types']['list']['subtypes_addlist'][$_EXTKEY.'_pi1']='pi_flexform';
t3lib_extMgm::addPiFlexFormValue($_EXTKEY.'_pi1', 'FILE:EXT:gh_randomcontent/flexform_ds.xml');

if (TYPO3_MODE=='BE')	$TBE_MODULES_EXT['xMOD_db_new_content_el']['addElClasses']['tx_ghrandomcontent_pi1_wizicon'] = t3lib_extMgm::extPath($_EXTKEY).'pi1/class.tx_ghrandomcontent_pi1_wizicon.php';
?>