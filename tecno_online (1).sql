-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2018 at 12:14 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tecno_online`
--
CREATE DATABASE IF NOT EXISTS `tecno_online` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `tecno_online`;

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `additemtocart` (IN `cun` VARCHAR(52), IN `pid` INT, IN `qnt` INT)  begin
set @cid=(select id from users where user_name=cun);
if(@cid is null) 
then 
set @cid=cun;
end if;

IF( exists(select * from vendor_intialcart where client_id=@cid and item_id=pid))
Then
set @oqnt=(select quantity from vendor_intialcart where client_id=@cid and item_id=pid);
update vendor_intialcart set quantity=@oqnt+qnt where client_id=@cid and item_id=pid ;
ElSE 
insert into vendor_intialcart values(@cid,pid,qnt);
END IF;

End$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `adduser` (IN `un` VARCHAR(50), IN `pw` VARCHAR(50), IN `mob` VARCHAR(50), IN `fname` VARCHAR(50), IN `adress` VARCHAR(250))  begin
 insert into users(user_name, password, full_name, mobile, role, adress)
 values(un,pw,fname,mob,'user',adress);

end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `cartminus` (IN `cun` VARCHAR(52), IN `pid` INT)  begin
set @cid=(select id from users where user_name=cun);
if(@cid is null) 
then 
set @cid=cun;
end if;
set @maxqnt=(select quantity from products where product_id=pid);
set @curqnt=(select quantity  from vendor_intialcart where client_id=@cid and item_id=pid);
IF( @curqnt>1)
Then
update vendor_intialcart set quantity=@curqnt-1 where client_id=@cid and item_id=pid ;

elseif(@curqnt=1)
then
delete from vendor_intialcart where client_id=@cid and item_id=pid ; 

END IF;

End$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `cartplus` (IN `cun` VARCHAR(52), IN `pid` INT)  begin
set @cid=(select id from users where user_name=cun);
if(@cid is null) 
then 
set @cid=cun;
end if;
set @maxqnt=(select quantity from products where product_id=pid);
set @curqnt=(select quantity  from vendor_intialcart where client_id=@cid and item_id=pid);
IF( @curqnt<@maxqnt)
Then
update vendor_intialcart set quantity=@curqnt+1 where client_id=@cid and item_id=pid ;

END IF;

End$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `dispatch_order` (IN `cid` INT, IN `vun` VARCHAR(52))  begin

	set @vid=(select id from users where user_name=vun);
	update vendor_cart 
    set dispatched=1
    where cart_id=cid and vendor_id=@vid;
    
	select p.product_name,cd.quantity,p.price,cd.quantity*p.price tprice
    from  cart_details cd join products p on(cd.item_id=product_id)
    where cd.cart_id=cid and p.vendor_id=@vid;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `dispatch_order2` (IN `cid` INT, IN `vun` VARCHAR(52))  begin

	set @vid=(select id from users where user_name=vun);
	
    
	select p.product_name,cd.quantity,p.price,cd.quantity*p.price tprice
    from  cart_details cd join products p on(cd.item_id=product_id)
    where cd.cart_id=cid and p.vendor_id=@vid;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `edit_product` (IN `pid` INT, IN `pric` DECIMAL(8,2), IN `quant` INT)  begin
	update products 
	set price=pric,quantity=quant
    where product_id=pid;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getItemsReport` ()  begin

select p.product_name,u.full_name ,SUM(c.quantity) as sm


from users as u
inner join products as p
on (u.id=p.vendor_id)

inner join cart_details as c
on (c.item_id=p.product_id)
where u.role='vendor'

group by u.full_name,p.product_name 
order by sm desc ; 

end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getOrdersbydate` (IN `un` VARCHAR(52), IN `dt` DATE)  begin
set @uid=(select id from users where user_name=un);

select distinct c.cart_id,u.full_name,c.cart_date,u.adress,v.full_name
from carts c join cart_details cd on(c.cart_id=cd.cart_id)
join users u on(c.client_id=u.id)
join vendor_cart vc on (vc.cart_id=c.cart_id)
join users v on(vc.vendor_id=v.id)
where vc.vendor_id=@uid and cast(c.cart_date as date) = dt;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getVendorsReport` ()  begin

select u.full_name ,u.user_name,SUM(c.quantity*p.price) as nn


from users as u

