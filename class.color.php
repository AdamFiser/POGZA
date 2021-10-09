<?php
class Image_Color {
    
	var $color1 = array(); //Urceni prvni barvy
	var $color2 = array(); //urceni druhe barvy
	var $_websafeb = false; //omezujeme se jen na websafe barvy?

    //mix dvou barev (spojeni) nalezenim jejich prumeru
    function mixColors($col1 = false, $col2 = false)
    {
        if ($col1) {
            $this->_setColors($col1, $col2);
        }

        // after finding the average, it will be a float. add 0.5 and then
        // cast to an integer to properly round it to an integer.
        $color3[0] = (int) ((($this->color1[0] + $this->color2[0]) / 2) + 0.5);
        $color3[1] = (int) ((($this->color1[1] + $this->color2[1]) / 2) + 0.5);
        $color3[2] = (int) ((($this->color1[2] + $this->color2[2]) / 2) + 0.5);

        if ($this->_websafeb) {
            array_walk($color3, '_makeWebSafe');
        }

        return Image_Color::rgb2hex($color3);
    }

    //ma-li byt vystupni barva websafe, zvolime true
    function setWebSafe($bool = true)
    {
        $this->_websafeb = (boolean) $bool;
    }

    //VZDY VOLAT - nastavuje barvy pro prechod
    function setColors($col1, $col2)
    {
        $this->_setColors($col1, $col2);
    }

    
    //vraci "stupne" odstupu mezi barvami
    function getRange($degrees = 2)
    {
        if ($degrees == 0) {
            $degrees = 1;
        }

        // jednotlivé pøechody barev

        $red_steps   = ($this->color2[0] - $this->color1[0]) / $degrees;
        $green_steps = ($this->color2[1] - $this->color1[1]) / $degrees;
        $blue_steps  = ($this->color2[2] - $this->color1[2]) / $degrees;

        $allcolors = array();

        //zastavíme, jakmile dojdeme s jednou barvou na konec
        // Projdeme skriz vsechny stupne mezi barvami
        for ($x = 0; $x < $degrees; $x++) {
            $col[0] = $red_steps * $x;
            $col[1] = $green_steps * $x;
            $col[2] = $blue_steps * $x;

            // pro kazdou slozku r,g,b
            for ($i = 0; $i < 3; $i++) {
                $partcolor = $this->color1[$i] + $col[$i];
                // je-li barva mensi 256
                if ($partcolor < 256) {
                    // kontrola, zda-li barva neni mensi 0
                    if ($partcolor > -1) {
                        $newcolor[$i] = $partcolor;
                    } else {
                        $newcolor[$i] = 0;
                    }
                // barva je vetsi 255
                } else {
                    $newcolor[$i] = 255;
                }
            }

            if ($this->_websafeb) {
                array_walk($newcolor, '_makeWebSafe');
            }

            $allcolors[] = Image_Color::rgb2hex($newcolor);
        }

        return $allcolors;
    }

    // zmena jasu
    function changeLightness($degree = 10)
    {
        $color1 =& $this->color1;
        $color2 =& $this->color2;

        for ($x = 0; $x < 3; $x++) {
            if (($color1[$x] + $degree) < 256) {
                if (($color1[$x] + $degree) > -1) {
                    $color1[$x] += $degree;
                } else {
                    $color1[$x] = 0;
                }
            } else {
                $color1[$x] = 255;
            }

            if (($color2[$x] + $degree) < 256) {
                if (($color2[$x] + $degree) > -1) {
                    $color2[$x] += $degree;
                } else {
                    $color2[$x] = 0;
                }
            } else {
                $color2[$x] = 255;
            }
        }
    }

    //nastavuje barvu textu, je-li pozadi tmave, mame bily text a naopak, se svetlym pozadim tmavy text.
    function getTextColor($color, $light = '#FFFFFF', $dark = '#000000')
    {
        $color = Image_Color::_splitColor($color);
        if ($color[1] > hexdec('66')) {
            return $dark;
        } else {
            return $light;
        }
    }

