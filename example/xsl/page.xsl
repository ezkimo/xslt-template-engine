<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns="http://www.w3.org/1999/xhtml" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:php="http://php.net/xsl">
	<xsl:output method="html" encoding="utf-8" indent="yes" />
	
	<xsl:template match="/">
		<xsl:text disable-output-escaping="yes">&lt;!DOCTYPE html&gt;</xsl:text>
    	<html lang="de">
    		<head>
				<title>Das MM Newmedia Auto mit XSLT</title>
				<style>
				*, html {
					margin: 0;
					padding: 0;
				}
				body {
					font-family: Verdana;
					font-size: 100%;
				}
				h1 {
					font-size: 2.5rem;
					margin-bottom: 1rem;
				}
				h2 {
					font-style: italic;
					margin-bottom: 1rem;
				}
				h2:not(:first-child) {
					margin: 1rem 0;
				}
				</style>
			</head>
			<body>
				<xsl:apply-templates />
			</body>
    	</html>
	</xsl:template>
</xsl:stylesheet>