<?php
namespace Cogtail\NewsComment\Domain\Model;
/**
 * User: Cogtail
 * Email: shake-it@cogtail.de
 * Date: 11.08.16
 * Time: 13:00
 */

use \In2Code\Powermail\Domain\Model\Mail as PowerMail_Mail;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;


require_once (ExtensionManagementUtility::extPath('powermail')."Classes/Domain/Model/Mail.php");
class Mail extends PowerMail_Mail {

}