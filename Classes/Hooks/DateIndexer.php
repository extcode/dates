<?php

namespace Extcode\Dates\Hooks;

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
 * DateIndexer Hook
 *
 * @author Daniel Lorenz <ext.dates@extco.de>
 */
class DateIndexer
{

    /**
     * registerIndexerConfiguration
     *
     * @param array $params
     * @param object $pObj
     */
    public function registerIndexerConfiguration(&$params, $pObj)
    {
        $newArray = [
            'Dates Indexer',
            'txdatesindexer',
            t3lib_extMgm::extRelPath('dates') . 'ext_icon.gif'
        ];
        $params['items'][] = $newArray;

        $GLOBALS['TCA']['tx_kesearch_indexerconfig']['columns']['index_content_with_restrictions']['displayCond'] .= ',txdatesindexer';
        $GLOBALS['TCA']['tx_kesearch_indexerconfig']['columns']['startingpoints_recursive']['displayCond'] .= ',txdatesindexer';
    }

    /**
     * Custom indexer for ke_search
     *
     * @param array $indexerConfig Configuration from TYPO3 Backend
     * @param array $indexerObject Reference to indexer class.
     *
     * @return string
     */
    public function customIndexer(&$indexerConfig, &$indexerObject)
    {
        if ($indexerConfig['type'] == 'txdatesindexer') {
            return $this->txdatesIndexer($indexerConfig, $indexerObject);
        }

        return '';
    }

    /**
     * Custom indexer for tx_dates
     *
     * @param array $indexerConfig Configuration from TYPO3 Backend
     * @param array $indexerObject Reference to indexer class.
     *
     * @return string
     */
    public function txdatesIndexer(&$indexerConfig, &$indexerObject)
    {
        $startingpointsRecursive = $indexerConfig['startingpoints_recursive'];
        $queryGenerator = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('t3lib_queryGenerator');

        $startingpointsRecursive = explode(',', $startingpointsRecursive);
        $pids = [];
        foreach ($startingpointsRecursive as $startingpoint) {
            $pids[] = $queryGenerator->getTreeList($startingpoint, 5, 0, 1);
        }
        $pids = implode(',', $pids);

        $content = '';
        $returnContent = '';

        $res = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
            'tx_dates_domain_model_date.*,
				GROUP_CONCAT(DISTINCT location.city SEPARATOR "|") AS _locations,
				GROUP_CONCAT(DISTINCT representatives.name SEPARATOR "|") as _representatives',

            'tx_dates_domain_model_date
				LEFT JOIN
					tx_dates_dates_locations_mm
				ON
					tx_dates_domain_model_date.uid = tx_dates_dates_locations_mm.uid_local
				LEFT JOIN
					tt_address AS location
				ON
					location.uid = tx_dates_dates_locations_mm.uid_foreign
				LEFT JOIN
					tx_dates_dates_representatives_mm
				ON
					tx_dates_domain_model_date.uid = tx_dates_dates_representatives_mm.uid_local
				LEFT JOIN
					tt_address AS representatives
				ON
					representatives.uid = tx_dates_dates_representatives_mm.uid_foreign',

            'tx_dates_domain_model_date.pid IN (' . $pids . ') AND tx_dates_domain_model_date.start >= ' . strtotime('today midnight')
            . t3lib_pageSelect::enableFields('tx_dates_domain_model_date'),

            'tx_dates_domain_model_date.uid'
        );

        $resCount = $GLOBALS['TYPO3_DB']->sql_num_rows($res);

        if ($resCount) {
            while (($record = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res))) {
                $title = $record['title'];

                $locations = $this->harmonize($record['_locations']);
                $representatives = $this->harmonize($record['_representatives']);

                $content = $record['title'] . "\n"
                    . strip_tags($record['description']) . "\n"
                    . $record['short_title'] . "\n"
                    . 'Veranstaltungsort: ' . $locations . "\n"
                    . 'Werksvertretung: ' . $representatives . "\n";

                $abstract = substr($content, 0, 100) . '...';
                $fullContent = $title . "\n" . $abstract . "\n" . $content;
                $params = '&tx_dates_dates[date]=' . $record['uid']
                    . '&tx_dates_dates[action]=show&tx_dates_dates[controller]=Dates';
                $tags = '';
                $additionalFields = [
                    'sortdate' => $record['crdate'],
                    'orig_uid' => $record['uid'],
                    'orig_pid' => $record['pid'],
                ];

                $indexerObject->storeInIndex(
                    $indexerConfig['storagepid'],
                    $title,
                    'txdatesindexer',
                    $indexerConfig['targetpid'],
                    $fullContent,
                    $tags,
                    $params,
                    $abstract,
                    $record['sys_language_uid'],
                    $record['starttime'],
                    $record['endtime'],
                    $record['fe_group'],
                    false,
                    $additionalFields
                );
            }
            $returnContent = '<p><b>Indexer "' . $indexerConfig['title'] . '": ' . $resCount . ' Elements have been indexed.</b></p>';
        }

        return $returnContent;
    }

    /**
     * harmonize
     *
     * @param string $string
     * @return string
     */
    public function harmonize($string)
    {
        return str_replace(
            ['NULL', '|'],
            ['', ' '],
            $string
        );
    }
}
