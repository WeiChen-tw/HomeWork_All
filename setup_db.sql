create database DinBenDon default character set utf8;
use DinBenDon;

create table Restaurants
(
  RestaurantID int auto_increment not null primary key ,
  Product varchar(15),
  UnitPrice varchar(30)
);
create table Products
(
  RestaurantID int,--- 單
  ProductsID int auto_increment not null primary key ,
  Item varchar(15),
  UnitPrice int(12)
);
create table Employees
(
  EmployeeID int auto_increment not null primary key ,
  Department varchar(10),
  EmployeeName varchar(10)  
);

create table Orders
(
  OrderID int auto_increment not null primary key ,
  RequiredDate datetime not null,
  ShipDate datetime not null,
  total int(12) not null,
  PaymentStatus varchar(1)   
);
create table OrderDetails
(
  OrderID int,--- 單
  ProductsID varchar(15) not null,
  UnitPrice int(12),
  Quantity int(12)not null
);