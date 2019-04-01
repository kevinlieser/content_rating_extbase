<?php
namespace TYPO3\ContentRatingExtbase\Controller;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
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

use TYPO3\CMS\Core\Database\Query\QueryBuilder;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;

/**
 *
 *
 * @package disqus_comments_extbase
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class ContentRatingController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * cObj
	 * 
	 * @return 
	 */
	private $cObj;
	
	private $output = '';

	protected $hmacSalt = 'contentRatingExtbase_a3f60445f2031b5cd83534130eeba64cf4a0887b';
	
	private $url;
	private $urlhash;
	private $ip;
	private $getvars;
	private $pid;
	
	private $rate_count = 0;
	private $rate_value = null;
	private $rate_percent = null;
	
	private $rate_tmp1 = null;
	private $rate_tmp2 = null;
	private $rate_tmp3 = null;
	
	
	
	
	/**
	 * action list
	 *
	 * @return void
	 */
	public function showAction() {
		
		// jQuery
		$confArray = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['content_rating_extbase']);
		if($confArray['jquery_included'] == 0) { $includeJQuery = 1; } else { $includeJQuery = 0; }
		
		// Set Vars
		$this->url 		= $_SERVER['REQUEST_URI'];
		//if(\TYPO3\CMS\Core\Utility\GeneralUtility::_GP("url")) { $this->url = \TYPO3\CMS\Core\Utility\GeneralUtility::_GP("url"); }
		$this->urlhash  = \TYPO3\CMS\Core\Utility\GeneralUtility::hmac($this->url, $this->hmacSalt);
		$this->ip 		= $_SERVER['REMOTE_ADDR'];
		$this->pid 		= $GLOBALS["TSFE"]->id;

    /** @var QueryBuilder $queryBuilder */
    $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_contentrating_rates');
		
		// Fetch All Records
		$selectFields = '*';
		$fromTable    = 'tx_contentrating_rates';

		/** @var \Doctrine\DBAL\Driver\Statement $statement */
    $recordList = $queryBuilder
      ->select($selectFields)
      ->from($fromTable)
      ->where(
        $queryBuilder->expr()->eq('rate_url', $queryBuilder->createNamedParameter($this->url)),
        $queryBuilder->expr()->eq('t3_origuid', 0)
      )->execute()->fetchAll();

    $this->rate_count = count($recordList);

    foreach($recordList as $record) {
        $this->rate_tmp1 = $this->rate_tmp1 + $record['rate_value'];
    }
		
		// Calculate
		$this->rate_tmp2 = $this->rate_count * 5; // Max possible Rating
		if($this->rate_tmp2 != 0) {
			$this->rate_tmp3 = round((100 / $this->rate_tmp2) * $this->rate_tmp1); // Percent Rating
		} else {
			$this->rate_tmp3 = 0; // Percent Rating
		}
		
		// Style
		if(empty($confArray['style']) || !isset($confArray['style'])) { $defaultStyle = 1; $useStyle = 0; }
		else { $defaultStyle = 0; $useStyle = $confArray['style']; }
		
		// Assign...
		$this->view->assign('includeJQuery', $includeJQuery);
		$this->view->assign('defaultStyle', $defaultStyle);
		$this->view->assign('useStyle', $useStyle);
		$this->view->assign('rateUrl', $this->url);
		$this->view->assign('rateUrlhash', $this->urlhash);
		$this->view->assign('ratePerc', $this->rate_tmp3);
		$this->view->assign('rateCount', $this->rate_count);
		$this->view->assign('rateValue', ((1 / 20) * $this->rate_tmp3));
		
	}
	
	
	public function ajaxAction() {
		return 1;
	}
	
}
?>