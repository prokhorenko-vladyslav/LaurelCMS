<?php
    function module(string $moduleAlias) {
        return \Laurel\CMS\LaurelCMS::instance()->getModule($moduleAlias);
    }