inner join products as p
on (u.id=p.vendor_id)

inner join cart_details as c
on (c.item_id=p.product_id)

where u.role='vendor'

group by u.full_name ,u.user_name
order by nn desc ; 

end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `new_prodimg` (IN `pid` INT, IN `imgname` VARCHAR(255))  begin
	insert into product_images (product_id,img)
	values (pid,imgname);
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `new_product` (IN `pname` VARCHAR(50), IN `cid` INT, IN `bid` INT, IN `quant` INT, IN `vid` INT, IN `price` DECIMAL(8,2), IN `pdesc` VARCHAR(255))  begin
 insert into products(product_name, cat_id, brand_id, quantity, vendor_id, price, product_desc, product_status)
 values(pname,cid,bid,quant,vid,price,pdesc,'pendding');

end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `rate_product` (IN `pid` INT, IN `un` VARCHAR(50), IN `rate` INT, IN `msg` VARCHAR(250))  begin

   set @uid=(select id from users where user_name=un);
   insert into product_rating (product_id, user_id, rating, message)
   values (pid,@uid,rate,msg);



end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `rate_vendor` (IN `vid` INT, IN `un` VARCHAR(50), IN `rate` INT, IN `msg` VARCHAR(250))  begin
   set @uid=(select id from users where user_name=un);
   insert into vendor_rating (vendor_id, user_id, rating, message)
   values (vid,@uid,rate,msg);
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `removeitemfromcart` (IN `cun` VARCHAR(52), IN `pid` INT)  begin
set @cid=(select id from users where user_name=cun);
if(@cid is null) 
then 
set @cid=cun;
end if;


delete from vendor_intialcart where client_id=@cid and item_id=pid ; 


End$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `submit_cart` (IN `cun` VARCHAR(52))  begin

set @cid=(select cast(id as char(50)) from users where user_name=cun);
IF(exists(select * from vendor_intialcart where client_id=@cid))
Then
insert into carts (client_id, cart_date) value(@cid,now());
set @cartid=(select last_insert_id());
insert into vendor_cart(vendor_id,cart_id,dispatched) select  distinct p.vendor_id ,@cartid,0 from vendor_intialcart vc join products p on (vc.item_id=p.product_id) where vc.client_id=@cid;
insert into cart_details (cart_id, item_id, quantity) select @cartid,item_id,quantity from vendor_intialcart where client_id=@cid;
delete from vendor_intialcart where client_id=@cid;
End if;


end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `user_info` (IN `username` VARCHAR(50))  BEGIN
select full_name ,role,img from users 
where user_name =username;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `view_brandscat` (IN `cid` INT)  begin
select distinct b.brand_id,b.brand_name
from brands b join products p on(b.brand_id=p.brand_id)
join categories c on(p.cat_id=c.cat_id)
where p.product_status='accepted' and c.cat_id=cid;

end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `view_intialcart` (IN `cid` VARCHAR(52))  begin

set @cid=(select id from users where user_name=cid);
if(@cid is null) 
then 
set @cid=cid;
end if;

	select p.product_id,p.product_name,p.quantity,p.price,c.quantity,p.price*c.quantity totalprice
	from vendor_intialcart c join products p on(c.item_id=p.product_id)
	where @cid=c.client_id;

end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `view_orders` (IN `un` VARCHAR(52))  begin

set @uid=(select id from users where user_name=un);

select distinct c.cart_id,u.full_name,c.cart_date,u.adress
from carts c join cart_details cd on(c.cart_id=cd.cart_id)
join users u on(c.client_id=u.id)
join vendor_cart vc on (vc.cart_id=c.cart_id)
where vc.vendor_id=@uid and vc.dispatched=0;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `view_product` (IN `id` INT)  begin 

select p.product_id,p.product_name,p.price,p.quantity,p.product_desc,ifnull(round(avg(r.rating),1),0),v.id,v.full_name
from products p join product_rating r on(p.product_id=r.product_id)
join users v on(p.vendor_id=v.id)
where p.product_id=id;

