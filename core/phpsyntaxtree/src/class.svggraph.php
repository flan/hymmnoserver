<?php

// CSVGGraph - Parse an element list into a graphical tree.
// Copyright (c) 2003-2004 Andre Eisenbach <andre@ironcreek.net>
//
// CSVGGraph is part of phpSyntaxTree.
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
// $Id: class.svggraph.php,v 1.3 2006/07/21 22:27:11 int2str Exp $

require_once( "src/smoothline.php" );
require_once( "src/imgutils.php" );
require_once( "src/class.elementlist.php" );

define( 'E_WIDTH',  60 );   // Element width
define( 'E_PADD',    5 );   // Element height padding
define( 'V_SPACE',  10 );
define( 'H_SPACE',  10 );
define( 'B_SIDE',    5 );
define( 'B_TOPBOT',  5 );

class CSVGGraph
{
    // ----------------------------------------------------------------------
    // PUBLIC FUNCTIONS
    // ----------------------------------------------------------------------
    
    // Constructor
    function CSVGGraph( 
         &$e_list_ref
        , $color=TRUE, $antialias=TRUE, $triangles=TRUE
        , $font="Vera.ttf", $fontsize=10 )
    {
        // Store parameters
        
        $this->e_list    = $e_list_ref;
        $this->font      = $font;
        $this->font_size = $fontsize;
        $this->antialias = $antialias;
        $this->triangles = $triangles;
        
        // Calculate image dimensions
        
        $this->e_height = $this->font_size + E_PADD*2;
        $h = $e_list_ref->GetLevelHeight();

        $e = $e_list_ref->GetFirst();
        $this->CalcElementWidth( $e );

        $w_px = $this->e_list->GetElementWidth( $e->id ) + B_SIDE * 2;
        $h_px = $h * $this->e_height + ($h-1) * (V_SPACE + $fontsize) + B_TOPBOT * 2;;

        $this->height    = $h_px;
        $this->width     = $w_px;

    }

    function Draw()
    {
        $this->svgHeader();
        $this->parseList();
        $this->svgFooter();

        print( $this->xml );
    }

    // ----------------------------------------------------------------------
    // PRIVATE FUNCTIONS
    // ----------------------------------------------------------------------
    
    // Image dimensions
    var $height   = 0;
    var $width    = 0;

    // Element dimensions
    var $e_width  = E_WIDTH;
    var $e_height = 50;
    
    // Element list
    var $e_list;

    // Font settings
    var $font       = "Vera.ttf";
    var $font_size  = 10;
    
    // Options
    var $antialias  = TRUE;
    var $triangles  = TRUE;
    var $color      = TRUE;

    // XML output
    var $xml        = "";

