<?php

// CElementList - List of unordered tree elements with defined parent
//     relationships and indentation levels.
// Copyright (c) 2003-2004 Andre Eisenbach <andre@ironcreek.net>
//
// CElementList is part of phpSyntaxTree.
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
// $Id: class.elementlist.php,v 1.1.1.1 2005/01/05 17:49:14 int2str Exp $

require_once( "src/class.element.php" );

class CElementList
{
    // +--------------------------------------------------------------------
    // | PUBLIC functions
    // +--------------------------------------------------------------------
    
    function Add( $e )
    {
        $this->_elements[] = $e;

        if ( $e->parent != 0 )
        {
            $p = $this->GetID( $e->parent );
            $p->type = ETYPE_NODE;
            $this->SetID( $p->id, $p );
        }
    }

    function GetFirst()
    {
        if ( count( $this->_elements ) == 0 )
            return NULL;

        $this->_iterator = 0;

        return ( $this->_elements[ $this->_iterator ] );
    }

    function GetNext()
    {
        ++$this->_iterator;

        if ( !isset( $this->_elements[ $this->_iterator ]  ))
            return NULL;

        return ( $this->_elements[ $this->_iterator ] );
    }

    function GetID( $id )
    {
        for( $i=0; $i<count( $this->_elements ); $i++ )
        {
            if ( $this->_elements[ $i ]->id == $id )
                return $this->_elements[ $i ];
        }

        return FALSE;
    }

    function SetID( $id, $e )
    {
        for( $i=0; $i<count( $this->_elements ); $i++ )
        {
            if ( $this->_elements[ $i ]->id == $id )
            {
                $this->_elements[ $i ] = $e;
                break;
            }
        }
    }

    function GetElements()
    {
        return $this->_elements;
    }

    function GetChildCount( $id )
    {
        return count( $this->GetChildren( $i ) );
    }

    function GetChildren( $id )
    {
        $children = array();

        for( $i=0; $i<count( $this->_elements ); $i++ )
        {
            if ( $this->_elements[$i]->parent == $id )
            {
                $children[] = $this->_elements[$i]->id;
            }
        }

        return $children;
    }

    function GetElementWidth( $id )
    {
        $e = $this->GetID( $id );
        if ( $e != FALSE )
            return $e->width;

        return -1;
    }

    function SetElementWidth( $id, $width )
    {
        $e = $this->GetID( $id );
        if ( $e != FALSE )
        {
            $e->width = $width;
            $this->SetID( $id, $e );
        }
    }

    function GetIndent( $id )
    {
        $e = $this->GetID( $id );
        if ( $e != FALSE )
            return $e->indent;

        return -1;
    }

    function SetIndent( $id, $indent )
    {
        $e = $this->GetID( $id );
        if ( $e != FALSE )
        {
            $e->indent = $indent;
            $this->SetID( $id, $e );
        }
    }

    function GetLevelHeight()
    {
        $maxlevel = 0;
        for( $i=0; $i<count( $this->_elements ); $i++ )
        {
            $level = $this->_elements[ $i ]->level;
            if ( $level > $maxlevel )
                $maxlevel = $level;
        }

        return $maxlevel+1;
    }

    // +--------------------------------------------------------------------
    // | PRIVATE functions
    // +--------------------------------------------------------------------
    
    // The element array
    var $_elements;

    // Iterator index (used for GetFirst() / GetNext() )
    var $_iterator = -1;
}

?>
