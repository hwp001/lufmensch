
create table if not exists vehicle_role(
		roleId int unsigned not null auto_increment,

		roleName varchar(32) not null,
		rootName varchar(60)  default 'read',
		addTime varchar(32) default '2019.9',
		updateTime varchar(32) default '2019.9',
		roleState varchar(10) default 1,
		delState int(2) default 1,
		primary key(roleId)
)engine=innodb;

insert into vehicle_role(roleName) values('超级管理员');
alter table vehicle_role add delState int default 1;
alter table vehicle_role change rootId rootName varchar(32) default 'edit';
alter table vehicle_role change role_state roleState int unsigned not null default 0;

drop table if exists vehicle_role;

insert into vehicle_role values(null,'人事'),(null,'经理');

create table if not exists vehicle_root(
		rootId int unsigned not null auto_increment,
		rootName varchar(32) not null,
		primary key(rootId)
)engine=innodb;

drop table if exists vehicle_root;

insert into vehicle_root values(null,'root'),(null,'check');

create table if not exists vehicle_orders(
		ordersId int not null auto_increment,
		driverName varchar(32) not null,
		driverPhone int not null,
		goodName int not null,
		carLicense int not null,
		company varchar(32),
		ordersState int default 0,
		orderId int unsigned not null default 0,
		delState int not null default 1,
		primary key(ordersId)
)engine=innodb charset=utf8;

alter table vehicle_orders add createTime varchar(32) default '0';
drop table if exists vehicle_orders;


create table if not exists vehicle_user(
		userId int unsigned not null auto_increment,
		roleId int unsigned not null,
		userName varchar(32) not null,
		userPwd varchar(32) not null default '123456',
		userImg varchar(60),
		trueName varchar(32) not null,
		loginTime varchar(32),
		loginTimes int,
		loginState varchar(32) default '0',
		loginIp varchar(32),
		delState int(2) not null default 1,
		primary key(userId),
		foreign key(roleId)references vehicle_role(roleId)
)engine=innodb;

drop table if exists vehicle_user;


select * from vehicle_user where delState = 1;

alter table vehicle_user add delState int default '1';

alter table vehicle_user modify LoginIp varchar(32) default '0.0.0.0';

insert into vehicle_user (userName,userPwd,roleId,trueName,loginState) values (huangweipeng,12345,2,黄炜鹏,在线);

alter table vehicle_user modify loginState varchar(32) not null default '不在线';

drop table if exists vehicle_user;

 SET FOREIGN_KEY_CHECKS = 1
select @@FOREIGN_KEY_CHECKS


create table if not exists vehicle_goods(
	goodId int unsigned not null auto_increment,
	goodName varchar(32) not null,
	goodNum int unsigned not null,
	goodTrueNum int unsigned not null,
	goodState int not null,
	addTime varchar(32) default '0',
	primary key(goodId)
)engine=innodb;


alter table vehicle_goods change goodState goodSales int not null default 0;
alter table vehicle_goods add goodState int default 0;

drop table if exists vehicle_goods;

insert into vehicle_goods values(null,'黄豆',100,50,1);

//更新车
create table if not exists vehicle_car(
		carId int unsigned not null auto_increment,
		carLicense varchar(32) not null,
		contract int not null default '123',
		carState int(2) not null default 1,
		delState int(2) default 1,
		primary key(carId)
)engine=innodb;

alter table vehicle_car change contract contract varchar(32)

drop table if exists vehicle_car;

//司机信息
create table if not exists vehicle_drivers(
		driverId int unsigned not null auto_increment,
		driverImg varchar(32),
		driverName varchar(32) not null,
		driverPhone int unsigned not null,
		driverPwd varchar(32) default '123',
		applyDate varchar(32),
		driverState int not null default 0,
		delState int(2) default 1,
		primary key(driverId)
)engine=innodb;



drop table if exists vehicle_drivers;

alter table vehicle_drivers  int not null default 0;


//更新订单表
create table if not exists vehicle_order(
		orderId int unsigned not null,
		goodId int unsigned not null,
		carId int unsigned not null,
		driverId int unsigned,
		orderNum int unsigned default '0',
		orderTiNum int unsigned default '0',
		createTime varchar(32) default '0',
		beginTime varchar(32) default '0',
		lastTime varchar(32) default '0',
		destination varchar(32) not null,
		goodCount int unsigned not null,
		goodTrueCount int unsigned not null default '0',
		orderState int not null default 0,
		delState int(2) default 1,
		primary key(orderId),
		foreign key(goodId)references vehicle_goods(goodId),
		foreign key(carId)references vehicle_car(carId)
)engine=innodb;



统计一个表里面不同字段的出现的字数
select orderDriver,sum(case orderState when "0" then 1 else 0 end) orderF,
									sum(case orderState when "1" then 1 else 0 end) orderS,
									sum(case orderState when "2" then 1 else 0 end) orderT
									from vehicle_order where orderDriver = "大大";

create view view_c2
as
select orderId,driverId,sum(case when orderState>0 then 1 else 0 end) orderF,
								sum(case orderState when '2' then 1 else 0 end) orderS,
								sum(goodCount),delState
								from vehicle_order where existState = 1 group by driverId

