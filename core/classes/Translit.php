<?php

namespace Bot;

class Translit
{
    protected $abc;
    protected $text;

    function __construct($text)
    {
        $this->abc = array(
            'a' => 'ա',
            'b' => 'բ',
            'g' => 'գ',
            'd' => 'դ',
            'e' => 'ե',
            'z' => 'զ',
            "e'" => 'է',
            "y'" => 'ը',
            "t'" => 'թ',
            'zh' => 'ժ',
            'i' => 'ի',
            'l' => 'լ',
            'x' => 'խ',
            "c'" => 'ծ',
            'k' => 'կ',
            'h' => 'հ',
            'dz' => 'ձ',
            'gh' => 'ղ',
            'tw' => 'ճ',
            'm' => 'մ',
            'y' => 'յ',
            'n' => 'ն',
            'sh' => 'շ',
            'vo' => 'ո',
            'ch' => 'չ',
            'p' => 'պ',
            'j' => 'ջ',
            'rr' => 'ռ',
            's' => 'ս',
            'v' => 'վ',
            't' => 'տ',
            'r' => 'ր',
            'c' => 'ց',
            'w' => 'ւ',
            "p'" => 'փ',
            'q' => 'ք',
            'o' => 'օ',
            'f' => 'ֆ',
            'u' => 'ու',
            'ev' => 'և'
        );
        $this->text = $text;
    }

    public function convertTranslit2Armenian()
    {
        $text = mb_strtolower($this->text);

        foreach ($this->abc as $translit_letter => $armenian_letter) {
           $text = str_replace($translit_letter, $armenian_letter, $text);
        }

        return $text;
    }
}