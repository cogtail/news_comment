<?php
/**
 * User: Cogtail
 * Email: shake-it@cogtail.de
 * Date: 11.08.16
 * Time: 13:00
 */

namespace Cogtail\NewsComment\ViewHelpers;


use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

class GravatarViewHelper extends AbstractViewHelper {

    /**
     * @param string $email
     * @param int $s
     * @param string $d
     * @param string $r
     * @param bool|false $img
     * @param array $atts
     * @return string
     */
    public function render($email, $s = 80, $d = 'mm', $r = 'g', $img = false, $atts = array()) {


        $url = 'http://www.gravatar.com/avatar/';
        $url .= md5(strtolower(trim($email)));
        $url .= "?s=$s&d=$d&r=$r";
        if ($img) {
            $url = '<img src="' . $url . '"';
            foreach ($atts as $key => $val)
                $url .= ' ' . $key . '="' . $val . '"';
            $url .= ' />';
        }
        return $url;

    }

}