	//Zmeni odstin, defaultne o 10 stupnu
    function changeHue ( $degree=10 )
    {
        $color2 =& $this->color2;
        $color1 =& $this->color1;
        
        for ( $x = 0; $x < 3; $x++ )
        {
            if ( ( $color1[$x] + $degree ) < 256 )
            {
                if ( ( $color1[$x] + $degree ) > -1 )
                {
                    $color1[$x] += $degree;
                } else {
                    $color1[$x] = 0;
                }
            } else {
                $color1[$x] = 255;
            }
        }
        
        for ( $x = 0; $x < 3; $x++ )
        {
            if ( ( $color2[$x] + $degree ) < 256 )
            {
                if ( ( $color2[$x] + $degree ) > -1 )
                {
                    $color2[$x] += $degree;
                } else {
                    $color2[$x] = 0;
                }
            } else {
                $color2[$x] = 255;
            }
        }
    }
    
    //interni fce pro nastaveni barev
    //zadavat barvy v jmennem tvaru nebo jako hexa
    function _setColors($col1, $col2)
    {
        if ($col1) {
            $this->color1 = Image_Color::_splitColor($col1);
        }
        if ($col2) {
            $this->color2 = Image_Color::_splitColor($col2);
        }
    }

    //vrací kod barvy v rgb 0=r, 1=g, 2=b
    function _splitColor($color)
    {
        $color = str_replace('#', '', $color);
        $c[] = hexdec(substr($color, 0, 2));
        $c[] = hexdec(substr($color, 2, 2));
        $c[] = hexdec(substr($color, 4, 2));
        return $c;
    }

    //pøevedení pole (r,g,b) do hexa
    function rgb2hex($color)
    {
        return sprintf('%02X%02X%02X',$color[0],$color[1],$color[2]);
    }

    //pøevedení hexa do pole (r,g,b)
    function hex2rgb($hex)
    {
        $return = Image_Color::_splitColor($hex);
        $return['hex'] = $hex;
        return $return;
    }

    //pøevedení HSV Hue, Saturation, Brightness) do RGB
    //Hue(odstin) v stupnich, sytost %, jas %
    function hsv2rgb($h, $s, $v)
    {
        return Image_Color::hex2rgb(Image_Color::hsv2hex($h, $s, $v));
    }

    //pøevedení HSV Hue, Saturation, Brightness) do hexa kodu
    function hsv2hex($h, $s, $v)
    {
        $s /= 256.0;
        $v /= 256.0;
        if ($s == 0.0) {
            $r = $g = $b = $v;
            return '';
        } else {
            $h = $h / 256.0 * 6.0;
            $i = floor($h);
            $f = $h - $i;

            $v *= 256.0;
            $p = (integer)($v * (1.0 - $s));
            $q = (integer)($v * (1.0 - $s * $f));
            $t = (integer)($v * (1.0 - $s * (1.0 - $f)));
            switch($i) {
                case 0:
                    $r = $v;
                    $g = $t;
                    $b = $p;
                    break;

                case 1:
                    $r = $q;
                    $g = $v;
                    $b = $p;
                    break;

                case 2:
                    $r = $p;
                    $g = $v;
                    $b = $t;
                    break;

                case 3:
                    $r = $p;
                    $g = $q;
                    $b = $v;
                    break;

                case 4:
                    $r = $t;
                    $g = $p;
                    $b = $v;
                    break;

                default:
                    $r = $v;
                    $g = $p;
                    $b = $q;
                    break;
            }
        }
        return $this->rgb2hex(array($r, $g, $b));
    }

    // pøidìlení barvy k obrázku
    function allocateColor(&$img, $color) {
        $color = Image_Color::color2RGB($color);

        return ImageColorAllocate($img, $color[0], $color[1], $color[2]);
    }

