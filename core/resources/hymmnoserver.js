function popUpWord(word, dialect){
	self.name = "main_window";
	
	popup_window = window.open(
	 '/hymmnoserver/word.php?word=' + word + '&dialect=' + dialect, "popup_window",
	 'toolbar=no,location=0,directories=0,status=0,menubar=0,scrollbars=yes,resizable=yes,width=515,height=340'
	);
	popup_window.focus();
}
