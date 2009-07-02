<?php 

// smoothline.php - Anti-aliased line drawing
//
// From the PHP documentation at http://php.net/imageline
// Original author: nanobot@chipx86.com
//
// NOTE: It is not yet clear which license the code below
//       was released under (by posting it on php.net). Therefore
//       this code may be removed int the future.
//
// TODO: Use faster GPL licensed/free algorithm for anti-aliasing if available.
//
// $Id: smoothline.php,v 1.1.1.1 2005/01/05 17:49:14 int2str Exp $

function imagesmoothline( $image, $x1, $y1, $x2, $y2, $color )
{
    $colors = imagecolorsforindex( $image, $color );
    
    if ($x1 == $x2)
    {
        imageline ($image, $x1, $y1, $x2, $y2, $color);    // Vertical line
    }
    else
    {
        $m = ($y2 - $y1) / ($x2 - $x1);
        $b = $y1 - $m * $x1;
        if (abs ($m) <= 1)
        {
            $x = min ($x1, $x2);
            $endx = max ($x1, $x2);
            while ($x <= $endx)
            {
            $y = $m * $x + $b;
            $y == floor ($y) ? $ya = 1 : $ya = $y - floor ($y);
            $yb = ceil ($y) - $y;
            $tempcolors =
                imagecolorsforindex ($image,
                        imagecolorat ($image, $x,
                                floor ($y)));
            $tempcolors['red'] =
                $tempcolors['red'] * $ya + $colors['red'] * $yb;
            $tempcolors['green'] =
                $tempcolors['green'] * $ya + $colors['green'] * $yb;
            $tempcolors['blue'] =
                $tempcolors['blue'] * $ya + $colors['blue'] * $yb;
            if (imagecolorexact
                ($image, $tempcolors['red'], $tempcolors['green'],
                $tempcolors['blue']) == -1)
                imagecolorallocate ($image, $tempcolors['red'],
                        $tempcolors['green'],
                        $tempcolors['blue']);
            imagesetpixel ($image, $x, floor ($y),
                    imagecolorexact ($image, $tempcolors['red'],
                            $tempcolors['green'],
                            $tempcolors['blue']));
            $tempcolors =
                imagecolorsforindex ($image,
                        imagecolorat ($image, $x,
                                ceil ($y)));
            $tempcolors['red'] =
                $tempcolors['red'] * $yb + $colors['red'] * $ya;
            $tempcolors['green'] =
                $tempcolors['green'] * $yb + $colors['green'] * $ya;
            $tempcolors['blue'] =
                $tempcolors['blue'] * $yb + $colors['blue'] * $ya;
            if (imagecolorexact
                ($image, $tempcolors['red'], $tempcolors['green'],
                $tempcolors['blue']) == -1)
                imagecolorallocate ($image, $tempcolors['red'],
                        $tempcolors['green'],
                        $tempcolors['blue']);
            imagesetpixel ($image, $x, ceil ($y),
                    imagecolorexact ($image, $tempcolors['red'],
                            $tempcolors['green'],
                            $tempcolors['blue']));
            $x++;
            }
        }
        else
        {
            $y = min ($y1, $y2);
            $endy = max ($y1, $y2);
            while ($y <= $endy)
            {
            $x = ($y - $b) / $m;
            $x == floor ($x) ? $xa = 1 : $xa = $x - floor ($x);
            $xb = ceil ($x) - $x;
            $tempcolors =
                imagecolorsforindex ($image,
                        imagecolorat ($image, floor ($x),
                                $y));
            $tempcolors['red'] =
                $tempcolors['red'] * $xa + $colors['red'] * $xb;
            $tempcolors['green'] =
                $tempcolors['green'] * $xa + $colors['green'] * $xb;
            $tempcolors['blue'] =
                $tempcolors['blue'] * $xa + $colors['blue'] * $xb;
            if (imagecolorexact
                ($image, $tempcolors['red'], $tempcolors['green'],
                $tempcolors['blue']) == -1)
                imagecolorallocate ($image, $tempcolors['red'],
                        $tempcolors['green'],
                        $tempcolors['blue']);
            imagesetpixel ($image, floor ($x), $y,
                    imagecolorexact ($image, $tempcolors['red'],
                            $tempcolors['green'],
                            $tempcolors['blue']));
            $tempcolors =
                imagecolorsforindex ($image,
                        imagecolorat ($image, ceil ($x),
                                $y));
            $tempcolors['red'] =
                $tempcolors['red'] * $xb + $colors['red'] * $xa;
            $tempcolors['green'] =
                $tempcolors['green'] * $xb + $colors['green'] * $xa;
            $tempcolors['blue'] =
                $tempcolors['blue'] * $xb + $colors['blue'] * $xa;
            if (imagecolorexact
                ($image, $tempcolors['red'], $tempcolors['green'],
                $tempcolors['blue']) == -1)
                imagecolorallocate ($image, $tempcolors['red'],
                        $tempcolors['green'],
                        $tempcolors['blue']);
            imagesetpixel ($image, ceil ($x), $y,
                    imagecolorexact ($image, $tempcolors['red'],
                            $tempcolors['green'],
                            $tempcolors['blue']));
            $y++;
            }
        }
    }
}

?>
