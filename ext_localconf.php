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

// @todo Abfrage des EM und übergabe an Konstanten
call_user_func(
    function($extKey, $_extconf)
    {


        /***************
         * Extension configuration
         */
        if ( $_extconf ) {
            $_extconf = unserialize($_extconf);
        } else {
            # default setting
            $_extconf = [
                'jquery_included' => '1',
                'style' => 'green.orange'
            ];
        }

		
        # Jquery
        if (array_key_exists('jquery_included', $_extconf) && $_extconf['jquery_included'] === '1') {
            # Contstant
            \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptConstants('plugin.content_rating_extbase.jquery_included = 0');
        } else {
            \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptConstants('plugin.content_rating_extbase.jquery_included = 1');
        }



        # Style 1
        if (array_key_exists('style', $_extconf) && $_extconf['style'] === 'green.orange') {
            # Contstant
            \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptConstants('plugin.content_rating_extbase.style = green.orange');
        }
        # Style 2
        else if (array_key_exists('style', $_extconf) && $_extconf['style'] === 'yellow.orange') {
            # Contstant
            \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptConstants('plugin.content_rating_extbase.style = yellow.orange');
        }
        # Style 3
        else if (array_key_exists('style', $_extconf) && $_extconf['style'] === 'blue.gray') {
            # Contstant
            \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptConstants('plugin.content_rating_extbase.style = blue.gray');
        }
        # Style 4
        else if (array_key_exists('style', $_extconf) && $_extconf['style'] === 'pink') {
            # Contstant
            \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptConstants('plugin.content_rating_extbase.style = pink');
        }
        # Style 5
        else if (array_key_exists('style', $_extconf) && $_extconf['style'] === 'stars') {
            # Contstant
            \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptConstants('plugin.content_rating_extbase.style = stars');
        }
		else {
            # Contstant
            \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptConstants('plugin.content_rating_extbase.style = green.orange');
		}





    },
    $_EXTKEY, $_EXTCONF
);



?>