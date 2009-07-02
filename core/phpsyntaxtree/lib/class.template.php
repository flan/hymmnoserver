<?php

// CTemplate - Simple templating engine which can be used to build 
//   web pages and  other text documents based on templates.
// Copyright (c) 2003-2004 Andre Eisenbach <andre@ironcreek.net>
// 
// This program is free software; you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation; either version 2 of the License, or
// (at your option) any later version.
// 
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
// 
// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
//
// $Id: class.template.php,v 1.2 2005/01/06 00:53:51 int2str Exp $

// Example:
//   < ?php // Remove space between "< ?"
//      include( "class.template.php" );
//
//      $page = new CTemplae( "mypage.html" );
//      $page->SetValues( "GREET", "World" );
//      $page->Render();
//   ? > // Remove space between "? >"
//
// Sample template (mypage.html):
//   <html>
//   <body>
//      Hello {GREET}!
//   </body>
//   </html>

class CTemplate
{
    // --------------------------------------------------------------------
    // PUBLIC functions
    // --------------------------------------------------------------------

    // Constructor - set the template to use.
    function CTemplate( $tpl_file = "", $debug = FALSE )
    {
        $this->_values      = array();
        $this->_blockdata   = array();
        $this->_debug       = $debug;

        if ( "" != $tpl_file )
        {
            $this->SetTemplate( $tpl_file );
        }
    }

    // Set the template and load the file from disc.
    function SetTemplate( $tpl_file )
    {
        if ( !file_exists( $tpl_file ) )
        {
            trigger_error( "Template file ($tpl_file) not found.",
                           E_USER_ERROR );
            return;
        }

        $this->_tpl_file = $tpl_file;

        // Load the whole template...
        $this->_template = $this->_getFile( $this->_tpl_file );

        // Parse blocks
        $this->_parseBlocks(); 
    }

    // Assign values to template placeholders
    function SetMacros( $macros )
    {
        foreach( $macros as $key => $value )
        {
            $this->_template =
                str_replace( '{' . $key . '}', $value,
                             $this->_template );
        }
    }

    // You can either simply pass an array with
    // multiple values, or a single value.
    function SetValues( $parameters, $value = "" )
    {
        if ( gettype( $parameters ) == "array" )
        {
            $this->_values = array_merge( $this->_values, $parameters );
        }
        else
        {
            $this->_values[$parameters] = $value;
        }
    }

    // Enable PHP parsing for this template
    function EnablePHP( $enable = TRUE )
    {
        $this->_parse_php = $enable;
    }

    // Add a template block with values
    function AddBlock( $block, $values )
    {
        if ( !isset( $this->_blocks[ $block ] ))
            return;

        $content = $this->_blocks[ $block ];;

        foreach( $values as $token => $value )
        {
            $content = str_replace( '{'.$token.'}', $value, $content );
        }

        $this->_blockdata[ $block ] .= $content;
    }

    // Parse the template and substitute placeholders.
    function Parse()
    {
        $content = $this->_template;

		// Mask {{ and }} for later substitution with { and }
		$content = str_replace( "{{", "_<<<_", $content );
		$content = str_replace( "}}", "_>>>_", $content );

		// Parse includes
        $search   = "#{INCLUDE}(.*){/INCLUDE}#isU";
        preg_match_all( $search, $content, $matches, PREG_SET_ORDER );

        foreach( $matches as $match )
        {
            $incfile = dirname( $this->_tpl_file ) . DIRECTORY_SEPARATOR . $match[1];

            $t = new CTemplate( $incfile );
            $t->SetValues( $this->_values );

            $search   = sprintf( "#{INCLUDE}%s\{/INCLUDE}#isU", $match[1] );
            $replace  = str_replace( "\$", "\\\$", $t->Parse() );

            $content = preg_replace( $search, $replace, $content );
        }

        // Replace single fields
        foreach( $this->_values as $token => $value )
        {
            $content = str_replace( '{'.$token.'}', $value, $content );
        }

        // Replace template blocks
        foreach( $this->_blockdata as $token => $value )
        {
            $content = str_replace( '{BLOCK_'.$token.'}', $value, $content );
        }

        // Parse PHP
        if ( $this->_parse_php )
        {
            $content = $this->_parsePHP( $content );
        }

        // Strip empty template placeholders
        if ( !$this->_debug )
        {
            $content = preg_replace( "/{.*}/U", "", $content );
        }

		// Now convert the {{ and }} replacements back to { and }
		$content = str_replace( "_<<<_", "{", $content );
		$content = str_replace( "_>>>_", "}", $content );

        // Return content
        $this->_content = $content;

        return $this->_content;
    }

    // Render the parsed template (print).
    function Render()
    {
        if ( empty( $this->_content ) )
            $this->Parse();

        print( $this->_content );
    }

    // --------------------------------------------------------------------
    // PRIVATE functions
    // --------------------------------------------------------------------

    // The prefix to put before the image in the target HREF anchor.
    var $_tpl_file = "";

    // The template with placeholders
    var $_template = "";

    // The parsed page content
    var $_content = "";

    // The values arrary
    var $_values;

    // Template blocks
    var $_blocks;

    // Parsed template blocks
    var $_blockdata;

    // Parse PHP?
    var $_parse_php = FALSE;

    // Debug - if set, empty placeholders stay...
    var $_debug = FALSE;

    // Read file contents
    function _getFile( $file )
    {
        if ( function_exists( "file_get_contents" ) )
        {
            return file_get_contents( $file );
        }
        else
        {
            return implode( '', file( $file ) );
        }

        return "";
    }

    // Determine all template blocks
    function _parseBlocks()
    {
        $search   = "#{BLOCK (.*)}(.*){\/BLOCK}#isU";
        $replace  = "{BLOCK_\\1}";

        preg_match_all( $search, $this->_template, $matches, PREG_SET_ORDER );
        $this->_template = preg_replace( $search, $replace, $this->_template );

        foreach( $matches as $match )
        {
           $this->_blocks[ trim( $match[1] ) ] = ltrim( $match[2] );
           $this->_blockdata[ trim( $match[1] ) ] = "";
        }
    }

    // Parse PHP
    function _parsePHP( $content )
    {
        $search  = "#\{PHP\}(.*)\{\/PHP\}#sU";
        preg_match_all( $search, $content, $matches, PREG_SET_ORDER );

        foreach( $matches as $match )
        {
            $search   = sprintf( "{PHP}%s{/PHP}", $match[1] );
            $replace  = eval( $match[1] );

            $content = str_replace( $search, $replace, $content );
        }

        return $content;
    }
}

?>
