// bracketCount.js - JavaScript helper to count open/closed brackets
// Copyright (c) 2003-2005 Andre Eisenbach <andre@ironcreek.net>
//
// bracketCount.js is part of phpSyntaxTree.
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
// $Id: bracketCount.js,v 1.4 2005/11/03 23:07:43 int2str Exp $

function bracketCountOnLoad()
{
    if (! document.getElementById )
        return;

    // Hook the OnKeyUp event for the phrase input area

    data = document.getElementById( 'data' );
    if ( data )
        data.onkeyup = bracketCount;

    // Do the bracket count once when the page is first loaded

    bracketCount();
}

function bracketCount()
{
    if ( !document.getElementById )
        return;

    if ( !document.getElementsByName )
        return;

    var txtArea = document.getElementById( 'data' );
    if ( !txtArea ) return;

    var oc = document.getElementsByName( 'opencount' )[0];
    if ( !oc ) return;

    var cc = document.getElementsByName( 'closedcount' )[0];
    if ( !oc ) return;

    var btn = document.getElementsByName( 'drawbtn' )[0];
    if ( !btn ) return;

    var str = txtArea.value;
    var i = 0;

    var bracketOpen   = 0;
    var bracketClosed = 0;

    for ( i=0; i<str.length; i++ )
    {
        if ( str.charAt( i ) == "[" )
            bracketOpen++;

        if ( str.charAt( i ) == "]" )
            bracketClosed++;
    }

    oc.value = bracketOpen;
    cc.value = bracketClosed;

    if ( (bracketClosed - bracketOpen) == 0 )
        btn.disabled = false;
    else
        btn.disabled = true;
}

hookOnLoad( bracketCountOnLoad );

