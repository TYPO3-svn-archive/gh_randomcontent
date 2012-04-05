<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2008-2010 Gregor Hermens (gregor.hermens@a-mazing.de)
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
 * [CLASS/FUNCTION INDEX of SCRIPT]
 *
 *
 *
 *   52: class tx_ghrandomcontent_pi1 extends tslib_pibase
 *   65:	 public function main($content, $conf)
 *   92:	 protected function init($conf)
 *  126:	 protected function getContentUids()
 *  155:	 protected function selectContentUids ($contentIds = array())
 *  173:	 protected function renderContent($contentShown = array(), $contentIds = array())
 *
 * TOTAL FUNCTIONS: 5
 * (This index is automatically created/updated by the extension "extdeveval")
 *
 */

require_once(PATH_tslib . 'class.tslib_pibase.php');


/**
 * Plugin 'Random Content' for the 'gh_randomcontent' extension.
 *
 * @author	Gregor Hermens <gregor.hermens@a-mazing.de>
 * @package	TYPO3
 * @subpackage	tx_ghrandomcontent
 */
class tx_ghrandomcontent_pi1 extends tslib_pibase
{
	/**
	 * Same as class name
	 *
	 * @var string
	 */
	public $prefixId = 'tx_ghrandomcontent_pi1';

	/**
	 * Path to this script relative to the extension dir.
	 *
	 * @var string
	 */
	public $scriptRelPath = 'pi1/class.tx_ghrandomcontent_pi1.php';

	/**
	 * The extension key
	 *
	 * @var string
	 */
	public $extKey = 'gh_randomcontent';

	/**
	 * Check the CHash parameter
	 *
	 * @var bool
	 */
	public $pi_checkCHash = TRUE;

	/**
	 * The main method of the PlugIn
	 *
	 * @param   string      $content The PlugIn content
	 * @param   array       $conf The PlugIn configuration
	 * @return  string      The content that is displayed on the website
	 */
	public function main($content, $conf) {
		$this->init($conf);

		$contentIds = $this->getContentUids();

			// no content available at all
		if (!count($contentIds)) {
			return FALSE;
		}

		if ($this->conf['count'] > count($contentIds)) {
			$this->conf['count'] = count($contentIds);
		}

		$contentShown = $this->selectContentUids($contentIds);

		$content = $this->renderContent($contentShown, $contentIds);

		return $content;
	}


	/**
	 * Initialise this class
	 *
	 * @param   array       $conf The PlugIn configuration
	 * @return  boolean     success
	 */
	protected function init($conf) {
		$this->conf = $conf;

			// Init FlexForm configuration for plugin
		$this->pi_initPIflexForm();
		if ($this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'which_pages', 'sDEF')) {
			$this->conf['pages'] = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'which_pages', 'sDEF');
		}

		$this->conf['count'] = (int)$this->conf['count'];
		if ($this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'count', 'sDEF')) {
			$this->conf['count'] = (int)$this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'count', 'sDEF');
		}
		if (empty($this->conf['count'])) {
			$this->conf['count'] = 1;
		}

			// Override $conf with flexform checkboxes
		if ($this->cObj->data['list_type'] == $this->extKey . '_pi1') {
			$this->conf['honorLanguage'] = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'honor_language', 'sDEF');
			$this->conf['honorColPos'] = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'honor_colpos', 'sDEF');
		}

		if ('' == $this->cObj->data['colPos']) {
			$this->conf['colPos'] = $this->conf['defaultColPos'];
		} else {
			$this->conf['colPos'] = $this->cObj->data['colPos'];
		}

		return TRUE;
	}

	/**
	 * Fetch UID of all available content elements from database
	 *
	 * @return	array		List of UIDs and their PIDs
	 */
	protected function getContentUids() {
		$where = 'pid IN(' . $this->conf['pages'] . ' ) ' . $this->cObj->enableFields('tt_content');

		if ($this->conf['honorLanguage']) {
			$where .= ' AND ( sys_language_uid = ' . $GLOBALS['TSFE']->sys_page->sys_language_uid . ' OR sys_language_uid = -1 )';
		}
		if ($this->conf['honorColPos']) {
			$where .= ' AND colPos = ' . $this->conf['colPos'];
		}

		$contentIds = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
			'uid,pid',
			'tt_content',
			$where,
			'',
			'',
			'',
			'uid'
		);

		return $contentIds;
	}

	/**
	 * Select the content elements to be shown by random
	 *
	 * @param   array    $contentIds List of content element UIDs and their PIDs to select from
	 * @return  array    List of content element UIDs and their PIDs
	 */
	protected function selectContentUids($contentIds = array()) {
			// choose random content elements
		$contentShown = array_rand($contentIds, $this->conf['count']);
		if (1 == $this->conf['count']) {
			$contentShown = array($contentShown);
		} else {
			shuffle($contentShown);
		}

		return $contentShown;
	}

	/**
	 * Render selected content elements
	 *
	 * @param   array       $contentShown List of content element UIDs to show
	 * @param   array       $contentIds List of all available content element UIDs and their PIDs
	 * @return  string      HTML
	 */
	protected function renderContent($contentShown = array(), $contentIds = array()) {
		$content = '';
		foreach ($contentShown as $contentUid) {
				// render content element
			$contentConf = array(
				'table' => 'tt_content',
				'select.' => array(
					'uidInList' => $contentIds[$contentUid]['uid'],
					'pidInList' => $contentIds[$contentUid]['pid'],
				),
			);

			$element = $this->cObj->CONTENT($contentConf);

			if (!empty($this->conf['elementWrap.'])) {
				$element = $this->cObj->stdWrap($element, $this->conf['elementWrap.']);
			}
			if (!empty($this->conf['elementWrap'])) {
				$element = $this->cObj->wrap($element, $this->conf['elementWrap']);
			}

			$content .= $element;
		}

		if (!empty($this->conf['allWrap.'])) {
			$content = $this->cObj->stdWrap($content, $this->conf['allWrap.']);
		}
		if (!empty($this->conf['allWrap'])) {
			$content = $this->cObj->wrap($content, $this->conf['allWrap']);
		}

		return $content;
	}
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/gh_randomcontent/pi1/class.tx_ghrandomcontent_pi1.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/gh_randomcontent/pi1/class.tx_ghrandomcontent_pi1.php']);
}
?>