end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `view_productrating` (IN `pid` INT)  begin
select r.rating,r.message,u.full_name
from product_rating r join users u on(r.user_id=u.id)
where r.product_id=pid;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `view_products` (IN `un` VARCHAR(52))  begin
	select p.product_id,p.product_name, p.quantity, p.product_desc,c.cat_name,b.brand_name
	from products p join categories c on(p.cat_id=c.cat_id)
	join brands b on (p.brand_id=b.brand_id)
	join users ven on(p.vendor_id=ven.id)
	where ven.user_name=un and p.product_status !='refuced';
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `view_vendorrating` (IN `vid` INT)  begin
select r.rating,r.message,u.full_name
from vendor_rating r join users u on(r.user_id=u.id)
where r.vendor_id=vid;
end$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `check_admin` (`un` VARCHAR(52), `pw` VARCHAR(52)) RETURNS INT(11) BEGIN
    RETURN EXISTS (SELECT user_name FROM users WHERE un = user_name AND pw = users.password and role  like 'admin');
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `check_user` (`un` VARCHAR(52), `pw` VARCHAR(52)) RETURNS INT(11) BEGIN
    RETURN EXISTS (SELECT user_name FROM users WHERE un = user_name AND pw = users.password and role  like 'user');
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `check_vendor` (`un` VARCHAR(52), `pw` VARCHAR(52)) RETURNS INT(11) BEGIN
    RETURN EXISTS (SELECT user_name FROM users WHERE un = user_name AND pw = users.password and role  like 'vendor');
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_name`) VALUES
(1, 'ØªÙˆØ´ÙŠØ¨Ø§'),
(2, 'Ù„ÙŠÙ†ÙˆÙÙˆ'),
(3, 'Ø¯ÙŠÙ„'),
(4, 'Ø³Ø§Ù…Ø³ÙˆÙ†Ø¬'),
(5, 'Ø§Ø¨Ù„'),
(6, 'Ø§Ù… Ø§Ø³ Ø§ÙŠ'),
(7, 'Ø§Ø³ÙˆØ³'),
(8, 'Ø§ÙŠØ³Ø±'),
(9, 'Ù…Ø§ÙŠÙƒØ±ÙˆØ³ÙˆÙØª'),
(10, 'Ø§ØªØ´ Ø¨ÙŠ');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `cart_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `cart_date` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`cart_id`, `client_id`, `cart_date`) VALUES
(1, 8, '2018-04-01 15:15:33'),
(2, 8, '2018-04-01 15:19:27'),
(3, 8, '2018-04-01 16:00:11'),
(4, 8, '2018-04-01 19:09:13'),
(5, 8, '2018-04-01 19:13:08'),
(6, 8, '2018-04-01 19:19:08'),
(7, 8, '2018-04-01 20:19:33'),
(8, 8, '2018-04-01 21:57:23'),
(9, 8, '2018-04-02 03:23:01'),
(10, 8, '2018-04-02 16:46:33'),
(11, 8, '2018-04-02 17:43:14'),
(12, 8, '2018-04-03 19:41:14'),
(13, 8, '2018-04-04 03:44:00'),
(14, 8, '2018-04-04 03:45:36'),
(15, 8, '2018-04-04 04:09:00'),
(16, 8, '2018-04-04 04:09:58'),
(17, 8, '2018-04-07 14:40:30'),
(18, 8, '2018-04-07 14:41:50'),
(19, 8, '2018-04-07 16:29:26'),
(20, 8, '2018-04-07 16:42:41');

-- --------------------------------------------------------

--
-- Table structure for table `cart_details`
--

