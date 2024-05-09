<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function videoEmbeder(string $link)
    {
        $pos_vimeo = strpos($link, "vimeo");
        $pos_youtube = strpos($link, "youtube");

        switch (true) {
            case $pos_vimeo !== false:
                $embedLink = str_replace("vimeo.com", "player.vimeo.com/video", $link);
                return $embedLink;
                break;
            case $pos_youtube !== false:
                $embedLink = str_replace("watch?v=", "embed/", $link);
                return $embedLink;
                break;
            default:
                echo "Opa :(";
        }
    }
}
