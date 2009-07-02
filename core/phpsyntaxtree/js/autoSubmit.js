// autoSubmit.js - JavaScript helper to force a submit of a form when an option is changed
// Copyright (c) 2003-2005 Andre Eisenbach <andre@ironcreek.net>
//
// autoSubmit.js is part of phpSyntaxTree.
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
// $Id: autoSubmit.js,v 1.3 2005/11/03 23:07:43 int2str Exp $

function autoSubmitHookOnChange( controlName, formId )
{
    if ( !document.getElementsByName )
        return;

    if ( !document.getElementById )
        return;

    control = document.getElementsByName( controlName )[0];
    if ( !control ) return;

    myform = document.getElementById( formId );
    if ( !myform ) return;

    control.onchange = function() 
    { 
        myform.submit(); 
    };
}

function autoSubmitHookOnClick( controlName, formId )
{
    if ( !document.getElementsByName )
        return;

    control = document.getElementsByName( controlName )[0];
    if ( !control ) return;

    myform = document.getElementById( formId );
    if ( !myform ) return;

    control.onclick = function() 
    { 
        myform.submit(); 
    };
}

function autoSubmitOnLoad()
{
    autoSubmitHookOnChange( 'font',     'phraseform' );
    autoSubmitHookOnChange( 'fontsize', 'phraseform' );

    autoSubmitHookOnClick( 'color',     'phraseform' );
    autoSubmitHookOnClick( 'antialias', 'phraseform' );
    autoSubmitHookOnClick( 'autosub',   'phraseform' );
    autoSubmitHookOnClick( 'triangles', 'phraseform' );
}

hookOnLoad( autoSubmitOnLoad );