    //pøevedení jména barvy nebo hexa kód na RGB pole
    function color2RGB($color)
    {
        $c = array();

        if ($color{0} == '#') {
            $c = Image_Color::hex2rgb($color);
        } else {
            $c = Image_Color::namedColor2RGB($color);
        }

        return $c;
    }

	
    //prevod jmena barvy na rgb
    //zdroj: jpgraph
    function namedColor2RGB($color)
    {
        static $colornames;

        if (!isset($colornames)) {
            $colornames = array(
              'aliceblue'             => array(240, 248, 255),
              'antiquewhite'          => array(250, 235, 215),
              'aqua'                  => array(  0, 255, 255),
              'aquamarine'            => array(127, 255, 212),
              'azure'                 => array(240, 255, 255),
              'beige'                 => array(245, 245, 220),
              'bisque'                => array(255, 228, 196),
              'black'                 => array(  0,   0,   0),
              'blanchedalmond'        => array(255, 235, 205),
              'blue'                  => array(  0,   0, 255),
              'blueviolet'            => array(138,  43, 226),
              'brown'                 => array(165,  42,  42),
              'burlywood'             => array(222, 184, 135),
              'cadetblue'             => array( 95, 158, 160),
              'chartreuse'            => array(127, 255,   0),
              'chocolate'             => array(210, 105,  30),
              'coral'                 => array(255, 127,  80),
              'cornflowerblue'        => array(100, 149, 237),
              'cornsilk'              => array(255, 248, 220),
              'crimson'               => array(220,  20,  60),
              'cyan'                  => array(  0, 255, 255),
              'darkblue'              => array(  0,   0,  13),
              'darkcyan'              => array(  0, 139, 139),
              'darkgoldenrod'         => array(184, 134,  11),
              'darkgray'              => array(169, 169, 169),
              'darkgreen'             => array(  0, 100,   0),
              'darkkhaki'             => array(189, 183, 107),
              'darkmagenta'           => array(139,   0, 139),
              'darkolivegreen'        => array( 85, 107,  47),
              'darkorange'            => array(255, 140,   0),
              'darkorchid'            => array(153,  50, 204),
              'darkred'               => array(139,   0,   0),
              'darksalmon'            => array(233, 150, 122),
              'darkseagreen'          => array(143, 188, 143),
              'darkslateblue'         => array( 72,  61, 139),
              'darkslategray'         => array( 47,  79,  79),
              'darkturquoise'         => array(  0, 206, 209),
              'darkviolet'            => array(148,   0, 211),
              'deeppink'              => array(255,  20, 147),
              'deepskyblue'           => array(  0, 191, 255),
              'dimgray'               => array(105, 105, 105),
              'dodgerblue'            => array( 30, 144, 255),
              'firebrick'             => array(178,  34,  34),
              'floralwhite'           => array(255, 250, 240),
              'forestgreen'           => array( 34, 139,  34),
              'fuchsia'               => array(255,   0, 255),
              'gainsboro'             => array(220, 220, 220),
              'ghostwhite'            => array(248, 248, 255),
              'gold'                  => array(255, 215,   0),
              'goldenrod'             => array(218, 165,  32),
              'gray'                  => array(128, 128, 128),
              'green'                 => array(  0, 128,   0),
              'greenyellow'           => array(173, 255,  47),
              'honeydew'              => array(240, 255, 240),
              'hotpink'               => array(255, 105, 180),
              'indianred'             => array(205,  92,  92),
              'indigo'                => array(75,    0, 130),
              'ivory'                 => array(255, 255, 240),
              'khaki'                 => array(240, 230, 140),
              'lavender'              => array(230, 230, 250),
              'lavenderblush'         => array(255, 240, 245),
              'lawngreen'             => array(124, 252,   0),
              'lemonchiffon'          => array(255, 250, 205),
              'lightblue'             => array(173, 216, 230),
              'lightcoral'            => array(240, 128, 128),
              'lightcyan'             => array(224, 255, 255),
              'lightgoldenrodyellow'  => array(250, 250, 210),
              'lightgreen'            => array(144, 238, 144),
              'lightgrey'             => array(211, 211, 211),
              'lightpink'             => array(255, 182, 193),
              'lightsalmon'           => array(255, 160, 122),
              'lightseagreen'         => array( 32, 178, 170),
              'lightskyblue'          => array(135, 206, 250),
              'lightslategray'        => array(119, 136, 153),
              'lightsteelblue'        => array(176, 196, 222),
              'lightyellow'           => array(255, 255, 224),
              'lime'                  => array(  0, 255,   0),
              'limegreen'             => array( 50, 205,  50),
              'linen'                 => array(250, 240, 230),
              'magenta'               => array(255,   0, 255),
              'maroon'                => array(128,   0,   0),
              'mediumaquamarine'      => array(102, 205, 170),
              'mediumblue'            => array(  0,   0, 205),
              'mediumorchid'          => array(186,  85, 211),
              'mediumpurple'          => array(147, 112, 219),
              'mediumseagreen'        => array( 60, 179, 113),
              'mediumslateblue'       => array(123, 104, 238),
              'mediumspringgreen'     => array(  0, 250, 154),
              'mediumturquoise'       => array(72, 209, 204),
              'mediumvioletred'       => array(199,  21, 133),
              'midnightblue'          => array( 25,  25, 112),
              'mintcream'             => array(245, 255, 250),
              'mistyrose'             => array(255, 228, 225),
              'moccasin'              => array(255, 228, 181),
              'navajowhite'           => array(255, 222, 173),
              'navy'                  => array(  0,   0, 128),
              'oldlace'               => array(253, 245, 230),
              'olive'                 => array(128, 128,   0),
              'olivedrab'             => array(107, 142,  35),
              'orange'                => array(255, 165,   0),
              'orangered'             => array(255,  69,   0),
              'orchid'                => array(218, 112, 214),
              'palegoldenrod'         => array(238, 232, 170),
              'palegreen'             => array(152, 251, 152),
              'paleturquoise'         => array(175, 238, 238),
              'palevioletred'         => array(219, 112, 147),
              'papayawhip'            => array(255, 239, 213),
              'peachpuff'             => array(255, 218, 185),
              'peru'                  => array(205, 133,  63),
              'pink'                  => array(255, 192, 203),
              'plum'                  => array(221, 160, 221),
              'powderblue'            => array(176, 224, 230),
              'purple'                => array(128,   0, 128),
              'red'                   => array(255,   0,   0),
              'rosybrown'             => array(188, 143, 143),
              'royalblue'             => array( 65, 105, 225),
              'saddlebrown'           => array(139,  69,  19),
              'salmon'                => array(250, 128, 114),
              'sandybrown'            => array(244, 164,  96),
              'seagreen'              => array( 46, 139,  87),
              'seashell'              => array(255, 245, 238),
              'sienna'                => array(160,  82,  45),
              'silver'                => array(192, 192, 192),
              'skyblue'               => array(135, 206, 235),
              'slateblue'             => array(106,  90, 205),
              'slategray'             => array(112, 128, 144),
              'snow'                  => array(255, 250, 250),
              'springgreen'           => array(  0, 255, 127),
              'steelblue'             => array( 70, 130, 180),
              'tan'                   => array(210, 180, 140),
              'teal'                  => array(  0, 128, 128),
              'thistle'               => array(216, 191, 216),
              'tomato'                => array(255,  99,  71),
              'turquoise'             => array( 64, 224, 208),
              'violet'                => array(238, 130, 238),
              'wheat'                 => array(245, 222, 179),
              'white'                 => array(255, 255, 255),
              'whitesmoke'            => array(245, 245, 245),
              'yellow'                => array(255, 255,   0),
              'yellowgreen'           => array(154, 205,  50)
            );
        }

        $color = strtolower($color);

        if (isset($colornames[$color])) {
            return $colornames[$color];
        } else {
            return array(0, 0, 0);
        }
    }

    //prevede procentualni vyjadreni na rgb
    function percentageColor2RGB($color)
    {
        // odstranime mezery
        $color = str_replace(' ', '', $color);
        // odstranime %
        $color = str_replace('%', '', $color);
        // spojime carkou
        $color = explode(',', $color);

        $ret = array();
        foreach ($color as $k => $v) {
            if ($v <= 0) {
                $ret[$k] = 0;
            } else if ($v <= 100) {
                // pricteni 0.5 pro lepsi zaokrouhleni
                $ret[$k] = (integer) ((2.55 * $v) + 0.5);
            } else {
                $ret[$k] = 255;
            }
        }

        return $ret;
    }
}

// "zaokrouhli" barvu na webSafe
function _makeWebSafe(&$color)
{
    if ($color < 0x1a) {
        $color = 0x00;
    } else if ($color < 0x4d) {
        $color = 0x33;
    } else if ($color < 0x80) {
        $color = 0x66;
    } else if ($color < 0xB3) {
        $color = 0x99;
    } else if ($color < 0xE6) {
        $color = 0xCC;
    } else {
        $color = 0xFF;
    }
    return $color;
}
// }}}

?>
