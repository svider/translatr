<?php
/** @var string $_EXTKEY */

defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function ($extKey) {
        if (TYPO3_MODE === 'BE') {

            /**
             * Registers a Backend Module
             */
            \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
                'SourceBroker.'.$extKey,
                'web',
                'translate',
                '',
                array(
                    'Label' => 'list',
                ),
                array(
                    'access' => 'user,group',
                    'icon' => 'EXT:'.$extKey.'/Resources/Public/Backend/Icons/translate.svg',
                    'labels' => 'LLL:EXT:'.$extKey.'/Resources/Private/Language/locallang_translate.xlf',
                )
            );
        }

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_translatr_domain_model_label',
            'EXT:translatr/Resources/Private/Language/locallang_csh_tx_translatr_domain_model_label.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_translatr_domain_model_label');

        $GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['formDataGroup']['tcaDatabaseRecord'][SourceBroker\Translatr\Backend\FormDataProvider\LabelRowInitializeNew::class] = [
            'depends' => [
                \TYPO3\CMS\Backend\Form\FormDataProvider\DatabaseRowInitializeNew::class,
            ],
        ];
    },
    $_EXTKEY
);

