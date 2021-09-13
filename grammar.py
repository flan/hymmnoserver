#!/usr/bin/python3
# -*- coding: utf-8 -*-
"""
Hymmnoserver script: grammar

Purpose
=======
 Provides an interface for processing and displaying user input.
 
Legal
=====
 All code, unless otherwise indicated, is original, and subject to the terms of
 the GNU GPLv3 or, at your option, any later version of the GPL.
 
 All content is derived from public domain, promotional, or otherwise-compatible
 sources and published uniformly under the
 Creative Commons Attribution-Share Alike 3.0 license.
 
 See license.README for details.
 
 (C) Neil Tallim, 2009-2021
"""
import cgi
import html
import re
import time
import urllib.parse

from common import syntax
from common import transformations
from database import db

def _renderMicroTransformation(component):
    """
    Renders a value-bar in a transformation-list.
    
    @type component: basestring
    @param component: The Hymmnos data to display.
    """
    link = "./search.php?" + urllib.parse.urlencode({'word': component})
    line = html.escape(component, True)
    print("""
        <td class="transformation">
            <div style="font-family: hymmnos, sans; font-size: 1.5em;"><a href="{link}" style="display: block; color: #00008B; text-decoration: none; outline: none;">{line}</a></div>
            <div><a href="{link}" style="display: block; color: #00008B; text-decoration: none; outline: none;">{line}</a></div>
        </td>
    """.format(
        link=link,
        line=line,
    ))
    
def _renderMacroTransformation(phrase, components, unknown):
    """
    Renders the result of a transformation.
    
    @type phrase: basestring
    @param phrase: The Hymmnos phrase processed.
    @type components: sequence
    @param components: A collection of Hymmnos data to display.
    @type unknown: sequence
    @param unknown: A collection of all words not recognized in the input.
    """
    print("""
        <table class="result" style="border-spacing: 1px; color: white; background: #808080; border: 1px solid black; width: 100%;">
            <tr>
                <td style="color: #00008B; background: #D3D3D3; padding-left: 5px; padding-top: 5px; padding-right: 2px;" colspan="2">
                    <div style="font-family: hymmnos, sans; font-size: 18pt;">{phrase}</div>
                    <div style="font-size: 12pt;">{phrase}</div>
                </td>
            </tr>
    """.format(
        phrase=phrase,
    ))
    
    for (i, lines) in enumerate(components):
        print("""
            <tr>
                <td class="transformation-id">{id}</td>
        """.format(
            id=i,
        ))
        
        if len(lines) > 1:
            print("""
                <td style="background: #808080;">
                    <table style="width: 100%; border-spacing: 1px;">
            """)
            for (j, line) in enumerate(lines):
                print("""
                        <tr>
                            <td class="transformation-id">{id}</td>
                """.format(
                    id=j,
                ))
                _renderMicroTransformation(line)
                
                print("""
                        </tr>
                """)
                
            print("""
                    </table>
                </td>
            """)
        else:
            _renderMicroTransformation(lines[0])
            
        print("""
            </tr>
        """)
        
    if unknown:
        plural = ''
        if len(unknown) > 1:
            plural = 's'
        print("""
            <tr>
                <td style="color: white; background: black;" colspan="2">
                    <div style="font-size: 10pt;">Unknown word{plural}: {unknown}</div>
                </td>
            </tr>
        """.format(
            plural=plural,
            unknown=html.escape(", ".join(unknown), True),
        ))
    print("""
        </table>
    """)
    
def _renderFailure(message):
    """
    Renders a message indicating that processing failed.
    
    @type message: basestring
    @param message: A description of the error that occurred.
    """
    print("""
        <table style="border-collapse: collapse; border: 1px solid black; width: 100%;">
            <tr>
                <td style="color: #00008B; text-align: center; background: #D3D3D3;">
                    <div style="font-size: 18pt;">an error occurred while processing your request</div>
                </td>
            </tr>
            <tr>
                <td style="background: red; color: white; text-align: center;">{message}</td>
            </tr>
        </table>
    """.format(
        message=message,
    ))
    
    
    
form = cgi.FieldStorage()

print("Content-Type: application/xhtml+xml")
print("Expires: Mon, 20 Dec 1998 01:00:00 GMT")
print("Last-Modified:", time.strftime("%a, %d %b %Y %H:%M:%S", time.gmtime()), "GMT")
print("Cache-Control: no-cache, must-revalidate")
print("Pragma: no-cache")
print()

print("""<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Hymmnoserver - Grammar processor</title>
""")

resources = open("common/resources.xml", 'r')
print(resources.read())
resources.close()

