<?php

namespace CodeEduUser\Menu;

class Navbar{

    public function getLinksAuthorized($links)
    {
        $linksAuthorized = [];
        foreach ($links as $link){

            if (isset($link[0])){
                $l = $this->getLinksAuthorized($link[1]);
                if (count($l)){
                    $linksAuthorized[]=[
                      $link[0],
                        $l
                    ];
                }
            }elseif (\Auth::user()->can($link['permission'])){
                $linksAuthorized[] = $link;
            }
        }
        return $linksAuthorized;
    }
}