drop view view_c2


select a.count(*),b.sum(goodTrueCount) from vehicle_order as a,vehicle_order as b where a.



select orderDriver ,sum(case orderState when "2")


alter table vehicle_order add numId int unsigned default 123;

alter table vehicle_order change 
alter table vehicle_order add createTime varchar(32) default '0';
alter table vehicle_order change beginTime beginTime varchar(32) default '0';
alter table vehicle_order change lastTime lastTime varchar(32) default '0';
alter table vehicle_order change orderDriver orderDriver varchar(32) default '老马';
alter table vehicle_order add destination varchar(32) not null;
alter table vehicle_order add orderDriver varchar(32);


drop table if exists vehicle_order;

alter table vehicle_order modify orderId int unsigned not null;

alter table vehicle_order add existState int(2) default 1;


create table if not exists vehicle_log(
	logid int unsigned not null auto_increment,
	userName varchar(32),
	roleName varchar(32) default '游客',
	Activity varchar(32) default '喝茶',
	ActivetyD varchar(60) default '广东省惠州市',
	ActivityTime varchar(32) default '2019',
	ActivetyState int(2) default '1',
	logIp varchar(32) default '0',
	primary key(logid)
)engine=innodb;




alter table vehicle_log add delState int default 1;
drop table if exists vehicle_log;

create table if not exists vehicle_logs(
	logsId int unsigned not null auto_increment,
	userId int unsigned not null,
	userActivity varchar(32),
	primary key(logsId),
	foreign key(userId)references vehicle_user(userId)
)engine=innodb;

create table if not exists vehicle_logss(
	logsId int unsigned not null auto_increment,
	userName varchar(32),
	roleName varchar(32),
	activity varchar(32),
	activityTime varchar(32),
	loginIP varchar(10),
	primary key(logsId)
)engine=innodb;

create table if not exists vehicle_log(
	logsId int unsigned not null auto_increment,
	driverName varchar(32),
	activity varchar(32),
	activityTime varchar(32),
	loginIP varchar(10),
	primary key(logsId)
)engine=innodb;



alter table vehicle_logs add ActivityTime varchar(32);

drop table if exists vehicle_logs;


create view view_logs
as
select a.userId,userName,roleName,trueName,userActivity,ActivityTime,loginIp,loginState,loginTime from vehicle_logs as a,vehicle_user as b,vehicle_role as c where b.userId = a.userId and b.roleId = c.roleId;


drop view if exists view_logs;



create view view_orderu
as 
select  orderId,orderNum,orderTiNum,contract,carLicense,goodCount,createTime,beginTime,orderState,b.delState
from vehicle_car as a,vehicle_order as b,vehicle_goods as c where a.carId = b.carId and b.goodId = c.goodId 


group by orderId 



drop view view_order

create view view_orderS
as
select orderId,orderNum,carLicense,destination,goodName,goodTrueCount,beginTime,orderState,b.delState
from vehicle_car as a,vehicle_order as b,vehicle_goods as c where a.carId = b.carId and b.goodId = c.goodId order by createTime desc


select * from vehicle_drivers as a,vehicle_goods as b,vehicle_car as c,vehicle_order as d where a.driverId = d.driverId and b.goodId = d.goodId and d.carId and c.carId;



create view view_user 
as
	select userId,userName,userImg,roleName,loginTimes,loginIp,loginTime,trueName,loginState,b.delState 
	from vehicle_role as a,vehicle_user as b where a.roleId = b.roleId and a.delState = 1 and b.delState = 1  and a.roleState = 1; 
 
  drop view if exists view_user; 
 
 update vehicle_user set loginTime='20192229' where userId = 1;
 
 
 
 
 
 
create view view_role 
as
	select roleId,roleName,roleState from vehicle_root as a,vehicle_role as b where a.rootId = b.rootId;
	
create view view_ordert
as
	select orderId,carLicense,destination,goodName,goodCount,createTime,beginTime,lastTime,orderDriver,orderState,a.delState,numId from vehicle_order as a,vehicle_car b,vehicle_goods c where  a.goodId = c.goodId and a.carId = b.carId and c.goodTrueNum <= c.goodNum order by createTime desc;
	

drop view if exists view_order;



create view view_log
as
select a.driverId,driverName,loginActivity,ActivityTime,loginTime,loginIp,driverState from vehicle_drivers as a,vehicle_log as
b where a.driverId = b.driverId;

drop view if exists view_log; 

create 



update vehicle_drivers set driverPwd = 123 where driverId = 1



create procedure order_good(in $num int)
begin
	update vehicle_goods set goodState = 0 where $num = 0,;
end;



//优良版
create view view_ordert
as
select orderId,orderNum,orderTiNum,goodCount,goodTrueCount,createTime,beginTime,lastTime,a.carId,contract,carLicense,a.goodId,goodName,goodNum,goodTrueNum,destination,orderState,driverId 
from vehicle_order as a,vehicle_car as b,vehicle_goods as c where a.carId = b.carId and a.goodId = c.goodId and carState = 1 and c.delState = 1 and goodState = 1 and
c.delState = 1 and existState = 1 and a.delState = 1;

drop view view_ordert
call order_good(0);

 
