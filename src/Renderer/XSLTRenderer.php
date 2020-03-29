<?php
declare(strict_types=1);
namespace MMNewmedia\View\Renderer;

use MMNewmedia\View\Exception\ExtensionNotLoadedException;
use DOMDocument;
use InvalidArgumentException;
use SplFileObject;
use XSLTProcessor;

/**
 * XSLT view renderer
 * 
 * @author Marcel Maa� <info@mm-newmedia.de>
 * @copyright 2020 MM Newmedia <https://www.mm-newmedia.de>
 * @package de.mmnewmedia.xslt-renderer
 * @subpackage view.renderer
 * @since 2020-03-28
 * @version
 */
class XSLTRenderer implements RendererInterface
{
    /**
     * DOMDocument representation of the XML daten that should be processed in the XSL template
     * @var null|DOMDocument
     */
    protected $data;
    
    /**
     * XSL template file
     * @var null|SplFileObject
     */
    protected $template;
    
    /**
     * Constructor
     *
     * @param SplFileObject $template   the xsl template that should be used
     * @param DOMDocument   $data       the xml data that is assigned to this renderer
     */
    public function __construct(SplFileObject $template = null, DOMDocument $data = null)
    {
        if (!extension_loaded('xsl')) {
            throw new ExtensionNotLoadedException('The XSL extension is not enabled!', 50000);
        }
        
        if ($this->template !== null) {
            $this->setTemplate($template);
        }
        
        if ($this->data !== null) {
            $this->setData($data);
        }
    }
    
    /**
     * Returns the DOMDocument representation of the XML data that should be processed in the template
     * 
     * @return DOMDocument|null
     */
    public function getData(): ?DOMDocument
    {
        return $this->data;
    }
    
    /**
     * Sets the DOMDocument representation of the XML data that should be processed in the template
     * 
     * @param DOMDocument $data
     * @return self
     */
    public function setData(DOMDocument $data): RendererInterface
    {
        $this->data = $data;
        return $this;
    }
    
    /**
     * Returns the XSL template file
     * 
     * @return SplFileObject|null
     */
    public function getTemplate(): ?SplFileObject
    {
        return $this->template;
    }
    
    /**
     * Sets the XSL template file
     * Performs several checks on the given file
     *
     * @param SplFileObject $template
     * @throws InvalidArgumentException
     * @return self
     */
    public function setTemplate(SplFileObject $template): RendererInterface
    {
        if ($template->getType() !== 'file') {
            throw new InvalidArgumentException(sprintf(
                'The given template parameter must be a file. %s given.',
                ucfirst($template->getType())
            ), 50100);
        }
        
        if ($template->getExtension() !== 'xsl') {
            throw new InvalidArgumentException(sprintf(
                'The given XSL template muste be a XSL file. %s given.',
                $template->getExtension()
            ), 50200);
        }
        
        if ($template->isReadable() === false) {
            throw new InvalidArgumentException(sprintf(
                'The given XSL template file "%s" is not readable.',
                $template->getFilename()
            ), 50300);
        }
        
        $this->template = $template;
        return $this;
    }
    
    /**
     * @see \MMNewmedia\View\Renderer\RendererInterface::render()
     */
    public function render(SplFileObject $template = null, DOMDocument $data = null): string
    {
        if ($template !== null) {
            $this->setTemplate($template);
        }
        
        if ($data !== null) {
            $this->setData($data);
        }
        
        $processor = new XSLTProcessor();
        $processor->registerPHPFunctions();
        
        $stylesheet = new DOMDocument();
        $stylesheet->load($this->getTemplate()->getPathname());
        $processor->importStylesheet($stylesheet);
        
        return $processor->transformToXml($this->data);
    }
}