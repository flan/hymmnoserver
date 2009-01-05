# -*- encoding: utf-8 -*-
import urllib2
import re

_ROMAJI_REGEXP = re.compile(r"<font color=\"red\">(.+?)<br />", re.I)

def getRomaji(kana):
	req = urllib2.Request("http://www.romaji.org", ("text=%s&save=convert+text+to+Romaji" % kana).encode('s_jis'))
	data = urllib2.urlopen(req)
	
	try:
		for line in data.readlines():
			m = _ROMAJI_REGEXP.search(line)
			if m:
				return m.group(1)
		raise Exception("Romaji not found!")
	finally:
		data.close()
		