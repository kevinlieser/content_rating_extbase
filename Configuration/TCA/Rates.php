<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$GLOBALS['TCA']['tx_contentrating_rates'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:content_rating_extbase/Resources/Private/Language/locallang_db.xlf:tx_contentratingextbase_domain_model_rates',
		'label' => 'rate_url',
	),
	'interface' => array(
		'showRecordFieldList' => 'rate_url, rate_pid, rate_getvars, rate_ip, rate_value',
	),
	'types' => array(
		'1' => array('showitem' => 'rate_url, rate_pid, rate_getvars, rate_ip, rate_value'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(
		'rate_url' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:content_rating_extbase/Resources/Private/Language/locallang_db.xlf:tx_contentrating_rates.rateurl',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim'
			),
		),
		'rate_pid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:content_rating_extbase/Resources/Private/Language/locallang_db.xlf:tx_contentrating_rates.ratepid',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim'
			),
		),
		'rate_getvars' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:content_rating_extbase/Resources/Private/Language/locallang_db.xlf:tx_contentrating_rates.rategetvars',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim'
			),
		),
		'rate_ip' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:content_rating_extbase/Resources/Private/Language/locallang_db.xlf:tx_contentrating_rates.rateip',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim'
			),
		),
		'rate_value' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:content_rating_extbase/Resources/Private/Language/locallang_db.xlf:tx_contentrating_rates.ratevalue',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			),
		),
		
	),
);

?>
