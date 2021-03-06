# Magento 2 Quick View Extension

## Introduction
Allows your site's visitor to quickly view product details and add products to cart right from the popup window on a category page. Enhance user experience by reducing the complexity of 'add to cart' progress.


There are some of the **QuickView extensions** out there already **why build this**? 

1. I am a Magento developer but in most of my time is working with the Magento 1.9.X version. So first reason is to grow my experiences in Magento 2 development.

2. The extensions as I found online they usually built the extension for building brand image. So there will advertisements and they might not that care the customers who do not pay them.

3. Having an own version so easier to maintain and extend.

## Installation
``` bash
composer require siyu/magento-2-core-block-patch:dev-master
composer require siyu/magento-2-quickview:dev-master
./bin/magento module:enable Siyu_BlockPatch Siyu_QuickView 
./bin/magento setup:upgrade
./bin/magento setup:di:compile
```

## Uninstall
``` bash
./bin/magento module:disable Siyu_BlockPatch Siyu_QuickView --clear-static-content
composer remove siyu/magento-2-quickview
composer remove siyu/magento-2-core-block-patch
./bin/magento setup:di:compile
```

## Todo List
1. Support different product types
2. Add loading animation before popup comes up
3. Allow to add cross-sell & related products slider in QuickView popup
4. Allow settings of different sizes of QuickView popup window
5. Ajax-add-to-cart support
6. Use 'scss/less' as extension css source & remove duplicate icon-search class
7. Add options in backend for various custom needs

## CHANGELOG

### v1.0.4
Notes:
1. Code tidyup
2. Allow to hide sku from backend setting
3. Add BlockPatch dependency to allow ifconfig in remove handler

Released on 2018-01-20

### v1.0.3
Notes:
1. Fix swatches not displaying in the quickview popup window issue

Released on 2018-01-17

### v1.0.2
Notes:
1. Remove tingle js library
2. Using Magento Modal Widget instead
3. Use iframe in quickview popup

Released on 2018-01-16

### v1.0.1
Notes:
1. Improve **QuickView** button style
2. Added search icon

Released on 2018-01-14

### v1.0.0
Notes:
1. Allow users to install the extension by **Composer**
2. Documentation update: installation & uninstall guide

Released on 2018-01-14