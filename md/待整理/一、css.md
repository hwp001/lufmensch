##### 一、css

1、cursor   光标

- pointar 手型光标



###### 2、图片放大缩小

1. [图片](http://www.webkaka.com/tutorial/html/2017/072731/)

###### 3、ul 子li

1. li:nth-child(1);

###### 4、去除最后一个li样式

- ```css
  .footer-first ul li:last-child::after{
  	display: none;
  }
  ```

###### 6、图片固定位置

```
.gt{
	bottom:100px;
    display:block;
    height:100px;
    position:fixed;
    width:100px;
}
```

bootom:远离下面   left：远离左边

###### 7、input 结合datalist来用，input的list就是datalist的id