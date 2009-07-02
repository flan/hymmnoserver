<?php

// log.php - Log helper functions
// Copyright (c) 2003-2004 Andre Eisenbach <andre@ironcreek.net>
//
// log.php is part of phpSyntaxTree.
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
// $Id: log.php,v 1.3 2005/08/22 23:35:48 int2str Exp $

define( 'LOG_PHRASE_FNAME', "var/phpst.log" );
define( 'LOG_LANG_FNAME', "var/lang.log" );

function LogPhrase( $phrase )
{
    $fh = @fopen( LOG_PHRASE_FNAME, "a" );

    if ( $fh )
    {
        $ip     = isset( $_SERVER['REMOTE_ADDR'] ) ? $_SERVER['REMOTE_ADDR'] : 'unknown';
        $date   = date( "Y-m-d H:i" );
        $phrase = trim( $phrase );
        $phrase = str_replace( "\n", "", $phrase );
        $phrase = str_replace( "\r", "", $phrase );

        $msg = sprintf( "%s %s - %s\n", $date, $ip, $phrase );

        fwrite( $fh, $msg );
        fclose( $fh );
    }
}

function LogLangSettings()
{
    $fh = @fopen( LOG_LANG_FNAME, "a" );

    if ( $fh )
    {
        $a_lang = isset( $_SERVER['HTTP_ACCEPT_LANGUAGE'] ) ? $_SERVER['HTTP_ACCEPT_LANGUAGE'] : 'unknown';
        $a_char = isset( $_SERVER['HTTP_ACCEPT_CHARSET'] ) ? $_SERVER['HTTP_ACCEPT_CHARSET'] : 'unknown';

        $msg = sprintf( "%s %s\n", $a_lang, $a_char );

        fwrite( $fh, $msg );
        fclose( $fh );
    }
}

?>
