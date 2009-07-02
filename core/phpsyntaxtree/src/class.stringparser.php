<?php

// CStringParser - Parse a phrase into leafs and nodes and strore
//    the result in an element list (see CElementList)
// Copyright (c) 2003-2004 Andre Eisenbach <andre@ironcreek.net>
//
// CStringParser is part of phpSyntaxTree.
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
// $Id: class.stringparser.php,v 1.3 2005/11/15 17:51:50 int2str Exp $

require_once( "src/class.elementlist.php" );
require_once( "src/class.element.php" );

function escape_high_ascii( $s )
{
    $html = '';

    for( $i = 0; $i < strlen( $s ); ++$i )
    {
        $c = $s[$i];
        if ( ord( $c ) < 127 )
            $html .= $c;
        else
            $html .= sprintf( '&#%d;', ord( $c ) );
    }

    return $html;
}

class CStringParser
{
    // ----------------------------------------------------------------------
    // PUBLIC FUNCTIONS
    // ----------------------------------------------------------------------

    function CStringParser( $s )
    {
        // Clean up the data a little to make processing easier
        
        $s = str_replace( "\t", "", $s );
        $s = str_replace( "  ", " ", $s );
        $s = str_replace( "] [", "][", $s );
        $s = str_replace( " [", "[", $s );

        $s = escape_high_ascii( $s );

        // Store it for later...
        
        $this->data = $s;

        // Initialize internal element list 
        
        $this->elist = new CElementList();
    }

    function Validate()
    {
        if( strlen( $this->data ) < 1 )
          return FALSE;

        // TODO: Currently the only real validation is that the brackets match up. There's room for improvement here.
        
        $open = 0;

        for( $i=0; $i<strlen( $this->data ); $i++ )
        {
            switch( $this->data[$i] )
            {
                case "[": $open++; break;
                case "]": $open--; break;
                default: break;
            }
        }

        return( $open==0 );
    }

    function Parse()
    {
        $this->makeTree( 0 );
    }

    function GetElementList()
    {
        return $this->elist;
    }

    function AutoSubscript()
    {
        $elements = $this->elist->GetElements();
        $tmpcnt   = array();
        
        foreach( $elements as $element )
        {
            if ( $element->type == ETYPE_NODE )
            {
                $count = 1;
                $content = $element->content;

                if( isset( $this->tncnt[ $content ] ))
                    $count = $this->tncnt[ $content ];

                if ( $count > 1 )
                {
                    if ( isset( $tmpcnt[ $content ] ) )
                        $tmpcnt[ $content ]++;
                    else
                        $tmpcnt[ $content ] = 1;

                    $element->content .= "_" . $tmpcnt[ $content ];
                }
                $this->elist->SetID( $element->id, $element );
            }
        }

        return $this->tncnt;
    }
 
    // ----------------------------------------------------------------------
    // PRIVATE FUNCTIONS
    // ----------------------------------------------------------------------

    // Element list pointer
    var $elist;

    // The input sentence
    var $data = "";

    // Position in the sentence
    var $pos = 0;

    // ID for the next element
    var $id = 1;

    // Level in the diagram
    var $level = 0;

    // Node type counts
    var $tncnt;

    function countNode( $name )
    {
        $name = trim( $name );

        if ( isset( $this->tncnt[ $name ] ) )
            $this->tncnt[ $name ] += 1;
        else
            $this->tncnt[ $name ] = 1;
    }

    function getNextToken()
    {
        $gottoken = FALSE;
        $token = "";
        $i = 0;

        if ( ($this->pos + 1) >= strlen( $this->data ) )
            return "";

        while( ($this->pos + $i) < strlen( $this->data ) && !$gottoken )
        {
            $ch = $this->data[$this->pos + $i];

            switch( $ch )
            {
            case "[":
                if( $i > 0 )
                    $gottoken = TRUE;
                else
                    $token .= $ch;
                break;

            case "]":
                if( $i == 0 )
                    $token .= $ch;
                $gottoken = TRUE;
                break;

            case "\n":
            case "\r":
                break;

            default:
                $token .= $ch;
                break;
            }

            $i++;
        }

        if( $i > 1 )
            $this->pos += $i - 1;
        else
            $this->pos++;

        return $token;
    }

    function makeTree( $parent )
    {
        $token = trim( $this->getNextToken() );

        while( $token != "" && $token != "]" )
        {
            switch( $token[0] )
            {
            case "[":
                $token      = substr( $token, 1, strlen( $token ) - 1 );
                $spaceat    = strpos( $token, " " );

                $newparent  = -1;

                if( $spaceat != FALSE )
                {
                    $parts[0] = substr( $token, 0, $spaceat );
                    $parts[1] = substr( $token, $spaceat, strlen( $token ) - $spaceat );

                    $e = new CElement( $this->id++, $parent, $parts[0], $this->level );
                    $this->elist->Add( $e );
                    $newparent = $e->id;
                    $this->countNode( $parts[0] );

                    $e = new CElement( $this->id++, $this->id - 2, $parts[1], $this->level + 1 );
                    $this->elist->Add( $e );
                } else {
                    $e = new CElement( $this->id++, $parent, $token, $this->level );
                    $newparent = $e->id;
                    $this->elist->Add( $e );
                    $this->countNode( $token );
                }

                $this->level++;
                $this->makeTree( $newparent );
                break;

            default:
                if ( trim( $token ) > "" )
                {
                    $e = new CElement( $this->id++, $parent, $token, $this->level );
                    $this->elist->Add( $e );
                    $this->countNode( $token );
                }
                break;
            }

            $token = $this->getNextToken();
        }

        $this->level--;
    }
}

?>
