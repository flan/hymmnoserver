<?php

// imgutils.php - Image utility functions
// Copyright (c) 2003-2004 Andre Eisenbach <andre@ironcreek.net>
//
// imgutils.php is part of phpSyntaxTree.
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
// $Id: imgutils.php,v 1.1.1.1 2005/01/05 17:49:14 int2str Exp $

function ImgGetTxtWidth( $text, $font, $font_size )
{
    $bbox  = imagettfbbox( $font_size, 0, $font, $text );
    $width = 
        ( ($bbox[0] > 0 && $bbox[2] > 0) || ($bbox[0] < 0 && $bbox[2] < 0) ) 
            ? abs( $bbox[2] - $bbox[0] ) 
            : ( abs( $bbox[2] ) + abs( $bbox[0] ) + 1 );

    return $width;
}

?>
