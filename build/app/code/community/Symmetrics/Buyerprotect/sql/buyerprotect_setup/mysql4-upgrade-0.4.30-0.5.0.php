<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * @category  Symmetrics
 * @package   Symmetrics_Buyprotect
 * @author    symmetrics - a CGI Group brand <info@symmetrics.de>
 * @author    Ngoc Anh Doan <ngoc-anh.doan@cgi.com>
 * @copyright 2009-2014 symmetrics - a CGI Group brand
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link      https://github.com/symmetrics/trustedshops_buyerprotection/
 * @link      http://www.symmetrics.de/
 * @link      http://www.de.cgi.com/
 */

/**
 * SUPTRUSTEDSHOPS-122:
 * mysql4-upgrade-0.4.30-0.5.0 for removing superfluous system configurations since
 * the badge/widget is now generated via JS.
 */


/* @var $this Symmetrics_Buyerprotect_Model_Setup */
$adapter = $this->getConnection();
$select = new Varien_Db_Select($adapter);
$buyerprotectionDataPath = array(
    'buyerprotection/data/trustedshops_certificate_logo_code',
    'buyerprotection/data/ts_background_img',
    'buyerprotection/data/ts_logo_img',
);

$select->from($this->getTable('core_config_data'));
foreach ($buyerprotectionDataPath as $path) {
    $select->orWhere('path LIKE ?', $path);
}

$this->startSetup();

$sql = $select->deleteFromSelect($this->getTable('core_config_data'));
$adapter->query($sql);

$this->endSetup();
