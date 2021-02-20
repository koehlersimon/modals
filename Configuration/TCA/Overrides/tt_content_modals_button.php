<?php
defined('TYPO3_MODE') or die();

call_user_func(function () {
	$frontendLanguageFilePrefix = 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:';

	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
		'tt_content',
		'CType',
		[
			'LLL:EXT:modals/Resources/Private/Language/locallang.xlf:content_element.modals_button.title',
			'modals_button',
			'modals'
		],
		'header',
		'after'
	);

	// New palette button
	$GLOBALS['TCA']['tt_content']['palettes']['modals_button_button'] = array(
		'showitem' => 'tx_modals_button_label, tx_modals_type, --linebreak--, tx_modals_modal_title, --linebreak--, tx_modals_source, --linebreak--, bodytext, tx_modals_content_elements','canNotCollapse' => 1
	);

	// New palette header
	$GLOBALS['TCA']['tt_content']['palettes']['modals_button_header'] = array(
		'showitem' => 'header,header_layout,--linebreak--,--linebreak--,subheader,header_position,date','canNotCollapse' => 1
	);

	$GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['modals_button'] = 'modals_button';
	$GLOBALS['TCA']['tt_content']['types']['modals_button'] = [
		'showitem' => '
                --palette--;' . $frontendLanguageFilePrefix . 'palette.general;general,
                --palette--;Header;modals_button_header,
				--palette--;Button;modals_button_button,
				--div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
				--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
            	--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
                --palette--;;language,
            	--div--;' . $frontendLanguageFilePrefix . 'tabs.access,
                hidden;' . $frontendLanguageFilePrefix . 'field.default.hidden,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.access;access,
            	--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
                rowDescription,
        ',
		'columnsOverrides' => [
			'bodytext' => [
				'label' => 'Modal Content',
                'config' => [
                    'enableRichtext' => true,
                ]
            ],
        ]
    ];

	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', [
	    'tx_modals_button_label' => [
			'label' => 'LLL:EXT:modals/Resources/Private/Language/locallang.xlf:tt_content.tx_modals_button_label',
			'config' => [
	            'type' => 'input',
			],
	    ],
		'tx_modals_source' => [
			'displayCond' =>'FIELD:tx_modals_type:=:iframe',
			'label' => 'LLL:EXT:modals/Resources/Private/Language/locallang.xlf:tt_content.tx_modals_source',
			'config' => [
	            'type' => 'input',
			],
	    ],
		'tx_modals_modal_title' => [
			'label' => 'LLL:EXT:modals/Resources/Private/Language/locallang.xlf:tt_content.tx_modals_modal_title',
			'config' => [
	            'type' => 'input',
			],
	    ],
		'tx_modals_type' => [
			'label' => 'LLL:EXT:modals/Resources/Private/Language/locallang.xlf:tt_content.tx_modals_type',
			'config' => [
	            'type' => 'select',
				'renderType' => 'selectSingle',
				'items' => [
					['Default','default'],
					/*
					['HTML','html'],
					['Content Element','content'],
					['Target Container','target'],
					['URL in iFrame','iframe'],
					*/
				],
			],
	    ],
		'tx_modals_content_elements' => [
			 'displayCond' =>'FIELD:tx_modals_type:=:content',
	         'exclude' => 1,
	         'label' => 'Content Elements',
	         'config' => [
	            'type' => 'group',
	            'internal_type' => 'db',
	            'allowed' => 'tt_content',
	            'maxitems' => 10,
	            'minitems' => 1,
	            'size' => 5,
	            'default' => 0,
	            'suggestOptions' => [
	               'default' => [
	                  'additionalSearchFields' => 'header, subheader'
	               ],
	            ],
         ],
      ],
	]);

});
