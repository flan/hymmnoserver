/*
All code, unless otherwise indicated, is original, and subject to the terms of
the GNU GPLv3 or, at your option, any later version of the GPL.

All content is derived from public domain, promotional, or otherwise-compatible
sources and published uniformly under the
Creative Commons Attribution-Share Alike 3.0 license.

See license.README for details.
 
(C) Neil Tallim, 2009
*/

//This function causes a word to open in its own window.
function popUpWord(word, dialect){
	self.name = "main_window";
	popup_window = window.open(
	 './word.php?word=' + word + '&dialect=' + dialect, "popup_window",
	 'toolbar=no,location=0,directories=0,status=0,menubar=0,scrollbars=yes,resizable=yes,width=515,height=340'
	);
	popup_window.focus();
}