CREATE TABLE `cart_details` (
  `cart_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cart_details`
--

INSERT INTO `cart_details` (`cart_id`, `item_id`, `quantity`) VALUES
(2, 2, 7),
(2, 3, 1),
(3, 2, 7),
(3, 3, 2),
(5, 2, 4),
(5, 4, 3),
(7, 3, 1),
(8, 3, 2),
(8, 4, 1),
(9, 2, 2),
(9, 3, 2),
(10, 4, 1),
(10, 5, 1),
(11, 3, 1),
(12, 3, 2),
(12, 6, 2),
(13, 5, 1),
(13, 10, 3),
(14, 6, 1),
(14, 7, 1),
(15, 11, 2),
(16, 3, 1),
(16, 5, 1),
(16, 6, 1),
(18, 7, 1),
(18, 9, 1),
(19, 8, 1),
(19, 9, 1),
(20, 7, 1),
(20, 10, 1);

--
-- Triggers `cart_details`
--
DELIMITER $$
CREATE TRIGGER `updateQuantity` AFTER INSERT ON `cart_details` FOR EACH ROW begin

update products set quantity=quantity-new.quantity where product_id=new.item_id ;


end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_name`) VALUES
(1, 'ÙƒÙ…Ø¨ÙŠÙˆØªØ± Ù…Ø­Ù…ÙˆÙ„'),
(2, 'ÙƒÙ…Ø¨ÙŠÙˆØªØ± Ù…ÙƒØªØ¨ÙŠ'),
(3, 'ÙƒÙ…Ø¨ÙŠÙˆØªØ± Ù„ÙˆØ­ÙŠ'),
(4, 'Ù…Ø³ØªÙ„Ø²Ù…Ø§Øª Ø§Ù„Ø­Ø§Ø³Ø¨'),
(5, 'Ù…Ù„Ø­Ù‚Ø§Øª'),
(6, 'Ø·Ø§Ø¨Ø¹Ø§Øª');

-- --------------------------------------------------------

--
-- Stand-in structure for view `pendding_items`
-- (See below for the actual view)
--
CREATE TABLE `pendding_items` (
`product_id` int(11)
,`product_name` varchar(50)
,`price` decimal(8,2)
,`concat(c.cat_name,'--',s.brand_name)` varchar(307)
);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(50) DEFAULT NULL,
  `cat_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `price` decimal(8,2) DEFAULT NULL,
  `product_desc` varchar(255) DEFAULT NULL,
  `product_status` enum('pendding','accepted','refuced') DEFAULT 'pendding'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `cat_id`, `brand_id`, `quantity`, `vendor_id`, `price`, `product_desc`, `product_status`) VALUES
