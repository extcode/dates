<?php

/**
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

/**
 * eID Dispatcher
 *
 * @author Daniel Lorenz <ext.dates@extco.de>
 */
require_once \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('dates') . 'Classes/Utility/AjaxDispatcher.php';

// Init TSFE for database access
$GLOBALS['TSFE'] = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('tslib_fe', $TYPO3_CONF_VARS, 0, 0, true);
$GLOBALS['TSFE']->sys_page = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('t3lib_pageSelect');

$GLOBALS['TSFE']->connectToDB();
$GLOBALS['TSFE']->initFEuser();
$GLOBALS['TSFE']->determineId();
$GLOBALS['TSFE']->getCompressedTCarray();
$GLOBALS['TSFE']->initTemplate();
$GLOBALS['TSFE']->getConfigArray();

$dispatcher = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('Tx_Dates_Utility_AjaxDispatcher'); /** @var $dispatcher Tx_Dates_Utility_AjaxDispatcher */

// ATTENTION! Dispatcher first needs to be initialized here!!!
echo $dispatcher->initCallArguments()->dispatch();
