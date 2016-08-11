<?php
/**
 * User: Cogtail
 * Email: shake-it@cogtail.de
 * Date: 11.08.16
 * Time: 13:00
 */

namespace Cogtail\NewsComment\ViewHelpers;


use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

class UrlViewHelper extends AbstractViewHelper {

    /**
     * @var \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface
     * @inject
     */
    protected $configurationManager;

    /**
     * @param \Cogtail\NewsComment\Domain\Model\Mail $data
     */
    public function render($data) {
        $settings = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FULL_TYPOSCRIPT);

        $websiteUid = $settings['plugin.']['tx_newscomment.']['settings.']['websiteUid'];
        /**
         * @var \In2code\Powermail\Domain\Model\Answer $answer
         */
        $url = "";

        foreach ($data->getAnswers() as $answer) {

            if ($answer->getField()->getUid() == $websiteUid) {
                $url = $answer->getValue();
            }

        }
        return $url;
    }

}