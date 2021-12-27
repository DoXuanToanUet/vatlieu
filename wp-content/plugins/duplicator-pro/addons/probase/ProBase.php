<?php

/**
 * Version Pro Base addon class
 *
 * Name: Duplicator PRO base
 * Version: 1
 * Author: Snap Creek
 * Author URI: http://snapcreek.com
 *
 * PHP version 5.3
 *
 * @category  Duplicator
 * @package   Plugin
 * @author    Snapcreek <admin@snapcreek.com>
 * @copyright 2011-2021  Snapcreek LLC
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @version   GIT: $Id$
 * @link      http://snapcreek.com
 */

namespace Duplicator\Addons\ProBase;

defined('ABSPATH') || defined('DUPXABSPATH') || exit;

require_once __DIR__ . '/vendor/edd/Duplicator_EDD_SL_Plugin_Updater.php';

use Duplicator\Controllers\SchedulePageController;
use Duplicator\Addons\ProBase\License\License;
use Duplicator\Addons\ProBase\License\Notices;

/**
 * Version Pro Base addon class
 *
 * @category Duplicator
 * @package  Plugin
 * @author   Snapcreek <admin@snapcreek.com>
 * @license  https://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @link     http://snapcreek.com
 */
class ProBase extends \Duplicator\Core\Addons\AbstractAddonCore
{

    /**
     * @return void
     */
    public function init()
    {
        add_action('duplicator_addons_loaded', array($this, 'addonsLoaded'));
        add_action('duplicator_unistall', array($this, 'unistall'));

        add_filter('duplicator_main_menu_label', function () {
            return 'Duplicator Pro';
        });

        add_filter('duplicator_menu_pages', array($this, 'addScheduleMenuField'));

        Notices::init();
        LicensingController::init();
    }

    /**
     * Unistall
     *
     * @return void
     */
    public function unistall()
    {
        if (strlen(License::getLicenseKey()) > 0) {
            switch (License::changeLicenseActivation(false)) {
                case License::ACTIVATION_RESPONSE_OK:
                    break;
                case License::ACTIVATION_RESPONSE_POST_ERROR:
                    \DUP_PRO_Low_U::errLog("Error deactivate license: ACTIVATION_RESPONSE_POST_ERROR");
                    break;
                case License::ACTIVATION_RESPONSE_INVALID:
                default:
                    \DUP_PRO_Low_U::errLog("Error deactivate license: ACTIVATION_RESPONSE_INVALID");
                    break;
            }
        }
    }

    /**
     *
     * @param [AbstractMenuPageController] $basicMenuPages
     *
     * @return [AbstractMenuPageController]
     */
    public function addScheduleMenuField($basicMenuPages)
    {
        $basicMenuPages[] = SchedulePageController::getInstance();
        return $basicMenuPages;
    }

    /**
     *
     */
    public function addonsLoaded()
    {
        License::check();
    }

    /**
     *
     * @return string
     */
    public static function getAddonPath()
    {
        return __DIR__;
    }

    /**
     *
     * @return string
     */
    public static function getAddonFile()
    {
        return __FILE__;
    }
}
