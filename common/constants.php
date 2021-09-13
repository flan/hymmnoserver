<?php/*
All code, unless otherwise indicated, is original, and subject to the terms of
the GNU GPLv3 or, at your option, any later version of the GPL.

All content is derived from public domain, promotional, or otherwise-compatible
sources and published uniformly under the
Creative Commons Attribution-Share Alike 3.0 license.

See license.README for details.
 
(C) Neil Tallim, 2009
*/?>

<?php
    $SYNTAX_CLASS = array(
        1 => 'E.V.',
        2 => 'v.',
        3 => 'adv.',
        4 => 'n.',
        5 => 'conj.',
        6 => 'prep.',
        7 => 'E.S. (II)',
        8 => 'adj.',
        9 => 'n., v.',
        10 => 'adj., n.',
        11 => 'adj., v.',
        12 => 'prt.',
        13 => 'E.S. (III)',
        14 => 'E.S. (I)',
        15 => 'pron.',
        16 => 'intj.',
        17 => 'prep., prt.',
        18 => 'cnstr.',
        19 => 'adv., n.',
        20 => 'adj., adv.',
        21 => 'conj., prep.',
        22 => 'prt., v.',
        23 => 'adv., prt.',
        24 => 'n., prep.',
        25 => 'adv., prep.',
    );
    
    $SYNTAX_CLASS_FULL = array(
        1 => 'Emotion Verb',
        2 => 'verb',
        3 => 'adverb',
        4 => 'noun',
        5 => 'conjunction',
        6 => 'preposition',
        7 => 'Emotion Sound (II)',
        8 => 'adjective',
        9 => 'noun, verb',
        10 => 'adjective, noun',
        11 => 'adjective, verb',
        12 => 'particle',
        13 => 'Emotion Sound (III)',
        14 => 'Emotion Sound (I)',
        15 => 'pronoun',
        16 => 'interjection',
        17 => 'preposition, particle',
        18 => 'language construct',
        19 => 'adverb, noun',
        20 => 'adjective, adverb',
        21 => 'conjunction, preposition',
        22 => 'particle, verb',
        23 => 'adverb, particle',
        24 => 'noun, preposition',
        25 => 'adverb, preposition',
    );
    
    $SYNTAX_CLASS_REV = array(
        1 => array(14),#ES(I)
        2 => array(7),#ES(II)
        3 => array(13),#ES(III)
        4 => array(1),#EV
        5 => array(8, 10, 11, 20),#adj
        6 => array(3, 19, 20, 23, 25),#adv
        7 => array(5, 21),#conj
        8 => array(18),#cnstr
        9 => array(16),#intj
        10 => array(4, 9, 10, 19),#n
        11 => array(6, 17, 21, 25),#prep
        12 => array(15),#pron
        13 => array(12, 17, 22, 23),#prt
        14 => array(2, 9, 11, 22)#v
    );
    
    $DIALECT = array(
        0 => 'Unknown',
        1 => 'Central Standard Note',
        2 => 'Cult Ciel Note',
        3 => 'Cluster Note',
        4 => 'Alpha Note',
        5 => 'Metafalss Note',
        6 => 'New Testament of Pastalie',
        7 => 'Alpha Note (EOLIA)',
        50 => 'Unknown [Unofficial]',
        51 => 'Central Standard [Unofficial]',
        52 => 'Cult Ciel [Unofficial]',
        53 => 'Cluster [Unofficial]',
        54 => 'Alpha [Unofficial]',
        55 => 'Metafalss [Unofficial]',
        56 => 'Pastalie [Unofficial]',
        57 => '(EOLIA) [Unofficial]'
    );
?>
