<?php
/**
 * Mage Scan
 *
 * PHP version 5
 *
 * @author    Steve Robbins <steven.j.robbins@gmail.com>
 * @license   http://creativecommons.org/licenses/by/4.0/
 * @link      https://github.com/steverobbins/magescan
 */

namespace MageScan\Check;

use MageScan\Request;

/**
 * Check for installed modules
 */
class Module
{
    /**
     * Files and the modules they belong to
     *
     * @var array
     */
    public $files = array(
        'js/amasty/ampreorder/product_view_composite.js'                          => 'Amasty_Preorder',
        'js/fooman/adminhtml/grid.js'                                             => 'Fooman_OrderManager',
        'js/mw_rewardpoints/js.js'                                                => 'MW_RewardPoints',
        'skin/adminhtml/base/default/bronto/bronto.css'                           => 'Bronto_Common',
        'skin/adminhtml/default/default/amasty/ampgrid/grid.css'                  => 'Amasty_Pgrid',
        'skin/adminhtml/default/default/aoe_scheduler/JavaScript/common.js'       => 'Aoe_Scheduler',
        'skin/adminhtml/default/default/aw_blog/css/style.css'                    => 'AW_Blog',
        'skin/adminhtml/default/default/gomage/feed.css'                          => 'GoMage_Feed',
        'skin/adminhtml/default/default/webforms/stars.css'                       => 'VladimirPopov_WebForms',
        'skin/adminhtml/default/default/zendesk/zendesk.css'                      => 'Zendesk_Zendesk',
        'skin/frontend/base/default/aw_islider/representations/default/style.css' => 'AW_Islider',
        'skin/frontend/base/default/css/ecommerceteam/echeckout/default.css'      => 'EcommerceTeam_EasyCheckout',
        'skin/frontend/base/default/css/fisheye/faq.css'                          => 'Fisheye_Faq',
        'skin/frontend/base/default/css/magebuzz/featuredcategory.css'            => 'Magebuzz_Featuredcategory',
        'skin/frontend/base/default/css/magesetup/default.css'                    => 'FireGento_MageSetup',
        'skin/frontend/base/default/css/magestore/onestepcheckout.css'            => 'Magestore_Onestepcheckout',
        'skin/frontend/base/default/css/magestore/sociallogin.css'                => 'Magestore_Sociallogin',
        'skin/frontend/base/default/css/mageworx/downloads.css'                   => 'MageWorx_Downloads',
        'skin/frontend/base/default/css/mana_core.css'                            => 'Mana_Core',
        'skin/frontend/base/default/css/mana_filters.css'                         => 'Mana_Filters',
        'skin/frontend/base/default/css/orange35_colorpicker/configurable.css'    => 'Orange35_Colorpicker',
        'skin/frontend/base/default/css/vertnav.css'                              => 'RicoNeitzel_VertNav',
        'skin/frontend/base/default/css/xsitemap.css'                             => 'MageWorx_XSitemap',
        'skin/frontend/base/default/ig_lightbox2/lightbox/js/jquery.js'           => 'IG_LightBox2',
        'skin/frontend/base/default/js/ajaxpro.js'                                => 'TM_AjaxPro',
        'skin/frontend/base/default/js/infinitescroll/ias_config.js'              => 'Strategery_Infinitescroll',
        'skin/frontend/base/default/lengow/js/tracker.js'                         => 'Lengow_Tracker',
        'skin/frontend/base/default/turnkeye/testimonial/css/testimonial.css'     => 'Turnkeye_Testimonial',
        'skin/frontend/base/default/wordpress/styles.css'                         => 'FishPig_WordPress',
        'skin/frontend/default/default/css/magebuzz/youtubevideo.css'             => 'Magebuzz_Youtubevideo',
        'skin/frontend/rwd/default/relatedproducts/css/styles.css'                => 'AW_Relatedproducts',
    );

    /**
     * Check for module files that exist in a url
     *
     * @param  string $url
     * @return array
     */
    public function checkForModules($url)
    {
        $modules = array();
        $request = new Request;
        foreach ($this->files as $file => $name) {
            $response = $request->fetch($url . $file, array(
                CURLOPT_NOBODY         => true,
                CURLOPT_FOLLOWLOCATION => true
            ));
            if ($response->code == 200 && (!isset($modules[$name]) || $modules[$name] === false)) {
                $modules[$name] = true;
            } else {
                $modules[$name] = false;
            }
        }
        ksort($modules);
        return $modules;
    }
}
