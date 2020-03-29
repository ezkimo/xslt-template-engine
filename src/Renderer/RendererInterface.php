<?php
declare(strict_types=1);
namespace MMNewmedia\View\Renderer;

use DOMDocument;
use SplFileObject;

/**
 * Interface for render classes
 *
 * @author Marcel Maa� <info@mm-newmedia.de>
 * @copyright 2020 MM Newmedia <https://www.mm-newmedia.de>
 * @package de.mmnewmedia.xslt-renderer
 * @subpackage view.renderer
 * @since 2020-03-28
 * @version
 */
interface RendererInterface
{
    /**
     * Returns the DOMDocument representation of the XML data that should be processed in the template
     * 
     * @return DOMDocument|null
     */
    public function getData(): ?DOMDocument;
    
    /**
     * Sets the DOMDocument representation of the XML data that should be processed in the template
     * 
     * @param DOMDocument $data
     * @return self
     */
    public function setData(DOMDocument $data): self;
    
    /**
     * returns the template file
     * 
     * @return SplFileObject|NULL
     */
    public function getTemplate(): ?SplFileObject;
    
    /**
     * sets the template file
     * 
     * @param SplFileObject $template
     * @return self
     */
    public function setTemplate(SplFileObject $template): self;
    
    /**
     * renders the given template representation and returns the rendered string
     * 
     * @param SplFileObject $template
     * @param DOMDocument $data
     * @return string
     */
    public function render(SplFileObject $template, DOMDocument $data): string;
}