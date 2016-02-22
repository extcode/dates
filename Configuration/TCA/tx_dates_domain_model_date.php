<?php

defined('TYPO3_MODE') or die();

$_LLL = 'LLL:EXT:dates/Resources/Private/Language/locallang_db.xlf';

return [
    'ctrl' => [
        'title' => $_LLL . ':tx_dates_domain_model_date',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => true,

        'versioningWS' => 2,
        'versioning_followPages' => true,
        'origUid' => 't3_origuid',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'searchFields' => 'typ,target_group,title,start,end,website,booth_number,description,is_bookable,is_teaser,locations,representative,',

        'iconfile' => 'EXT:dates/Resources/Public/Icons/tx_dates_domain_model_date.gif'
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, typ, target_group, title, short_title, start, end, opening_times, website, fair_hall, booth_number, description, is_bookable, is_teaser, location, representative',
    ],
    'types' => [
        '1' => ['showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, typ, target_group, title, short_title, --palette--;LLL:EXT:dates/Resources/Private/Language/locallang_db.xml:tx_dates_domain_model_date.group.date;date, website, --palette--;LLL:EXT:dates/Resources/Private/Language/locallang_db.xml:tx_dates_domain_model_date.group.fair;fair, description, is_bookable, is_teaser, locations, representative,--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,starttime, endtime'],
    ],
    'palettes' => [
        '1' => ['showitem' => ''],
        'fair' => ['showitem' => 'fair_hall, booth_number', 'canNotCollapse' => 1],
        'date' => ['showitem' => 'is_full_time, start, end, --linebreak--, opening_times', 'canNotCollapse' => 1],
    ],
    'columns' => [
        'sys_language_uid' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
            'config' => [
                'type' => 'select',
                'foreign_table' => 'sys_language',
                'foreign_table_where' => 'ORDER BY sys_language.title',
                'items' => [
                    ['LLL:EXT:lang/locallang_general.xml:LGL.allLanguages', -1],
                    ['LLL:EXT:lang/locallang_general.xml:LGL.default_value', 0]
                ],
            ],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'items' => [
                    ['', 0],
                ],
                'foreign_table' => 'tx_dates_domain_model_date',
                'foreign_table_where' => 'AND tx_dates_domain_model_date.pid=###CURRENT_PID### AND tx_dates_domain_model_date.sys_language_uid IN (-1,0)',
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        't3ver_label' => [
            'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.versionLabel',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
            ]
        ],
        'hidden' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
            'config' => [
                'type' => 'check',
            ],
        ],
        'starttime' => [
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
            'config' => [
                'type' => 'input',
                'size' => 13,
                'max' => 20,
                'eval' => 'datetime',
                'checkbox' => 0,
                'default' => 0,
                'range' => [
                    'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
                ],
            ],
        ],
        'endtime' => [
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
            'config' => [
                'type' => 'input',
                'size' => 13,
                'max' => 20,
                'eval' => 'datetime',
                'checkbox' => 0,
                'default' => 0,
                'range' => [
                    'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
                ],
            ],
        ],
        'typ' => [
            'exclude' => 1,
            'label' => $_LLL . ':tx_dates_domain_model_date.typ',
            'config' => [
                'type' => 'select',
                'items' => [
                    [$_LLL . ':tx_dates_domain_model_date.typ.0', 0],
                    [$_LLL . ':tx_dates_domain_model_date.typ.1', 1],
                ],
                'size' => 1,
                'maxitems' => 1,
                'eval' => 'required'
            ],
        ],
        'target_group' => [
            'exclude' => 1,
            'label' => $_LLL . ':tx_dates_domain_model_date.target_group',
            'config' => [
                'type' => 'select',
                'items' => [
                    [
                        $_LLL . ':tx_dates_domain_model_date.target_group.0',
                        0
                    ],
                    [
                        $_LLL . ':tx_dates_domain_model_date.target_group.1',
                        1
                    ],
                ],
                'size' => 1,
                'maxitems' => 1,
                'eval' => 'required'
            ],
        ],
        'title' => [
            'exclude' => 0,
            'label' => $_LLL . ':tx_dates_domain_model_date.title',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required'
            ],
        ],
        'short_title' => [
            'exclude' => 0,
            'label' => $_LLL . ':tx_dates_domain_model_date.short_title',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'is_full_time' => [
            'exclude' => 1,
            'label' => $_LLL . ':tx_dates_domain_model_date.is_full_time',
            'config' => [
                'type' => 'check',
                'default' => 0
            ],
        ],
        'start' => [
            'exclude' => 0,
            'label' => $_LLL . ':tx_dates_domain_model_date.start',
            'config' => [
                'type' => 'input',
                'size' => 10,
                'eval' => 'datetime,required',
                'checkbox' => 1,
                'default' => time()
            ],
        ],
        'end' => [
            'exclude' => 0,
            'label' => $_LLL . ':tx_dates_domain_model_date.end',
            'config' => [
                'type' => 'input',
                'size' => 10,
                'eval' => 'datetime,required',
                'checkbox' => 1,
                'default' => time()
            ],
        ],
        'opening_times' => [
            'exclude' => 0,
            'label' => $_LLL . ':tx_dates_domain_model_date.opening_times',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
                'wizards' => [
                    'RTE' => [
                        'icon' => 'wizard_rte2.gif',
                        'notNewRecords' => 1,
                        'RTEonly' => 1,
                        'script' => 'wizard_rte.php',
                        'title' => 'LLL:EXT:cms/locallang_ttc.xml:bodytext.W.RTE',
                        'type' => 'script'
                    ]
                ]
            ],
            'defaultExtras' => 'richtext:rte_transform[flag=rte_enabled|mode=ts]',
        ],
        'website' => [
            'exclude' => 1,
            'label' => $_LLL . ':tx_dates_domain_model_date.website',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'fair_hall' => [
            'exclude' => 1,
            'label' => $_LLL . ':tx_dates_domain_model_date.fair_hall',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'booth_number' => [
            'exclude' => 1,
            'label' => $_LLL . ':tx_dates_domain_model_date.booth_number',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'description' => [
            'exclude' => 0,
            'label' => $_LLL . ':tx_dates_domain_model_date.description',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
                'wizards' => [
                    'RTE' => [
                        'icon' => 'wizard_rte2.gif',
                        'notNewRecords' => 1,
                        'RTEonly' => 1,
                        'script' => 'wizard_rte.php',
                        'title' => 'LLL:EXT:cms/locallang_ttc.xml:bodytext.W.RTE',
                        'type' => 'script'
                    ]
                ]
            ],
            'defaultExtras' => 'richtext:rte_transform[flag=rte_enabled|mode=ts]',
        ],
        'is_bookable' => [
            'exclude' => 1,
            'label' => $_LLL . ':tx_dates_domain_model_date.is_bookable',
            'config' => [
                'type' => 'check',
                'default' => 0
            ],
        ],
        'is_teaser' => [
            'exclude' => 1,
            'label' => $_LLL . ':tx_dates_domain_model_date.is_teaser',
            'config' => [
                'type' => 'check',
                'default' => 0
            ],
        ],
        'locations' => [
            'exclude' => 1,
            'label' => $_LLL . 'tx_dates_domain_model_date.locations',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'foreign_table' => 'tx_dates_domain_model_location',
                'allowed' => 'tx_dates_domain_model_location',
                'size' => 5,
                'maxitems' => 100,
                'MM' => 'tx_dates_domain_model_date_location_mm',
                'wizards' => [
                    'suggest' => [
                        'type' => 'suggest',
                        'tx_dates_domain_model_location' => [
                            'maxItemsInResultList' => 5,
                        ],
                    ],
                ],
            ]
        ],
        'representative' => [
            'exclude' => 1,
            'label' => $_LLL . ':tx_dates_domain_model_date.representative',
            'config' => [
                'type' => 'select',
                'foreign_table' => 'tt_address',
                'foreign_table_where' => 'AND tt_address.pid IN(###PAGE_TSCONFIG_IDLIST###) ORDER BY last_name',
                'MM' => 'tx_dates_dates_representatives_mm',
                'size' => 10,
                'autoSizeMax' => 30,
                'maxitems' => 9999,
                'multiple' => 0,
                'wizards' => [
                    '_PADDING' => 1,
                    '_VERTICAL' => 1,
                    'edit' => [
                        'type' => 'popup',
                        'title' => 'Edit',
                        'script' => 'wizard_edit.php',
                        'icon' => 'edit2.gif',
                        'popup_onlyOpenIfSelected' => 1,
                        'JSopenParams' => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
                    ],
                    'add' => [
                        'type' => 'script',
                        'title' => 'Create new',
                        'icon' => 'add.gif',
                        'params' => [
                            'table' => 'tt_address',
                            'pid' => '###CURRENT_PID###',
                            'setValue' => 'prepend'
                        ],
                        'script' => 'wizard_add.php',
                    ],
                ],
            ],
        ],
    ],
];
