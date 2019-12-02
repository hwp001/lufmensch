# SERVER

##### $_SERVER['QUERY_STRING']

- 获得当前参数地址 

##### $_SERVER['PHP_SELF']

- 获得当前页

##### $_SERVER['REQUEST_URI']

- 获得整个当前参数地址路径

##### parse_url()

- 参数为  $_SERVER['REQUEST_URI']
- 以数组的方式返回路径地址，还有get的值和地址（传参）

##### parse_str()

- 对get的值和地址，拆开成变量的形式

##### http_build_query()

- 将parse_str()拆分的，重新连接起来