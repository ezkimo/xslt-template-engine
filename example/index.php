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