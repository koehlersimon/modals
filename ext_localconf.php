<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        $GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects']['TYPO3\CMS\Extbase\Domain\Model\FrontendUser'] = array(
            'className' => 'SIMONKOEHLER\Eleganz\Domain\Model\User'
        );

        $icons = [
            'modals-button' => 'EXT:modals/Resources/Public/Icons/ContentElements/window-maximize.svg'
        ];

        $iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
        foreach ($icons as $identifier => $path) {
            $iconRegistry->registerIcon(
                $identifier,
                \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
                ['source' => $path]
            );
        }

        // Add default RTE configuration
        //$GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['eleganz'] = 'EXT:eleganz/Configuration/RTE/Default.yaml';

    }
);
