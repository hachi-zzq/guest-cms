<?php
//是否开启缓存机制，后台专用
define(IS_CACHE, false);
IS_CACHE?ob_start():null;
?>