USE homework_0807_Wei_Chen;

SELECT IFNULL(o.OrderID,'總計')as OrderID,
IF(ISNULL(o.OrderID),'',(SELECT (employeeID) FROM employees WHERE employeeID = eo.EmployeeID AND eo.OrderID = o.OrderID)) as employeeID, 
IF(ISNULL(o.OrderID),'',(SELECT (Name) FROM employees WHERE employeeID = eo.EmployeeID)) as Name,  
IF(ISNULL(o.OrderID),'',IFNULL(od.productID, '小計')) AS productID,
(CASE WHEN ISNULL(od.productID) THEN '' ELSE (SELECT (Item) FROM products WHERE ProductID = od.ProductID) END) as ProductName,
(CASE WHEN ISNULL(od.productID) THEN '' ELSE (SELECT (UnitPrice) FROM products WHERE ProductID = od.ProductID) END) as UnitPrice,
od.Quantity,
(SUM(UnitPrice*od.Quantity)) as amount
FROM orders as o

INNER JOIN Employees_Orders as eo ON o.OrderID = eo.OrderID
INNER JOIN orderdetails as od ON eo.EOID = od.EOID
GROUP BY o.OrderID,eo.EOID,od.productID
  WITH ROLLUP

