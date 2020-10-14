drop table pageuser cascade constraints;
drop table clientsesh cascade constraints;


create table pageuser (
  userid varchar2(20) primary key,
  passw varchar2(20),
  fname varchar2(20),
  lname varchar2(30),
  accttype int
);

CREATE TABLE clientsesh (
	sessionid varchar2(32) primary key,
  clientid varchar2(20),
	sessiondate date,
	FOREIGN KEY (clientid) REFERENCES pageuser(userid)
);
-- create table clientsesh (
--   sessionid varchar2(32) primary key,
--   clientid varchar2(20),
--   sessiondate date,
--   foreign key (clientid) references pageuser
-- );

insert into pageuser values ('testMary', 'passTest','Mary', 'Hairy', 0);
insert into pageuser values ('testBary', 'passTest', 'Bary','Scary', 0);
insert into pageuser values ('testBlake', 'passTest','Blake','Samani', 1);
insert into pageuser values ('testMary', 'passTest','Mary', 'Hairy', 0);
insert into pageuser values ('testBary', 'passTest', 'Bary','Scary', 0);
insert into pageuser values ('testBlake', 'passTest','Blake','Samani', 1);
insert into pageuser values ('testLe', 'passTest','Leticia','Hameury', 1);
insert into pageuser values ('testJamie', 'passTest','Jamie','Worcester', 1);
insert into pageuser values ('testKhaled', 'passTest','Mohammad','Khaled', 1);
insert into pageuser values ('testBlake2', 'passTest','Blake2','Samani2', 1);
insert into pageuser values ('testBlake3', 'passTest','Blake3','Samani3', 0);