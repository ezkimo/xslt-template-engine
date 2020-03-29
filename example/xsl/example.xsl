<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns="http://www.w3.org/1999/xhtml" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:php="http://php.net/xsl" exclude-result-prefixes="php">
	<xsl:output method="html" encoding="utf-8" indent="yes" />
	<xsl:include href="page.xsl" />
	<xsl:template match="/cars">
		<header>
			<h1>MM Newmedia XSLT Template Engine</h1>
		</header>
		<main>
			<xsl:for-each select="car">
				<xsl:element name="h2">
					<xsl:value-of select="name" />
				</xsl:element>
				<p>
					<strong>Driver: </strong>
					<xsl:value-of select="driver/name" />
				</p>
				<p>
					<strong>Passengers: </strong>
					<xsl:for-each select="passenger">
						<xsl:value-of select="name" />
						<xsl:if test="position() != last()">
							<xsl:text>, </xsl:text>
						</xsl:if>
					</xsl:for-each>
				</p>
			</xsl:for-each>
		</main>
	</xsl:template>
</xsl:stylesheet>