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
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Magento
 * @package     Magento_Cron
 * @copyright   Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace Magento\Cron\Model\Config\Reader;

/**
 * Reader for cron parameters from data base storage
 */
class Db
{
    /**
     * Converter instance
     *
     * @var \Magento\Cron\Model\Config\Converter\Db
     */
    protected $_converter;

    /**
     * @var \Magento\App\Config\Scope\ReaderInterface
     */
    protected $_reader;

    /**
     * Initialize parameters
     *
     * @param \Magento\App\Config\Scope\ReaderInterface $defaultReader
     * @param \Magento\Cron\Model\Config\Converter\Db $converter
     */
    public function __construct(
        \Magento\App\Config\Scope\ReaderInterface $defaultReader,
        \Magento\Cron\Model\Config\Converter\Db $converter
    ) {
        $this->_reader = $defaultReader;
        $this->_converter = $converter;
    }

    /**
     * Return converted data
     *
     * @return array
     */
    public function get()
    {
        return $this->_converter->convert($this->_reader->read());
    }
}