// hookOnLoad.js - JavaScript helper function to hook up a custom onLoad handler
// Copyright (c) 2003-2005 Andre Eisenbach <andre@ironcreek.net>
//
// hookOnLoad.js is part of phpSyntaxTree.
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
// $Id: hookOnLoad.js,v 1.1 2005/11/03 23:07:43 int2str Exp $

function hookOnLoad( func )
{
    if ( typeof( func ) != 'function' )
    {
        alert( 'Fatal error: Non-function object passed to hookOnLoad()!' );
        return;
    }

    var currOnLoad = window.onload;

    window.onload = function()
    {
        func();

        if ( typeof( currOnLoad ) == 'function' )
            currOnLoad();
    }
}
