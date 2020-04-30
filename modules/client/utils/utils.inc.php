<?php
    function amigable($url, $return = false) {
        $amigableson = URL_AMIGABLES;
        $link = "";
        if ($amigableson) {
            $url = explode("&", str_replace("?", "", $url));
            foreach ($url as $key => $value) {
                $aux = explode("=", $value);
                $link .=  $aux[1]."/";
            }
        } else {
            $link = "index.php?" . $url;
        }
        if ($return) {
            return ROOT . $link;
        }
        if ($link == "home/")
            echo ROOT;
        else
            echo ROOT . $link;
    }