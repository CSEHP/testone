select * from `student`;
select * from `teacher`;

select `name`, `gender` from `student`;
select `name`, `department` from `teacher`;

select * from `student` where `id` = 1;
select * from `student` where `name` like 'ja';
select * from `teacher` where `department` like '计科'

select * from `student` order by `id`;
select * from `teacher` order by `department`;
select * from `student` order by `id` ASC, `gender` DESC;

select * from `student` where `name` like 'ja' order by `id`;
select * from `teacher` where `department` like '计科' order by `id`;

select * from `student` limit 0, 5;
select * from `teacher` limit 0, 5;

select * from `student` where `name` like 'ja' order by `id` limit 0, 5;
select * from `teacher` where `id` < 5 order by `id` limit 0, 5;

insert into `student` (`name`, `gender`, `email`, `mobile`) values 
    ('lin', '女', '123@qq.com', '123456'),
    ('lin2', '女', '123@qq.com', '123456');

update `student` set `name` = 'zhangsan', `gender` = '男' where id = 1;
update `teacher` set `name` = 'lisi', `department` = '男' where id > 3 order by id desc limit 0, 1;

delete from `student` where `name` = 'lin2'; 
delete from `student` where id > 3 order by id desc limit 0, 2;