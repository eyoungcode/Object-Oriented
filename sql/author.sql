drop table if exists Author;
create table Author(
authorId binary(16) not null,
authorAvatarUrl varchar(255),
authorActivationToken char(32),
authorEmail varchar(128) not null,
authorHash char(97) not null,
authorUserName varchar(32) not null,
unique(authorEmail),
unique(authorUserName),
INDEX(authorEmail),
primary key(authorId)
);