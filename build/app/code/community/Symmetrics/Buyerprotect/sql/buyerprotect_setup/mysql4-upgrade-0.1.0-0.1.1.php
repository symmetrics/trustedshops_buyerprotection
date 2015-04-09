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
 * @package   Symmetrics_Buyerprotect
 * @author    symmetrics - a CGI Group brand <info@symmetrics.de>
 * @author    Torsten Walluhn <tw@symmetrics.de>
 * @author    Ngoc Anh Doan <nd@symmetrics.de>
 * @copyright 2010-2014 symmetrics - a CGI Group brand
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link      https://github.com/symmetrics/trustedshops_buyerprotection/
 * @link      http://www.symmetrics.de/
 * @link      http://www.de.cgi.com/
 */

/* @var $this Symmetrics_Buyerprotect_Model_Setup */
$this->startSetup();

$templatePath = Symmetrics_Buyerprotect_Model_Setup::MIGRATION_TEMPLATE_PATH;
$templateSuffix = Symmetrics_Buyerprotect_Model_Setup::MIGRATION_TEMPLATE_SUFFIX;

$templateSubject = 'SOAP Übermittlungsfehler -- Kunden-Id: {{var tsSoapData.getTsId()}} -- '
                 . 'Bestellungs-Id: {{var tsSoapData.getShopOrderId()}}';

$emailTemplates = array(
    'ts_buyerprotect_error_email_de-DE' => array(
        'template_code' => 'Trusted Shops Käuferschutz SOAP Fehler DE',
        'template_subject' => $templateSubject
    )
);

foreach ($emailTemplates as $fileName => $template) {
    $fullFileName = Mage::getBaseDir() . $templatePath . $fileName . $templateSuffix;
    $content = file_get_contents($fullFileName);
    $template['template_text'] = $content;

    $this->createEmailTemplate($template['template_code'], $template);
}

$this->endSetup();
