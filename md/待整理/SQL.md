# SQL

### 1、count & sum

##### count(*)

- 里面无法使用条件进行判断统计

##### sum()

- 里面可以进行判断统计

- ```sql
  select driverId,sum(case when orderState>0 then 1 else 0 end) orderF,sum(case orderState when '2' then 1 else 0 end) orderS,
  sum(goodCount),delState from vehicle_order where existState = 1 group by driverId
  ```

  - 当sum里面为一个字段等于具体数的时候，具体数就要用双引号括起来
  - 当sum里面为一个条件的时候就不用双引号括起来