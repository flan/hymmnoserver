<?php

// dnlgrapn.php - Generate a downloadable syntax tree
// Copyright (c) 2003-2005 Andre Eisenbach <andre@ironcreek.net>
//
// dnlgraph.php is part of phpSyntaxTree.
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
// $Id: dnlgraph.php,v 1.3 2005/08/25 19:07:18 int2str Exp $

require_once( "src/class.elementlist.php" );
require_once( "src/class.stringparser.php" );
require_once( "src/class.treegraph.php" );

// Start session to retrieve graph data
session_start();

// Read session data

if ( !isset( $_SESSION['data'] ) )
{
    printf( "Error: Couldn't retrieve session data." );
    exit;
}

$data = $_SESSION['data'];

$color     = isset( $_SESSION['color'] )     ? $_SESSION['color']     : 0;
$triangles = isset( $_SESSION['triangles'] ) ? $_SESSION['triangles'] : FALSE;
$antialias = isset( $_SESSION['antialias'] ) ? $_SESSION['antialias'] : 0;
$autosub   = isset( $_SESSION['autosub'] )   ? $_SESSION['autosub']   : 0;
$font      = isset( $_SESSION['font'] )      ? $_SESSION['font']      : 'Vera.ttf';
$fontsize  = isset( $_SESSION['fontsize'] )  ? $_SESSION['fontsize']  : 8;

// Validate the phrase and draw the tree

$sp = new CStringParser( $data );

if ($sp->Validate() )
{
    // If all is well, go ahead and draw the graph ...
    
    $sp->Parse();
    
    if ( $autosub )
        $sp->AutoSubscript();
    
    $elist = $sp->GetElementList();
    
    // Draw the graph into a file

    $tmpfile = tempnam( 'var/', 'stgraph' );
    
    $fontpath = dirname( $_SERVER['SCRIPT_FILENAME'] ) . '/ttf/';

    $graph = new CTreegraph( $elist
        , $color, $antialias, $triangles
        , $fontpath . $font, $fontsize );
    $graph->Save( $tmpfile );

    $size = filesize( $tmpfile );

    header( "Content-Type: application/octet-stream" );
    // header( "Content-Type: image/png" );
    header( "Content-Disposition: attachment; filename=syntax_tree.png" );
    header( sprintf( "Content-Length: %ld", $size ));

    readfile( $tmpfile ); 

    unlink( $tmpfile );
} else {
    printf( "Error: Phrase could not be parsed correctly." );
}

?>
