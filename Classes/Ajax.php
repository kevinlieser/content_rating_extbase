<?php
/**
* Initialize Database
*/

class ajaxClass {

	protected $hmacSalt = 'contentRatingExtbase_a3f60445f2031b5cd83534130eeba64cf4a0887b';

	private $rate_count = 0;
	private $rate_tmp1 = null;
	private $rate_tmp2 = null;
	private $rate_tmp3 = null;
	
	function main(){
		
		$rateUrl = \TYPO3\CMS\Core\Utility\GeneralUtility::_GP('url');
		$rateUrlHash = \TYPO3\CMS\Core\Utility\GeneralUtility::_GP('urlhash');
		$checkUrlHash = \TYPO3\CMS\Core\Utility\GeneralUtility::hmac($rateUrl, $this->hmacSalt);
		
		if($checkUrlHash == $rateUrlHash) {
			
			// Maximum Rate value
			$rateValue = intval(\TYPO3\CMS\Core\Utility\GeneralUtility::_GP('rate'));
			if($rateValue < 0) { $rateValue = 0; }
			if($rateValue > 5) { $rateValue = 5; }
			
			// Check IP
			$selectFields = '*';
			$fromTable    = 'tx_contentrating_rates';
			$whereClause  = '1 AND rate_url = "'.$GLOBALS['TYPO3_DB']->quoteStr($rateUrl, 'tx_contentrating_rates').'" AND rate_ip = "'.$GLOBALS['TYPO3_DB']->quoteStr($_SERVER['REMOTE_ADDR'], 'tx_contentrating_rates').'"';
			$groupBy      = '';
			$orderBy      = '';
			$limit        = '1';
			$recordList = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows($selectFields, $fromTable, $whereClause, $groupBy, $orderBy, $limit);
			if(count($recordList) == 0) {
				// Store to DB
				$into_table   = 'tx_contentrating_rates';
				$field_values = array('pid' => 1
									 ,'rate_url' => $rateUrl
									 ,'rate_ip' => $_SERVER['REMOTE_ADDR']
									 ,'rate_value' => $rateValue
									 ,'tstamp' => time()
									 ,'crdate' => time()
									 );
									 
				$res = $GLOBALS['TYPO3_DB']->exec_INSERTquery($into_table, $field_values);
				$newUId = $GLOBALS['TYPO3_DB']->sql_insert_id();
			} else {
				// Update DB
				$into_table   = 'tx_contentrating_rates';
				$where_clause = 'rate_url = "'.$GLOBALS['TYPO3_DB']->quoteStr($rateUrl, 'tx_contentrating_rates').'" AND rate_ip = "'.$GLOBALS['TYPO3_DB']->quoteStr($_SERVER['REMOTE_ADDR'], 'tx_contentrating_rates').'"';
				$field_values = array('rate_value' => $GLOBALS['TYPO3_DB']->quoteStr($rateValue, 'tx_contentrating_rates')
									 ,'tstamp' => time()
									 );
				$res = $GLOBALS['TYPO3_DB']->exec_UPDATEquery($into_table, $where_clause, $field_values);
				$cnt = $GLOBALS['TYPO3_DB']->sql_affected_rows();
			}
			
			
			// New Calc return
			$selectFields = '*';
			$fromTable    = 'tx_contentrating_rates';
			$whereClause  = '1 AND rate_url = "'.$GLOBALS['TYPO3_DB']->quoteStr($rateUrl, 'tx_contentrating_rates').'"';
			$groupBy      = '';
			$orderBy      = '';
			$limit        = '';
			$recordList = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows($selectFields, $fromTable, $whereClause, $groupBy, $orderBy, $limit);
			$this->rate_count = count($recordList);
			$GLOBALS['TYPO3_DB']->sql_num_rows($res);
			foreach($recordList as $record) { $this->rate_tmp1 = $this->rate_tmp1 + $record['rate_value']; }
			
			// Calculate
			$this->rate_tmp2 = $this->rate_count * 5; // Max possible Rating
			$this->rate_tmp3 = round((100 / $this->rate_tmp2) * $this->rate_tmp1); // Percent Rating
			
			// Output
			print $this->rate_tmp3;
		}
		
	}


}

$ajaxObj = new ajaxClass;
print $ajaxObj->main();
exit;

?>