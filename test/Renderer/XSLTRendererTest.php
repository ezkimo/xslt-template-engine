<?php
declare(strict_types=1);
namespace MMNewmediaTest\View\Renderer;

use MMNewmedia\View\Renderer\XSLTRenderer;
use PHPUnit\Framework\TestCase;
use InvalidArgumentException;
use RuntimeException;
use SplFileObject;

class XSLTRendererTest extends TestCase
{   
    protected $renderer;
    
    protected function setUp(): void
    {
        $this->renderer = new XSLTRenderer();
    }
    
    public function testEngineIsIdentical(): void
    {
        $this->assertSame(get_class($this->renderer), XSLTRenderer::class);
    }
    
    public function testTemplateIsFile(): void
    {   
        $template = new SplFileObject('../../example/xsl/example.xsl');
        
        $this->assertInstanceOf(
            XSLTRenderer::class, 
            $this->renderer->setTemplate($template)
        );
        $this->renderer->setTemplate($template);
    }
    
    public function TemplateHasValidExtension(): void
    {
        $template = new SplFileObject('../../example/xsl/example.xsl');
        
        $this->assertInstanceOf(
            XSLTRenderer::class,
            $this->renderer->setTemplate($template)
        );
        $this->renderer->setTemplate($template);
    }
    
    public function testTemplateHasWrongExtension(): void
    {
        $this->expectException(InvalidArgumentException::class);
        
        $template = new SplFileObject('../../example/xml/car.xml');
        $this->renderer->setTemplate($template);
    }
    
    public function testTemplateIsReadable(): void
    {
        $template = new SplFileObject('../../example/xsl/example.xsl');
        
        $this->assertInstanceOf(
            XSLTRenderer::class, 
            $this->renderer->setTemplate($template)
        );
    }
}