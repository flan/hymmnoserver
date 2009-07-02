<?php

// lang.php - Language helper functions
// Copyright (c) 2003-2005 Andre Eisenbach <andre@ironcreek.net>
//
// lang.php is part of phpSyntaxTree.
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
// $Id: lang.php,v 1.3 2006/07/21 22:26:45 int2str Exp $

function GetLangPrefs()
{
    if ( !isset( $_SERVER['HTTP_ACCEPT_LANGUAGE'] ))
        return array();

    $accept_langs = split( ',', $_SERVER['HTTP_ACCEPT_LANGUAGE'] );
    $lang_prefs = array();

    foreach( $accept_langs as $a_lang )
    {
        $parts = split( ';', $a_lang );

        if ( count( $parts ) > 2 )
        {
            // Unexpected.. more than one semicolon?
            continue;
        }

        if ( count( $parts ) > 1 && substr( $parts[1], 0, 2 ) == 'q=' )
            $parts[1] = floatval( substr( $parts[1], 3 ) );
        else 
            $parts[1] = 1;

        $lang_prefs[ $parts[0] ] = $parts[1];
    }

    arsort( $lang_prefs );

    return( $lang_prefs );
}

function GetLocalizedFname( $filename )
{
    if ( strlen( $filename < 0 ))
        return; 

    $langs = GetLangPrefs();

    foreach( $langs as $lang => $pref)
    {
        $tempname = sprintf( "%s.%s", $filename, $lang );
        
        if ( file_exists( $tempname ) )    
            return $tempname;

        $parts = split( '-', $lang, 2 );

        if ( count( $parts ) > 1 )
        {
            $tempname = sprintf( "%s.%s", $filename, $parts[0] );
        
            if ( file_exists( $tempname ) )    
                return $tempname;
        }
    }

    return $filename;
}

?>
