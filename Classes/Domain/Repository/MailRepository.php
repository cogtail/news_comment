<?php
/**
 * User: Cogtail
 * Email: shake-it@cogtail.de
 * Date: 11.08.16
 * Time: 13:00
 */

namespace Cogtail\NewsComment\Domain\Repository;


use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

use TYPO3\CMS\Extbase\Persistence\QueryInterface;

class MailRepository extends \In2code\Powermail\Domain\Repository\MailRepository {


    public function initializeObject() {
        /**
         * @var $querySettings \TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings
         */
        $querySettings = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\Typo3QuerySettings');
        // go for $defaultQuerySettings = $this->createQuery()->getQuerySettings(); if you want to make use of the TS persistence.storagePid with defaultQuerySettings(), see #51529 for details

        // don't add the pid constraint
        $querySettings->setRespectStoragePage(FALSE);

        $this->setDefaultQuerySettings($querySettings);
    }

    /**
     * @var \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface
     * @inject
     */
    protected $configurationManager;

    protected function getNewsSettings() {
        $news = \TYPO3\CMS\Core\Utility\GeneralUtility::_GP('tx_news_pi1');
        if (count($news) > 0) {
            return $news['news'];
        } else {
            return false;
        }

    }


    public function findListBySettings($settings, $piVars) {

        $settings = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FULL_TYPOSCRIPT);
        if (isset($settings['plugin.']['tx_newscomment.']['settings.']['filterUid'])) {
            $settings = $settings['plugin.']['tx_newscomment.']['settings.'];
        } else {
            $settings = false;
        }

        $news = $this->getNewsSettings();
        if ($news && $settings) {
            $piVars['filter'][$settings['filterUid']] = $news;
        }
        $query = $this->createQuery();


        /**
         * FILTER start
         */
        $and = array(
            $query->greaterThan('uid', 0)
        );

        // FILTER: form
        if ((int)$settings['main']['form'] > 0) {
            $and[] = $query->equals('form', $settings['main']['form']);
        }

        // FILTER: pid
        if ((int)$settings['main']['pid'] > 0) {
            $and[] = $query->equals('pid', $settings['main']['pid']);
        }

        // FILTER: delta
        if ((int)$settings['list']['delta'] > 0) {
            $and[] = $query->greaterThan('crdate', (time() - $settings['list']['delta']));
        }

        // FILTER: showownonly
        if ($settings['list']['showownonly']) {
            $and[] = $query->equals('feuser', $GLOBALS['TSFE']->fe_user->user['uid']);
        }

        // FILTER: abc
        if (isset($piVars['filter']['abc'])) {
            $and[] = $query->equals('answers.field', $settings['search']['abc']);
            $and[] = $query->like('answers.value', $piVars['filter']['abc'] . '%');
        }

        // FILTER: field
        if (isset($piVars['filter'])) {
            // fulltext
            $filter = array();
            if (!empty($piVars['filter']['_all'])) {
                $filter[] = $query->like('answers.value', '%' . $piVars['filter']['_all'] . '%');
            }

            // single field search
            foreach ((array)$piVars['filter'] as $field => $value) {
                if (is_numeric($field) && !empty($value)) {
                    $filterAnd = array(
                        $query->equals('answers.field', $field),
                        $query->like('answers.value', '%' . $value . '%')
                    );
                    $filter[] = $query->logicalAnd($filterAnd);
                }
            }

            if (count($filter) > 0) {
                // switch between AND and OR
                if (
                    !empty($settings['search']['logicalRelation']) &&
                    strtolower($settings['search']['logicalRelation']) === 'and'
                ) {
                    $and[] = $query->logicalAnd($filter);
                } else {
                    $and[] = $query->logicalOr($filter);
                }
            }

        }

        // FILTER: create constraint
        $constraint = $query->logicalAnd($and);
        $query->matching($constraint);

        // sorting
        $query->setOrderings(array('crdate' => QueryInterface::ORDER_ASCENDING));

        // set limit
        if ((int)$settings['list']['limit'] > 0) {
            $query->setLimit((int)$settings['list']['limit']);
        }

        $mails = $query->execute();
        return $mails;
    }

    public function findByNewsId($id) {
        $settings = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FULL_TYPOSCRIPT);
        $query = $this->createQuery();
        if (isset($settings['plugin.']['tx_newscomment.']['settings.']['filterUid'])) {
            $uid = $settings['plugin.']['tx_newscomment.']['settings.']['filterUid'];
        } else {
            $uid = false;
        }
        
        $filterAnd = array(
            $query->equals('answers.field', $uid),
            $query->like('answers.value', '%' . $id . '%')
        );
        $filter[] = $query->logicalAnd($filterAnd);
        $query->matching($query->logicalAnd($filter));
        return $query->execute();
    }

    /**
     * @param \Cogtail\NewsComment\Domain\Model\Mail $object
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\IllegalObjectTypeException
     */
    public function add($object) {
        $objType = $this->objectType;
        $this->objectType = "In2Code\\Powermail\\Domain\\Model\\Mail";
        $this->objectType = "In2Code\\Powermail\\Domain\\Model\\Mail";
        parent::add($object);
        $this->objectType = $objType;
    }

    /**
     * @param object $object
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\IllegalObjectTypeException
     */
    public function update($object) {
        $objType = $this->objectType;
        $this->objectType = "In2Code\\Powermail\\Domain\\Model\\Mail";
        parent::update($object);
        $this->objectType = $objType;
    }
}