    // Add the element into the tree (draw it)
    function drawElement( $x, $y, $w, $string, $type )
    {
        // Calculate element dimensions and position
        
        $top    = $this->row2Px( $y );
        $left   = $x + B_SIDE;
        $bottom = $top  + $this->e_height;
        $right  = $left + $w;

        // Draw element frame (for debugging)

        if ( isset( $_GET['frame'] ) )
        {
            $style = "style=\"fill:rgb(255,255,255); stroke-width: 1; stroke:rgb(0,0,0);\"";
            $this->xml .= sprintf( "<rect %s x=\"%d\" y=\"%d\" width=\"%d\" height=\"%d\" />\n",
                $style, $left, $top, $right-$left, $bottom-$top );
        }

        // Select apropriate color
        
        if ( $this->color )
        {
            $col = "blue";
            if ( ETYPE_LEAF == $type )
                $col = "red";

            if ( substr( $string, 0, 1 ) == "<"
                && substr( $string, strlen( $string ) - 1, 1 ) == ">" )
                    $col = "green";
        } else {
            $col = "black";
        }

        // Split the string into the main part and the 
        //   subscript part of the element (if any)
        
        $main   = $string;
        $sub    = "";

        $parts = split( "_", $string, 2 );
        if ( count( $parts ) > 1 )
        {
            $main = $parts[0];
            $sub  = str_replace( "_", " ", $parts[1] );
        } 
        
        // Calculate text size for the main and the 
        //   subscript part of the element
        
        $main_width = ImgGetTxtWidth( $main, $this->font, $this->font_size/2 );
        $sub_width  = ImgGetTxtWidth( $sub,  $this->font, $this->font_size/2-2 );

        // Center text in the element

        $txt_width = $main_width + $sub_width;
        $txt_pos   = $left + ($right - $left) / 2 - $txt_width / 2;

        // Draw main text

        $style=sprintf( "style=\"fill: %s; font-size: %dpx;\"", $col, $this->font_size );

        $this->xml .= sprintf( "<text %s x=\"%d\" y=\"%d\">%s</text>\n",
            $style, $txt_pos, $top+($this->e_height-5), htmlentities( $main ) );
        
        // Draw subscript text

        if ( strlen( $sub ) > 0 )
        {
            $style=sprintf( "style=\"fill: %s; font-size: %dpx;\"", $col, $this->font_size+2 );

            $this->xml .= sprintf( "<text %s x=\"%d\" y=\"%d\">%s</text>\n",
                $style, $txt_pos+$main_width+1, $top+($this->e_height-2), htmlentities( $sub ));
        }
    }

    // Draw a line between child/parent elements
    function linetoParent( $fromX, $fromY, $fromW, $toX, $toW )
    {
        if ( $fromY == 0 )
            return;

        $fromTop  = $this->row2Px( $fromY );
        $fromLeft = $fromX + $fromW / 2 + B_SIDE;

        $toBot    = $this->row2Px( $fromY-1 ) + $this->e_height;
        $toLeft   = $toX + $toW / 2 + B_SIDE;

        $style    = "style=\"stroke:rgb(0,0,0);stroke-width:1;\"";

        $this->xml .= sprintf( "<line %s x1=\"%d\" y1=\"%d\" x2=\"%d\" y2=\"%d\" />\n",
                $style, $fromLeft, $fromTop, $toLeft, $toBot );
    }

    // Draw a triangle between child/parent elements
    function triangletoParent( $fromX, $fromY, $fromW, $toW, $textW )
    {
        if ( $fromY == 0 )
            return;

        $toX = $fromX;
            
        $fromTop  = $this->row2Px( $fromY );
        $fromCenter = $fromX + $fromW / 2 + B_SIDE;
            
        $fromLeft1 = $fromCenter + $textW / 2 ;
        $fromLeft2 = $fromCenter - $textW / 2 ;
        
        $toBot    = $this->row2Px( $fromY-1 ) + $this->e_height;
        $toLeft   = $toX + $toW / 2 + B_SIDE;

        $style    = "style=\"fill: white; stroke: black; stroke-width: 1;\"";

        $this->xml .= sprintf( "<polygon %s points=\"%d %d %d %d %d %d\" />\n",
            $style, $fromLeft1, $fromTop, $toLeft, $toBot, $fromLeft2, $fromTop );
    }

    // If a node element text is wider than the sum of it's
    //   child elements, then the child elements need to
    //   be resized to even out the space. This function
    //   recurses down the a child tree and sizes the
    //   children appropriately.
    function fixChildSize( $id, $current, $target )
    {
        $e_list = &$this->e_list;
        $children = $e_list->GetChildren( $id );

        $e_list->SetElementWidth( $id, $target );

        if ( count( $children ) > 0 ) 
        {
            $delta = $target - $current;
            $target_delta = $delta / count( $children ); 

            foreach( $children as $child )
            {
                $child_width = $e_list->GetElementWidth( $child );
                $this->fixChildSize( $child, $child_width, $child_width + $target_delta );
            }
        }
    }

