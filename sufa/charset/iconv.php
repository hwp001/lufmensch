<?php
//把一个GB2312格式的字符串转换成UTF-8格式
var_dump(iconv('UTF-8','GB2312','悄悄是别离的笙箫'));