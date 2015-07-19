
/*---------------------------------------------------------------
  SQL DB BACKUP 30.06.2015 05:41 
  HOST: 
  DATABASE: 
  TABLES: data_barang
  ---------------------------------------------------------------*/

/*---------------------------------------------------------------
  TABLE: `data_barang`
  ---------------------------------------------------------------*/
DROP TABLE IF EXISTS `data_barang`;
create table `data_barang` (
  `id` int(6) unsigned not null auto_increment,
  `namabarang1` varchar(200) not null comment 'nama barang,text ,  ',
  `jumlah2` int(30) not null comment 'jumlah,number ,  ',
  primary key (`id`)
) engine=innodb auto_increment=4 default charset=latin1;
INSERT INTO `data_barang` VALUES   ('2','Pensil','10');
INSERT INTO `data_barang` VALUES ('3','Penggaris','20');
