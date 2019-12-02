<?php
function tree($arr,$pid=0,$lever=0){
    static $list = array();
    foreach($arr as $v){
        //如果是顶级分类，则将其存到$list中，并以此节点为根节点，遍历其子节点
        if ($v['parent_id'] == $pid){
            $v['level'] = $lever;
            $list[] = $v;
            tree($arr,$v['cat_id'],$lever+1);
        }
    }
    return $list;
}