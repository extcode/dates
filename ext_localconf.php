<?php

defined('TYPO3_MODE') or die();

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Extcode.' . $_EXTKEY,
    'Dates',
    [
        'Dates' => 'list, detail, teaser, show, register, confirmation',
    ],
    // non-cacheable actions
    [
        'Dates' => 'register',
    ]
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Extcode.' . $_EXTKEY,
    'Singledate',
    [
        'Dates' => 'singledate, register, confirmation',
    ],
    // non-cacheable actions
    [
        'Dates' => 'register',
    ]
);

if (TYPO3_MODE == 'FE') {
    // For FE usage via eID
    $TYPO3_CONF_VARS['FE']['eID_include']['datesAjaxDispatcher'] =
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('dates') . 'Classes/Utility/eIDDispatcher.php';
}

if (TYPO3_MODE == 'BE') {
    // For BE usage via ajax
    $TYPO3_CONF_VARS['BE']['AJAX']['datesAjaxDispatcher'] =
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('dates') . 'Classes/Utility/AjaxDispatcher.php:' .
        'Tx_Dates_Utility_AjaxDispatcher->dispatch';
}

// register ke_search indexer
$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['ke_search']['registerIndexerConfiguration'][] = 'EXT:dates/Classes/Hooks/class.user_datesindexer.php:user_datesindexer';
$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['ke_search']['customIndexer'][] = 'EXT:dates/Classes/Hooks/class.user_datesindexer.php:user_datesindexer';
