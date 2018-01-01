<?php
namespace Siyu\QuickView\Plugin;

use Magento\Store\Model\ScopeInterface;

class ProductListPlugin
{
    /**
     * Configuration path from Magento backend
     */
    const CONFIG_PATH_QUICKVIEW_ENABLED = 'siyu_quickview/general/active';
    const CONFIG_PATH_QUICKVIEW_TEXT = 'siyu_quickview/general/buttontext';
    const CONFIG_PATH_QUICKVIEW_CLASSNAME = 'siyu_quickview/general/classname';

    /**
     * @var \Magento\Framework\UrlInterface
     */
    protected $urlInterface;

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var \Magento\Framework\View\Element\BlockFactory
     */
    protected $blockFactory;

    /**
     * @param \Magento\Framework\UrlInterface $urlInterface
     * @param Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        \Magento\Framework\UrlInterface $urlInterface,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Framework\View\Element\BlockFactory $blockFactory
    )
    {
        $this->urlInterface = $urlInterface;
        $this->scopeConfig = $scopeConfig;
        $this->blockFactory = $blockFactory;
    }

    /**
     * aroundGetProductDetailsHtml
     *
     * replace the url generated by Magento core function
     * @param  \Magento\Catalog\Block\Product\ListProduct $subject
     * @param  \Closure                                   $proceed
     * @param  \Magento\Catalog\Model\Product             $product
     * @return string $result
     */
    public function aroundGetProductDetailsHtml(
        \Magento\Catalog\Block\Product\ListProduct $subject,
        \Closure $proceed,
        \Magento\Catalog\Model\Product $product
    )
    {
        $result = $proceed($product);
        $active = $this->scopeConfig->getValue(self::CONFIG_PATH_QUICKVIEW_ENABLED, ScopeInterface::SCOPE_STORE);
        if ($active) {
            $buttonText = $this->scopeConfig->getValue(self::CONFIG_PATH_QUICKVIEW_TEXT, ScopeInterface::SCOPE_STORE);
            $quickviewUrl = $this->urlInterface->getUrl(
                'quickview/catalog_product/view',
                array('id' => $product->getId())
            );
            $buttonClasses = $this->scopeConfig->getValue(self::CONFIG_PATH_QUICKVIEW_CLASSNAME, ScopeInterface::SCOPE_STORE);

            // Support multiple class name for button
            if (strpos($buttonClasses, ',')) {
                $buttonClasses = str_replace(',', ' ', $buttonClasses);
            }

            $result = $this->blockFactory->createBlock('\Siyu\QuickView\Block\Anchor')
                               ->setTemplate('Siyu_QuickView::anchor.phtml')
                               ->setButtonText($buttonText)
                               ->setQuickViewUrl($quickviewUrl)
                               ->setButtonClasses($buttonClasses)
                               ->toHtml();
        }
        return $result;
    }
}