(1, 'ØªÙˆØ´ÙŠØ¨Ø§ Ù„50', 2, 1, 12, 3, '25000.00', 'ØŒÙƒÙ…Ø¨ÙŠÙˆØªØ± Ù…ÙƒØªØ¨ÙŠ Ø¨Ù…Ø¹Ø§Ù„Ø¬ Ø«Ù†Ø§Ø¦ÙŠ Ø§Ù„Ù†ÙˆØ§Ø© ØŒØ§Ù†ØªÙ„ ÙƒÙˆØ± i3-7100 ØŒ(Ø§Ù†ÙÙŠØ¯ÙŠØ§ Ø¬ÙŠÙÙˆØ±Ø³ 730 (2 Ø¬ÙŠØ¬Ø§Ø¨Ø§ÙŠØª ØŒ4 Ø¬ÙŠØ¬Ø§Ø¨Ø§ÙŠØª Ø±Ø§Ù…', 'refuced'),
(2, 'ØªÙˆØ´ÙŠØ¨Ø§ Ù„50 ', 2, 2, 6, 3, '2333.00', 'ØŒÙƒÙ…Ø¨ÙŠÙˆØªØ± Ù…ÙƒØªØ¨ÙŠ Ø¨Ù…Ø¹Ø§Ù„Ø¬ Ø«Ù†Ø§Ø¦ÙŠ Ø§Ù„Ù†ÙˆØ§Ø© ØŒØ§Ù†ØªÙ„ ÙƒÙˆØ± i3-7100 ØŒ(Ø§Ù†ÙÙŠØ¯ÙŠØ§ Ø¬ÙŠÙÙˆØ±Ø³ 730 (2 Ø¬ÙŠØ¬Ø§Ø¨Ø§ÙŠØª ØŒ4 Ø¬ÙŠØ¬Ø§Ø¨Ø§ÙŠØª Ø±Ø§Ù…', 'refuced'),
(3, 'Ø¯ÙŠÙ„ ØŒØ§Ù†Ø³Ø¨Ø§ÙŠØ±ÙˆÙ† Ø¯ÙŠØ³ÙƒØªÙˆØ¨ 3668', 2, 3, 1, 9, '2000.00', 'ØŒÙƒÙ…Ø¨ÙŠÙˆØªØ± Ù…ÙƒØªØ¨ÙŠ Ø¨Ù…Ø¹Ø§Ù„Ø¬ Ø«Ù†Ø§Ø¦ÙŠ Ø§Ù„Ù†ÙˆØ§Ø© ØŒØ§Ù†ØªÙ„ ÙƒÙˆØ± i3-7100 ØŒ(Ø§Ù†ÙÙŠØ¯ÙŠØ§ Ø¬ÙŠÙÙˆØ±Ø³ 730 (2 Ø¬ÙŠØ¬Ø§Ø¨Ø§ÙŠØª ØŒ4 Ø¬ÙŠØ¬Ø§Ø¨Ø§ÙŠØª Ø±Ø§Ù…', 'accepted'),
(4, 'Ù„ÙŠÙ†ÙˆÙÙˆ ØŒØ¢ÙŠØ¯ÙŠØ§ Ø¨Ø§Ø¯ 520-15IKBR', 1, 2, 0, 3, '2700.00', 'ÙƒÙ…Ø¨ÙŠÙˆØªØ± Ù…Ø­Ù…ÙˆÙ„ ØŒ15.6 Ø¨ÙˆØµØ© ØŒØ§Ù†ØªÙ„ ÙƒÙˆØ± i5-8250U ØŒØ±Ù…Ø§Ø¯ÙŠ Ø­Ø¯ÙŠØ¯ÙŠ ØŒØ§Ù†ÙÙŠØ¯ÙŠØ§ Ø¬ÙŠ ÙÙˆØ±Ø³ Ø§Ù… Ø§ÙƒØ³ 150 Ø¨Ø³Ø¹Ø© 4 Ø¬ÙŠØ¬Ø§Ø¨Ø§ÙŠØª', 'accepted'),
(5, 'Ù…Ø§ÙŠÙƒØ±ÙˆØ³ÙˆÙØª ØŒØ³ÙŠØ±ÙØ³ Ø¨Ø±Ùˆ ', 3, 9, 6, 9, '7700.00', 'Ù„Ø§Ø¨ØªÙˆØ¨ 2 ÙÙŠ 1 Ù…Ù†ÙØµÙ„ ØŒi7-7660U Ø§Ù†ØªÙ„ ÙƒÙˆØ± ØŒØªØµÙ…ÙŠÙ… Ø¬Ù‡Ø§Ø² Ù„ÙˆØ­ÙŠ ØŒ16 Ø¬ÙŠØ¬Ø§Ø¨Ø§ÙŠØª Ø±Ø§Ù… ØŒ512 Ø¬ÙŠØ¬Ø§Ø¨Ø§ÙŠØª Ø§Ø³ Ø§Ø³ Ø¯ÙŠ ØŒ12.3 Ø¨ÙˆØµØ© ØŒÙˆÙŠÙ†Ø¯ÙˆØ² 10 Ø¨Ø±Ùˆ', 'accepted'),
(6, 'ØªÙˆØ´ÙŠØ¨Ø§ ØŒÙƒØ§Ù†ÙÙŠÙˆ Ø¨Ø±ÙŠÙ…ÙŠÙˆÙ…', 4, 1, 1, 3, '300.00', 'Ù‚Ø±Øµ ØµÙ„Ø¨ Ù…ØªÙ†Ù‚Ù„ ØŒØ³Ø¹Ø© 1 ØªÙŠØ±Ø§Ø¨Ø§ÙŠØª ØŒØ±Ù…Ø§Ø¯ÙŠ', 'accepted'),
(7, 'Ø§ÙŠØ³Ø± ØŒ Ø§ÙƒØ³ 117 Ø§ØªØ´', 5, 8, 0, 3, '1700.00', 'Ø¨Ø±ÙˆØ¬ÙƒØªØ± ÙˆØ³Ø§Ø¦Ø· Ù…ØªØ¹Ø¯Ø¯Ø© ØŒØ¯ÙŠ Ø§Ù„ Ø¨ÙŠ ØŒ3600 Ù„ÙˆÙ…Ù†', 'accepted'),
(8, 'ØªÙˆØ´ÙŠØ¨Ø§ ØŒÙƒØ§Ù†ÙÙŠÙˆ Ø¨Ø±ÙŠÙ…ÙŠÙˆÙ…', 4, 1, 9, 9, '400.00', 'Ù‚Ø±Øµ ØµÙ„Ø¨ Ù…ØªÙ†Ù‚Ù„ ØŒØ³Ø¹Ø© 2 ØªÙŠØ±Ø§Ø¨Ø§ÙŠØª ØŒØ±Ù…Ø§Ø¯ÙŠ', 'accepted'),
(9, 'Ø§ØªØ´ Ø¨ÙŠ ØŒØ£ÙˆÙÙŠØ³ Ø¬ÙŠØª Ø¨Ø±Ùˆ 8715', 6, 10, 10, 9, '800.00', 'Ù…Ø³Ø­ Ø¶ÙˆØ¦ÙŠ/Ø·Ø§Ø¨Ø¹Ø© Ù…ØªØ¹Ø¯Ø¯Ø© Ø§Ù„ÙˆØ¸Ø§Ø¦Ù Ù†Ø³Ø®/ÙØ§ÙƒØ³ /Ø·Ø¨Ø§Ø¹Ø© ØŒÙˆØ§ÙŠ ÙØ§ÙŠ ØŒØ·Ø¨Ø§Ø¹Ø© Ø­Ø±Ø§Ø±ÙŠØ© Ù†Ø§ÙØ«Ø© Ù„Ù„Ø­Ø¨Ø±', 'accepted'),
(10, 'Ø§ØªØ´ Ø¨ÙŠ ØŒ15-bs103nx', 1, 10, 1, 3, '2700.00', 'ÙƒÙ…Ø¨ÙŠÙˆØªØ± Ù…Ø­Ù…ÙˆÙ„ ØŒ15.6 Ø¨ÙˆØµØ© ØŒØ§Ù†ØªÙ„ ÙƒÙˆØ± i7-8550U ØŒÙØ¶ÙŠ ØŒØ§ÙŠÙ‡ Ø§Ù… Ø¯ÙŠ Ø±Ø§Ø¯ÙŠÙˆÙ† 530 Ø¨Ø³Ø¹Ø© 4 Ø¬ÙŠØ¬Ø§Ø¨Ø§ÙŠØª', 'accepted'),
(11, 'Ø§ØªØ´ Ø¨ÙŠ ØŒ Ø¨ÙŠ Ø§ÙŠÙ‡ 005 Ø§Ù† Ø§ÙƒØ³', 1, 10, 4, 3, '4800.00', 'ØŒÙ„Ø§Ø¨ØªÙˆØ¨ 2 ÙÙŠ 1 Ù…ØªØ­ÙˆÙ„ ØŒ7200 ÙŠÙˆ - Ø§Ù†ØªÙ„ ÙƒÙˆØ± Ø¢ÙŠ 5 ØŒØªØµÙ…ÙŠÙ… Ø¨Ø´ÙƒÙ„ Ù…Ù„Ù ØŒ8 Ø¬ÙŠØ¬Ø§Ø¨Ø§ÙŠØª Ø±Ø§Ù… ØŒ256 Ø¬ÙŠØ¬Ø§Ø¨Ø§ÙŠØª Ø§Ù….2 Ø§Ø³ Ø§Ø³ Ø¯ÙŠ', 'accepted');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `img_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `img` varchar(255) DEFAULT 'img.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`img_id`, `product_id`, `img`) VALUES
(5, 1, '../images/product/220180325112111.jpg'),
(6, 1, '../images/product/120180325112111.jpg'),
(7, 2, '../images/product/120180325112111.jpg'),
(8, 3, '../images/product/120180325112111.jpg'),
(9, 3, '../images/product/220180325112111.jpg'),
(10, 4, '../images/product/120180328114122.jpg'),
(11, 4, '../images/product/220180328114122.jpg'),
(12, 4, '../images/product/320180328114122.jpg'),
(17, 5, '../images/product/120180402015902.jpg'),
(18, 6, '../images/product/120180402015409.jpg'),
(19, 6, '../images/product/220180402015409.jpg'),
(20, 7, '../images/product/120180402015703.jpg'),
(21, 7, '../images/product/220180402015703.jpg'),
(22, 7, '../images/product/320180402015703.jpg'),
(23, 8, '../images/product/120180402015834.jpg'),
(24, 8, '../images/product/220180402015834.jpg'),
(25, 9, '../images/product/120180402020438.jpg'),
(26, 9, '../images/product/220180402020439.jpg'),
(27, 9, '../images/product/320180402020439.jpg'),
(28, 10, '../images/product/120180404014233.jpg'),
(29, 11, '../images/product/120180404020726.jpg'),
(30, 11, '../images/product/220180404020726.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product_rating`
--

