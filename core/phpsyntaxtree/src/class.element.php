<?php

// CElement - Basic tree element class
// Copyright (c) 2003-2004 Andre Eisenbach <andre@ironcreek.net>
//
// CElement is part of phpSyntaxTree.
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
// $Id: class.element.php,v 1.1.1.1 2005/01/05 17:49:14 int2str Exp $

// Note: All variables are 'public' access

define( 'ETYPE_UNDEFINED', 0 );
define( 'ETYPE_NODE', 1 );
define( 'ETYPE_LEAF', 2 );

class CElement
{
    // Unique element id
    var $id         = 0;
    
    // Parent element id
    var $parent     = 0;
    
    // Element type
    var $type       = ETYPE_UNDEFINED;
    
    // The actual element content
    var $content;
    
    // Element level in the tree (0=top etc...)
    var $level      = 0;

    // Width of the element in pixels
    var $width      = 0;

    // Drawing offset
    var $indent     = 0;

    // Constructor
    function CElement( $id = 0, $parent = 0, $content = NULL, $level = 0, $type = ETYPE_LEAF )
    {
        $this->id       = $id;
        $this->parent   = $parent;
        $this->type     = $type;
        $this->content  = trim( $content );
        $this->level    = $level;
        $this->width    = 0;
        $this->indent   = 0;
    }

    // Debug helper function
    function Dump()
    {
        printf( "ID      : %d\n", $this->id );
        printf( "Parent  : %d\n", $this->parent );
        printf( "Level   : %d\n", $this->level );
        printf( "Type    : %d\n", $this->type );
        printf( "Width   : %d\n", $this->width );
        printf( "Indent  : %d\n", $this->indent );
        printf( "Content : %s\n\n", $this->content );
    }
}

?>
