<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2008 Gregor Hermens (gregor.hermens@a-mazing.de)
 *  based on onet_randomcontent (c) 2005 Semyon Vyskubov (poizon@onet.ru)
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Class that adds the wizard icon.
 *
 * @author	Gregor Hermens <gregor.hermens@a-mazing.de>
 * @package	TYPO3
 * @subpackage	tx_ghrandomcontent
 */
class tx_ghrandomcontent_pi1_wizicon
{

	/**
	 * Insert plugin configuration into $izardItems array
	 *
	 * @param array $wizardItems
	 * @return array
	 */
	public function proc($wizardItems) {

		$localLang = t3lib_div::readLLfile(
			t3lib_extMgm::extPath('gh_randomcontent') . 'locallang.xml',
			$GLOBALS['LANG']->lang, $GLOBALS['LANG']->charSet
		);

		$wizardItems['plugins_tx_ghrandomcontent_pi1'] = array(
			'icon' => t3lib_extMgm::extRelPath('gh_randomcontent') . 'pi1/ce_wiz.gif',
			'title' => $GLOBALS['LANG']->getLLL('pi1_title', $localLang),
			'description' => $GLOBALS['LANG']->getLLL('pi1_plus_wiz_description', $localLang),
			'params' => '&defVals[tt_content][CType]=list&defVals[tt_content][list_type]=gh_randomcontent_pi1'
		);

		return $wizardItems;
	}
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/gh_randomcontent/pi1/class.tx_ghrandomcontent_pi1_wizicon.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/gh_randomcontent/pi1/class.tx_ghrandomcontent_pi1_wizicon.php']);
}
?>