CREATE TABLE `product_rating` (
  `rate_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` smallint(6) DEFAULT NULL,
  `message` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_rating`
--

INSERT INTO `product_rating` (`rate_id`, `product_id`, `user_id`, `rating`, `message`) VALUES
(1, 2, 8, 3, 'Ø¬ÙŠØ¯ Ø¬Ø¯Ø§'),
(2, 4, 8, 4, 'Ø¬Ù‡Ø§Ø² Ù…Ù…ØªØ§Ø²'),
(3, 10, 8, 5, 'Ø¬Ù‡Ø§Ø² Ø±Ø§Ø¦Ø¹'),
(4, 10, 8, 3, 'Ù„ÙŠØ³ Ø³Ø¦');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `role` enum('user','admin','vendor','delivery') DEFAULT 'user',
  `adress` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `password`, `full_name`, `mobile`, `role`, `adress`, `img`) VALUES
(2, 'afra7', '123', 'Ø§ÙØ±Ø§Ø­', '0123456789', 'admin', 'Ù†Ø§Ù†Ø§Ù†ØªØ§Ù†ØªÙ‰Øª', '../images/users/afra720180307075125.jpg'),
(3, 'jarir', '123', 'Ø±ÙŠÙ‡Ø§Ù…', '123456789', 'vendor', 'Ø­ÙØ± Ø§Ù„Ø¨Ø§Ø·Ù† , Ø­ÙŠ Ø§Ù„Ù…Ø­Ù…Ø¯ÙŠØ© Ø¨Ø¬Ø§Ù†Ø¨ Ø¯ÙˆØ§Ø± Ø§Ù„Ù…Ø­Ù…Ø¯ÙŠØ© Ø´Ø§Ø±Ø¹ Ø§Ù„Ù…Ù„Ùƒ ÙÙŠØµÙ„', '../images/users/jarir.png'),
(8, 'Aliaa', '123', 'Ø¹Ù„ÙŠØ§Ø¡', '01201636482', 'user', 'Ø­ÙØ± Ø§Ù„Ø¨Ø§Ø·Ù†', NULL),
(9, 'ebtsam', '123', 'Ø¹Ù„ÙŠØ§Ø¡', '022121212', 'vendor', 'Ø¹Ù„ÙŠØ§Ø¡ Ø¹Ù„ÙŠØ§Ø¡', '../images/users/afra720180307075125.jpg'),
(10, 'extra', '123', 'Ø§ÙƒØ³ØªØ±Ø§', '920004123', 'vendor', 'Ø­ÙØ± Ø§Ù„Ø¨Ø§Ø·Ù† , Ø­ÙŠ Ø§Ù„Ù…Ø­Ù…Ø¯ÙŠØ© Ø¨Ø¬Ø§Ù†Ø¨ Ø¯ÙˆØ§Ø± Ø§Ù„Ù…Ø­Ù…Ø¯ÙŠØ© Ø´Ø§Ø±Ø¹ Ø§Ù„Ù…Ù„Ùƒ ÙÙŠØµÙ„', '../images/users/extra20180402075527.png'),
(11, 'reham', '123', 'Ø±ÙŠÙ‡Ø§Ù… Ù…Ø¶Ø­ÙŠ ØºØ±ÙŠØ¨', '0558967425', 'admin', 'Ø·Ø±ÙŠÙ‚ Ø§Ù„Ù…Ù„Ùƒ Ø¹Ø¨Ø¯Ø§Ù„Ø¹Ø²ÙŠØ²ØŒ Ø§Ø¨Ùˆ Ù…ÙˆØ³Ù‰ Ø§Ù„Ø§Ø´Ø¹Ø±ÙŠØŒ Ø­ÙØ± Ø§Ù„Ø¨Ø§Ø·Ù† 39923ØŒ Ø§Ù„Ø³Ø¹ÙˆØ¯ÙŠØ©', '../images/users/reham20180403013452.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_cart`
--

CREATE TABLE `vendor_cart` (
  `vendor_id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `dispatched` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vendor_cart`
--

INSERT INTO `vendor_cart` (`vendor_id`, `cart_id`, `dispatched`) VALUES
(3, 2, b'1'),
(3, 9, b'1'),
(9, 9, b'1'),
(3, 10, b'1'),
(9, 10, b'0'),
(9, 11, b'1'),
(3, 12, b'1'),
(9, 12, b'1'),
(3, 13, b'1'),
(9, 13, b'1'),
(3, 14, b'1'),
(3, 15, b'1'),
(3, 16, b'1'),
(9, 16, b'1'),
(3, 18, b'1'),
(9, 18, b'0'),
(9, 19, b'0'),
(3, 20, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_intialcart`
--

CREATE TABLE `vendor_intialcart` (
  `client_id` varchar(55) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vendor_intialcart`
--

INSERT INTO `vendor_intialcart` (`client_id`, `item_id`, `quantity`) VALUES
('2v8lmt48r3iv7oece8oqpoipk7', 3, 1),
('ll55madb8t7gkqsmrfdb8m4r61', 5, 2),
('ll55madb8t7gkqsmrfdb8m4r61', 7, 1),
('ll55madb8t7gkqsmrfdb8m4r61', 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `vendor_rating`
--

CREATE TABLE `vendor_rating` (
  `rate_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` smallint(6) DEFAULT NULL,
  `message` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vendor_rating`
--

INSERT INTO `vendor_rating` (`rate_id`, `vendor_id`, `user_id`, `rating`, `message`) VALUES
(1, 9, 8, 4, 'ØªØ§Ø¬Ø± Ù…Ø­ØªØ±Ù…'),
(2, 3, 8, 4, 'ØªØ§Ø¬Ø± Ù…Ù…ØªØ§Ø² '),
(3, 9, 8, 3, 'ØªØ§Ø¬Ø± Ù…Ù…ØªØ§Ø²');

-- --------------------------------------------------------

--
-- Structure for view `pendding_items`
--
DROP TABLE IF EXISTS `pendding_items`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pendding_items`  AS  select `p`.`product_id` AS `product_id`,`p`.`product_name` AS `product_name`,`p`.`price` AS `price`,concat(`c`.`cat_name`,'--',`s`.`brand_name`) AS `concat(c.cat_name,'--',s.brand_name)` from ((`products` `p` join `brands` `s` on((`p`.`brand_id` = `s`.`brand_id`))) join `categories` `c` on((`p`.`cat_id` = `c`.`cat_id`))) where (`p`.`product_status` = 'pendding') ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `cart_details`
--
ALTER TABLE `cart_details`
  ADD PRIMARY KEY (`cart_id`,`item_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `cat_id` (`cat_id`),
  ADD KEY `brand_id` (`brand_id`),
  ADD KEY `vendor_id` (`vendor_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`img_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product_rating`
--
ALTER TABLE `product_rating`
  ADD PRIMARY KEY (`rate_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- Indexes for table `vendor_cart`
--
ALTER TABLE `vendor_cart`
  ADD PRIMARY KEY (`cart_id`,`vendor_id`),
  ADD KEY `vendor_id` (`vendor_id`);

--
-- Indexes for table `vendor_intialcart`
--
ALTER TABLE `vendor_intialcart`
  ADD PRIMARY KEY (`client_id`,`item_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `vendor_rating`
--
ALTER TABLE `vendor_rating`
  ADD PRIMARY KEY (`rate_id`),
  ADD KEY `vendor_id` (`vendor_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `img_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `product_rating`
--
ALTER TABLE `product_rating`
  MODIFY `rate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `vendor_rating`
--
ALTER TABLE `vendor_rating`
  MODIFY `rate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `cart_details`
--
ALTER TABLE `cart_details`
  ADD CONSTRAINT `cart_details_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`cart_id`),
  ADD CONSTRAINT `cart_details_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`cat_id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`brand_id`),
  ADD CONSTRAINT `products_ibfk_3` FOREIGN KEY (`vendor_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `product_rating`
--
ALTER TABLE `product_rating`
  ADD CONSTRAINT `product_rating_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `product_rating_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `vendor_cart`
--
ALTER TABLE `vendor_cart`
  ADD CONSTRAINT `vendor_cart_ibfk_1` FOREIGN KEY (`vendor_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `vendor_cart_ibfk_2` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`cart_id`);

--
-- Constraints for table `vendor_intialcart`
--
ALTER TABLE `vendor_intialcart`
  ADD CONSTRAINT `vendor_intialcart_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `vendor_rating`
--
ALTER TABLE `vendor_rating`
  ADD CONSTRAINT `vendor_rating_ibfk_1` FOREIGN KEY (`vendor_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `vendor_rating_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
