<?php
/**
* Initialize Database
*/

use TYPO3\CMS\Core\Database\Query\QueryBuilder;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;

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

    /** @var QueryBuilder $queryBuilder */
    $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_contentrating_rates');
		
		if($checkUrlHash == $rateUrlHash) {

			// Maximum Rate value
			$rateValue = intval(\TYPO3\CMS\Core\Utility\GeneralUtility::_GP('rate'));
			if($rateValue < 0) { $rateValue = 0; }
			if($rateValue > 5) { $rateValue = 5; }
			
			// Check IP
			$selectFields = '*';
			$fromTable    = 'tx_contentrating_rates';
			$limit        = 1;

      /** @var \Doctrine\DBAL\Driver\Statement $statement */
      $recordList = $queryBuilder
        ->select($selectFields)
        ->from($fromTable)
        ->where(
          $queryBuilder->expr()->eq('rate_url', $queryBuilder->createNamedParameter($rateUrl)),
          $queryBuilder->expr()->eq('rate_ip', $queryBuilder->createNamedParameter($_SERVER['REMOTE_ADDR']))
        )
        ->setMaxResults($limit)
        ->execute()->fetchAll();

      $queryBuilder->resetQueryParts();


			if(count($recordList) == 0) {
				// Store to DB
				$into_table   = 'tx_contentrating_rates';
				$field_values = array(
				  'pid' => 1,
          'rate_url' => $rateUrl,
          'rate_ip' => $_SERVER['REMOTE_ADDR'],
          'rate_value' => $rateValue,
          'tstamp' => time(),
          'crdate' => time()
				);

        $queryBuilder
          ->insert($into_table)
          ->values($field_values)
          ->execute();

			} else {
				// Update DB
				$into_table   = 'tx_contentrating_rates';

        $queryBuilder
          ->update($into_table)
          ->set('rate_value', $rateValue)
          ->set('tstamp', time())
          ->where(
            $queryBuilder->expr()->eq('rate_url', $queryBuilder->createNamedParameter($rateUrl)),
            $queryBuilder->expr()->eq('rate_ip', $queryBuilder->createNamedParameter($_SERVER['REMOTE_ADDR']))
          )->execute();
      }

			// New Calc return
			$selectFields = '*';
			$fromTable    = 'tx_contentrating_rates';

			$queryBuilder->resetQueryParts();

      $recordList = $queryBuilder
        ->select($selectFields)
        ->from($fromTable)
        ->where(
          $queryBuilder->expr()->eq('rate_url', $queryBuilder->createNamedParameter($rateUrl))
        )->execute()->fetchAll();

      $this->rate_count = count($recordList);


      foreach($recordList as $record) {
          $this->rate_tmp1 = $this->rate_tmp1 + $record['rate_value'];
      }

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