print("""
    </head>
    <body>
""")

header = open("common/header.xml", 'r')
print(header.read())
header.close()

query = form.getfirst("query")
if not query or not query.strip():
    print("""
    <div class="text-basic">
        <div class="section-title text-title-small">⠕ Advanced grammar resources</div>
        <big>The following features are made available through this interface:</big>
        <blockquote class="text-small">
            <p>
                <span class="text-title-small">1) Syntax validation and structural analysis</span><br/>
                Enter a <b>complete sentence</b> in Hymmnos and submit it.
                If the syntax processor is able to analyze your input, a syntax tree will be produced,
                informing you of the structure of what you have provided. It is hoped that this will
                help in translating sentences.
                <br/><br/>
                <small>
                    Please note that this feature is highly experimental and that it will not (and never
                    will, due to Hymmnos having some
                    <a href="http://en.wikipedia.org/wiki/NP-complete">NP-complete</a>-looking structures)
                    recognize all valid sentences, and it may also approve of some invalid sentences due to
                    flexibility encoded to handle more complex patterns.
                    <br/><br/>
                    Note also that this is not a production-grade linguistics work. The syntax trees it
                    generates are amateurish in nature, occasionally lacking proper relationship structures,
                    and are, thus, intended solely to assist humans in infering meaning.
                </small>
            </p>
            <p>
                <span class="text-title-small">2) Binasphere Chorus conversion</span><br/>
                Enter multiple (two or more) phrases and Binasphere Chorus output will be generated.
                <br/><br/>
                Enter Binasphere Chorus text and its constituent phrases will be reconstructed.
            </p>
            <p>
                <span class="text-title-small">3) Persistent Emotion Sounds application</span><br/>
                Enter a Persistent Emotion Sounds passage and the effective full-sentence-form
                equivalents will be produced.
            </p>
        </blockquote>
    </div>
    """)
else:
    db_con = db.getConnection()
    lines = [line for line in [l.strip() for l in query.splitlines()] if line]
    try:
        try: #Attempt to decode as a Binasphere phrase, since this fails in constant time.
            (lines_list, unknown) = transformations.decodeBinasphere(' '.join(lines), db_con)
            _renderMacroTransformation(html.escape(query, True), lines_list, unknown)
        except transformations.FormatError:
            if len(lines) > 1:
                try: #Try to apply Persistent Emotion Sounds markup, since this is purely linear.
                    (new_lines, processed, unknown) = transformations.applyPersistentEmotionSounds(lines, db_con)
                    _renderMacroTransformation('<br/>'.join([html.escape(line) for line in new_lines]), processed, unknown)
                except transformations.FormatError: #Try to encode as a Binasphere phrase.
                    (phrase, lines_list, unknown) = transformations.encodeBinasphere(lines, db_con)
                    _renderMacroTransformation(html.escape(phrase, True), lines_list, unknown)
            else: #Attempt syntax processing.
                lines = [l for l in [re.sub(r'\s+\.\s+', ' ', re.sub(r'^\s*|[?!,:\'"/\\]|\.\.+|\s*\.*\s*$', '', line)) for line in lines] if l]
                try:
                    (tree, display_string, result) = syntax.processSyntax(lines[0], db_con)
                    if result is None:
                        _renderFailure("unable to validate sentence; it may not be complete")
                    else:
                        print(syntax.renderResult_xhtml(tree, display_string))
                except syntax.ContentError as e:
                    _renderFailure("unable to process input: {error}".format(
                        error=e,
                    ))
    except transformations.ContentError as e:
        _renderFailure("unable to process input: {error}".format(
            error=e,
        ))
    except Exception as e:
        _renderFailure("an unexpected error occurred: {error}".format(
            error=e,
        ))
        
    try:
        db_con.close()
    except:
        pass
        
print("""
<hr/>
<form method="get" action="./grammar.py">
    <div>
        <div style="text-align: center;">
            <textarea name="query" id="query" rows="5" style="width: 100%;">{query}</textarea>
        </div>
        <div style="text-align: right;">
            <input type="button" value="Clear" onclick="document.getElementById('query').value='';"/>
            <input type="button" value="Remove linebreaks" onclick="document.getElementById('query').value = document.getElementById('query').value.replace(/\r?\n/g, ' ');"/>
            <input type="submit" value="Process query"/>
        </div>
    </div>
</form>
""".format(
    query=html.escape(query or ''),
))

footer = open("common/footer-py.xml", 'r')
print(footer.read())
footer.close()

print("""
    </body>
</html>
""")
