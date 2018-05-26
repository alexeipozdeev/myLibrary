CREATE TABLE books
(
	id int auto_increment
		primary key,
	isbn int null,
	author_full_name varchar(255) null,
	title varchar(288) null,
	year int null,
	constraint table_name_id_uindex
		unique (id)
);

CREATE TABLE disks
(
	id int auto_increment
		primary key,
	singer varchar(255) null,
	title varchar(255) null,
	year int null,
	constraint disks_id_uindex
		unique (id)
);


INSERT INTO library.books (isbn, author_full_name, title, year) VALUES (123456, 'Petrov A.R.', 'here are the pies', 2008);
INSERT INTO library.books (isbn, author_full_name, title, year) VALUES (123456, 'Petrov A.R.', 'what''s left?', 2008);
INSERT INTO library.books (isbn, author_full_name, title, year) VALUES (123456, 'Petrov A.R.', 'Run Forest! Run!', 2002);
INSERT INTO library.books (isbn, author_full_name, title, year) VALUES (123456, 'Petrov A.R.', 'distant swimming', 2002);
INSERT INTO library.books (isbn, author_full_name, title, year) VALUES (123456, 'Petrov A.R.', 'fell! push up!', 2002);
INSERT INTO library.books (isbn, author_full_name, title, year) VALUES (123456, 'Petrov A.R.', 'who am I ?', 2008);
INSERT INTO library.books (isbn, author_full_name, title, year) VALUES (123456, 'Sidorov D.F..', 'What for goat accordion', 2008);
INSERT INTO library.books (isbn, author_full_name, title, year) VALUES (123456, 'Sidorov D.F..', 'What for goat accordion', 2010);
INSERT INTO library.books (isbn, author_full_name, title, year) VALUES (123456, 'Sidorov D.F.', 'What for goat accordion', 2008);
INSERT INTO library.books (isbn, author_full_name, title, year) VALUES (123456, 'Sidorov D.F.', 'What for goat accordion', 2008);
INSERT INTO library.books (isbn, author_full_name, title, year) VALUES (123456, 'Sidorov D.F.', 'What for goat accordion', 2008);
INSERT INTO library.books (isbn, author_full_name, title, year) VALUES (123456, 'Sidorov D.F.', 'What for goat accordion', 2008);
INSERT INTO library.books (isbn, author_full_name, title, year) VALUES (123456, 'Sidorov D.F.', 'What for goat accordion', 2008);
INSERT INTO library.books (isbn, author_full_name, title, year) VALUES (123456, 'Sidorov D.F.', 'What for goat accordion', 2008);
INSERT INTO library.books (isbn, author_full_name, title, year) VALUES (123456, 'Sidorov D.F.', 'What for goat accordion', 2008);
INSERT INTO library.books (isbn, author_full_name, title, year) VALUES (123456, 'Sidorov D.F.', 'What for goat accordion', 2008);


INSERT INTO library.disks (singer, title, year) VALUES ('Nikodimus S.G.', 'So we lived in the village', 2010);
INSERT INTO library.disks (singer, title, year) VALUES ('Nikodimus S.G.', 'So we lived in the village', 2010);
INSERT INTO library.disks (singer, title, year) VALUES ('Nikodimus S.G.', 'So we lived in the village', 2010);
INSERT INTO library.disks (singer, title, year) VALUES ('Nikodimus S.G.', 'So we lived in the village', 2010);


