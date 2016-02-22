<?php

defined('TYPO3_MODE') or die();

$_LLL = 'LLL:EXT:dates/Resources/Private/Language/locallang_db.xlf';

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Dates');

/**
 * Register Frontend Plugins
 */

$pluginNames = [
    'Dates',
    'Singledate',
];

foreach ($pluginNames as $pluginName) {
    $pluginSignature = strtolower(str_replace('_', '', $_EXTKEY)) . '_' . strtolower($pluginName);
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
        'Extcode.' . $_EXTKEY,
        $pluginName,
        $_LLL . ':tx_dates.plugin.' . lcfirst($pluginName)
    );
    $flexFormPath = 'EXT:' . $_EXTKEY . '/Configuration/FlexForms/' . $pluginName . 'Plugin.xml';
    if (file_exists(\TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($flexFormPath))) {
        $TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
            $pluginSignature,
            'FILE:' . $flexFormPath
        );
    }
}


$tmp_dates_columns = [

];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_address', $tmp_dates_columns);

$TCA['tt_address']['columns'][$TCA['tt_address']['ctrl']['type']]['config']['items'][] = [
    'LLL:EXT:dates/Resources/Private/Language/locallang_db.xml:tt_address.tx_extbase_type.Tx_Dates_Representatives',
    'Tx_Dates_Representatives'
];

$TCA['tt_address']['types']['Tx_Dates_Representatives']['showitem'] = $TCA['tt_address']['types']['1']['showitem'];
$TCA['tt_address']['types']['Tx_Dates_Representatives']['showitem'] .= ',--div--;LLL:EXT:dates/Resources/Private/Language/locallang_db.xml:tx_dates_domain_model_representatives,';
$TCA['tt_address']['types']['Tx_Dates_Representatives']['showitem'] .= '';
