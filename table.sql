create table product(
product_id INT AUTO_INCREMENT PRIMARY KEY,
product_name VARCHAR(255) NOT NULL,
product_desc TEXT,
product_image VARCHAR(255) NOT NULL,
product_price FLOAT NOT NULL
);

create table User (
User_id INT AUTO_INCREMENT PRIMARY KEY,
email_id VARCHAR(255) UNIQUE,
first_name VARCHAR(50),
last_name VARCHAR(50),
password VARCHAR(255),
image_src VARCHAR(255),
is_admin BOOLEAN
);

insert into User(email_id,first_name,last_name,password,image_src,is_admin)
values ('sourav.chandra@innoraft.com','Sourav','Chandra','Hello@123',NULL,1);

insert into product (product_name,product_desc,product_image,product_price)
values ('Samsung Galaxy F15',
'Octa core (2.2 GHz, Dual Core + 2 GHz, Hexa Core)MediaTek Dimensity 6100 Plus4 GB RAM|6.5 inches (16.51 cm)FHD+, Super AMOLED90 Hz Refresh Rate|50 MP + 5 MP + 2 MP Triple Primary CamerasLED Flash13 MP Front Camera|6000 mAhFast ChargingUSB Type-C Port',
'samsung.webp',15500);
insert into product (product_name,product_desc,product_image,product_price)
values ('Apple iPhone 15 Pro Max',
'Hexa Core (3.78 GHz, Dual Core + 2.11 GHz, Quad core)Apple A17 Pro8 GB RAM|6.7 inches (17.02 cm)FHD+, OLED120 Hz Refresh Rate|48 MP + 12 MP + 12 MP Triple Primary CamerasDual-color LED Flash12 MP Front Camera|4422 mAhFast ChargingUSB Type-C Port',
'apple.webp',148900);
insert into product (product_name,product_desc,product_image,product_price)
values ('Google Pixel 8 Pro',
'Nona Core (3 GHz, Single Core + 2.45 GHz, Quad core + 2.15 GHz, Quad core)Google Tensor G3 12 GB RAM|6.7 inches (17.02 cm)FHD+, OLED120 Hz Refresh Rate|50 MP + 48 MP + 48 MP Triple Primary CamerasDual LED Flash10.5 MP Front Camera|5050 mAhFast ChargingUSB Type-C Port',
'pixel.webp',108900);
insert into product (product_name,product_desc,product_image,product_price)
values ('Mota Meow',
'Extra Fat Meow how only sleeps and eats',
'motaMeow.jpg',108900);
insert into product (product_name,product_desc,product_image,product_price)
values ('Mota pakhi',
'Oversized extra large grey colored pigeon',
'MotaPakhi.jpg',108900);

create table cart (
email_id VARCHAR(255),
product_id INT,
quantity INT,
FOREIGN KEY (email_id) REFERENCES User (email_id) ON DELETE CASCADE,
FOREIGN KEY (product_id) REFERENCES product (product_id)ON DELETE CASCADE
);
