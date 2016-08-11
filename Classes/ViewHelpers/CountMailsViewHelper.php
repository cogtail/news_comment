<?php
/**
 * User: Cogtail
 * Email: shake-it@cogtail.de
 * Date: 11.08.16
 * Time: 13:00
 */

namespace Cogtail\NewsComment\ViewHelpers;


use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

class CountMailsViewHelper extends AbstractViewHelper {

    /**
     * @var \Cogtail\NewsComment\Domain\Repository\MailRepository
     * @inject
     */
    protected $mailRepository;

    /**
     * @param int $id
     */
    public function render($id) {

        $mails = $this->mailRepository->findByNewsId($id);
        return $mails->count();
    }
}
