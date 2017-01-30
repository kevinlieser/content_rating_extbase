<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'TYPO3.' . $_EXTKEY,
	'Contentrating',
	array(
		'ContentRating' => 'show',
		
	),
	// non-cacheable actions
	array(
		
	)
);

$TYPO3_CONF_VARS['FE']['eID_include']['contentratingajax'] = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('content_rating_extbase').'Classes/Ajax.php';


?>