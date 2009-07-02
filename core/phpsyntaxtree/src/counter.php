<?php

// counter.php - Counter helper functions
// Copyright (c) 2003-2004 Andre Eisenbach <andre@ironcreek.net>
//
// counter.php is part of phpSyntaxTree.
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
// $Id: counter.php,v 1.2 2005/06/02 20:53:41 int2str Exp $

define( 'COUNTER_FILE', "var/counter.dat" );

function GetCounter()
{
    if ( file_exists( COUNTER_FILE ) )
        return intval( file_get_contents( COUNTER_FILE ));

    return 0;
}

function AddCounter()
{
    $cnt = GetCounter();
    $cnt++;
    
    $fh = @fopen( COUNTER_FILE, "w" );
    if ( $fh )
    {
        fwrite( $fh, $cnt );
        fclose( $fh );
    }
}

?>
