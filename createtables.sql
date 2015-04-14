drop table Moviesupps;
drop table Moviemains;
commit;
create table Moviemains (
id int auto_increment primary key,
movie varchar(45),
mgroup enum ('FANTASY/SCI.FI', 'CHICK', 'DRAMA', 'CRIME', 'KIDS', 'COMEDY', 'ACTION'),
info text
);
create table Moviesupps (
id int auto_increment primary key,
fk_movie int,
photo mediumtext,
photocomment text,
constraint foreign key(fk_movie) references Moviemains(id)
);