    // Calculate the width of the element. If the element is
    //   a node, the calculation will be performed recursively
    //   for all child elements.
    function calcElementWidth( &$e )
    {
        $w = 0;
        $e_list = &$this->e_list;
        
        $children = $e_list->GetChildren( $e->id );

        if ( count( $children ) == 0 )
        {
            $w = ImgGetTxtWidth( $e->content, $this->font, $this->font_size ) + E_PADD*2;
        } else {
            foreach( $children as $child )
            {
                $child_e = $e_list->GetID( $child );
                $w += $this->calcElementWidth( $child_e );
            }

            $tw = ImgGetTxtWidth( $e->content, $this->font, $this->font_size ) + E_PADD*2;
            if ( $tw > $w )
            {
                $this->fixChildSize( $e->id, $w, $tw );
                $w = $tw;
            }
        }

        $e_list->SetElementWidth( $e->id, $w );
        return $w;
    }

    // Parse the elements in the list top to bottom and
    //   draw the elements into the image.
    //   As we it iterate through the levels, the element
    //   indentation is calculated.
    function parseList()
    {
        $e_list = &$this->e_list;

        // Calc element list recursively.... 

        $e_arr = $e_list->GetElements();
        
        $h = $e_list->GetLevelHeight();

        for( $i=0; $i<$h; $i++ )
        {
            $x = 0;
            
            for( $j=0; $j<count( $e_arr ); $j++ )
            {
                if ( $e_arr[$j]->level == $i )
                {
                    $cw = $e_list->GetElementWidth( $e_arr[$j]->id );
                    $parent_indent = $e_list->GetIndent( $e_arr[$j]->parent );
                    
                    if ( $x <  $parent_indent )
                        $x = $parent_indent;
        
                    $e_list->SetIndent( $e_arr[$j]->id, $x );
        
                    $this->drawElement( $x, $i, $cw, $e_arr[$j]->content, $e_arr[$j]->type );
        
                    if ( $e_arr[$j]->parent != 0 )
                    {
                        // Draw a line to the parent element
                        // 
                        // If the parent element is on the same indentation
                        // level (i.e. the line would be straight), and the
                        // leaf contains more than one word, we draw a 
                        // triangle instead.
                        
                        $words = split( ' ', $e_arr[$j]->content );

                        if (   $this->triangles == TRUE
                            && ETYPE_LEAF       == $e_arr[ $j ]->type 
                            && $x               == $parent_indent 
                            && count( $words )  > 1 )
                        {
                            $txt_width = ImgGetTxtWidth( $e_arr[ $j ]->content, $this->font, $this->font_size );
                            $this->triangletoParent(
                                $x, $i, $cw, $e_list->GetElementWidth( $e_arr[$j]->parent ), $txt_width
                            );
                        } else {
                            $this->linetoParent( 
                                $x, $i, $cw
                                , $e_list->GetIndent( $e_arr[$j]->parent )
                                , $e_list->GetElementWidth( $e_arr[$j]->parent ) 
                            );
                        }
                    }
        
                    $x += $cw;
                }
            }
        }
    }
    
    // Calculate top position from row (level)
    function row2Px( $row )
    {
        return ( B_TOPBOT + $this->e_height*$row + (V_SPACE + $this->font_size) *$row );
    }

    // SVG header
    function svgHeader()
    {
        // TODO: Templates anyone?! ....

        $this->xml .= sprintf( "<?xml version=\"1.0\" standalone=\"no\"?>\n" );
        $this->xml .= sprintf( "<!DOCTYPE svg PUBLIC \"-//W3C//DTD SVG 1.1//EN\"\n" ); 
        $this->xml .= sprintf( "   \"http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd\">\n\n" );

        $this->xml .= sprintf( "<svg width=\"%d\" height=\"%d\" ", $this->width, $this->height );
        $this->xml .= "version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\">\n";
    }

    function svgFooter()
    {
        $this->xml .= sprintf( "</svg>\n" );
    }
};

?>
