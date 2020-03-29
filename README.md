# xslt-template-engine
This is a simple PHP renderer class, which consumes XML data and renders XSL templates

## Installation

Run the following to install this library:

```bash
$ composer require ezkimo/xslt-template-engine
```

## Example

This example assumes a PSR-4 autoloader and shows how to use XML data with an XSL template. This example is also included in the example folder.

```php
<?php
declare(strict_types=1);
namespace MMNewmedia\Example;

use MMNewmedia\View\Renderer\XSLTRenderer;
use DOMDocument;
use Exception;
use SplFileObject;

// require PSR-4 Autoloading (assumes, that composer dump-autoload was executed before)
require '../vendor/autoload.php';

try {
    // load the example xml data
    $data = new DOMDocument();
    $data->load(__DIR__ . '/xml/car.xml');
    
    // load the xsl example template
    $template = new SplFileObject(__DIR__ . '/xsl/example.xsl');
    
    // initialise the xslt renderer
    $renderer = new XSLTRenderer();
    echo $renderer->render($template, $data);
    exit();
} catch (Exception $e) {
    var_dump($e);
}

```