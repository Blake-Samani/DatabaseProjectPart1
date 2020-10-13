
drop table pageusersession cascade constraints;
drop table pageuser cascade constraints;
drop table adminuser cascade constraints;
drop table studentadminuser cascade constraints;
drop table studentuser cascade constraints;

create table pageuser (
  userid varchar2(20) primary key,
  passw varchar2(12),
  fname varchar2(20),
  lname varchar2(30)
);

create table pageusersession (
  sessionid varchar2(32) primary key,
  userid varchar2(8),
  sessiondate date,
  foreign key (userid) references pageuser
);

create table adminuser (
  auserid varchar2(20) primary key,
  foreign key (auserid) references pageuser
);

create table studentadminuser (
  sauserid varchar2(20) primary key,
  foreign key (sauserid) references pageuser
);

create table studentuser (
  suserid varchar2(20) primary key,
  foreign key (suserid) references pageuser
);
 

insert into pageuser values ('testMary', 'passTest','Mary', 'Hairy');
insert into pageuser values ('testBary', 'passTest', 'Bary','Scary');
insert into pageuser values ('testBlake', 'passTest','Blake','Samani');
insert into pageuser values ('testJo', 'passTest', 'Jo', 'Momma');
insert into adminuser values ('testBlake');
