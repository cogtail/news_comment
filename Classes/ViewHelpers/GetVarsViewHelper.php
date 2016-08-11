<?php
/**
 * User: Cogtail
 * Email: shake-it@cogtail.de
 * Date: 11.08.16
 * Time: 13:00
 */

namespace Cogtail\NewsComment\ViewHelpers;


use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

class GetVarsViewHelper extends AbstractViewHelper {

    public function render() {
        $get = array();
        foreach ($_GET as $key => $val) {
            if ($key != 'cHash') {
                $get[$key] = $val;
            }
        }
        return $get;
    }

}