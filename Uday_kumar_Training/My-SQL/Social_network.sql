
-- 1st Create a database to implement a simple social network like facebook. You'll need to store a persons information, his friends information and his posts. Create relevant tables with keys for this using the schema below
CREATE DATABASE facebook;

USE facebook;

-- for creating the user table 
CREATE TABLE 
	USER(
		USER_ID INT PRIMARY KEY AUTO_INCREMENT, 
		NAME VARCHAR(40) NOT NULL, 
		EMAIL VARCHAR(40) NOT NULL, 
		PASSWORD VARCHAR(40) NOT NULL,
		ADDRESS VARCHAR(100),
		PHONE VARCHAR(10)
	);


-- for creating friend table
CREATE TABLE 
	FRIEND(
		USER_ID INT, 
		FRIEND_ID INT,
		FOREIGN KEY(USER_ID) REFERENCES USER(USER_ID),
		FOREIGN KEY(FRIEND_ID) REFERENCES USER(USER_ID)
	);


-- for creating the wall table
CREATE TABLE 
	WALL(
		USER_ID INT,
		POSTING_DATE DATETIME DEFAULT CURRENT_TIMESTAMP, 
		POST VARCHAR(200) NOT NULL, 
		FOREIGN KEY(USER_ID) REFERENCES USER(USER_ID)
	);
-- queiry to insert into the user
INSERT INTO 
	USER (NAME,EMAIL,PASSWORD,ADDRESS,PHONE)
VALUES(
	('Uday Kumar', 'uday@gmail.com', 'uday123', 'Bengaluru', '9876543210'),
	('Rahul Sharma', 'rahul@gmail.com', 'rahul123', 'Mysuru', '9876543211'),
	('Priya Reddy', 'priya@gmail.com', 'priya123', 'Hyderabad', '9876543212'),
	('Arun Kumar', 'arun@gmail.com', 'arun123', 'Chennai', '9876543213'),
	('Sneha Rao', 'sneha@gmail.com', 'sneha123', 'Mangaluru', '9876543214'),
	('Kiran Raj', 'kiran@gmail.com', 'kiran123', 'Bengaluru', '9876543215')
);

--  queiry to insert into the friend
INSERT INTO 
	FRIEND(USER_ID,FRIEND_ID)
VALUES(
	(1, 2),
	(1, 3),
	(1, 5),
	(2, 3),
	(2, 4),
	(3, 5),
	(3, 6),
	(4, 1),
	(5, 2),
	(6, 1)
);

--  queiry to insert into the wall
INSERT INTO 
	WALL(USER_ID,POST)
VALUES(
	(1, 'Hello everyone! This is my first post.'),
	(2, 'Learning SQL today.'),
	(3, 'Good morning everyone!'),
	(1, 'SQL joins are interesting.'),
	(4, 'Working on my new project.'),
	(5, 'Happy to connect with everyone.'),
	(6, 'Practicing database concepts.'),
	(2, 'Completed my SQL assignment.'),
	(3, 'Learning about foreign keys.'),
	(1, 'Database practice completed!')
);


-- 2ND Write a query to fetch all information for a person given his name.
SELECT 
	* 
FROM 
	USER 
WHERE 
	NAME='Uday Kumar';

-- 3RD. Write a query to fetch all posts of a person given his name
SELECT 
	W.USER_ID,W.POST,W.POSTING_DATE 
FROM 
	WALL W 
LEFT OUTER JOIN USER U ON U.USER_ID=W.USER_ID 
WHERE 
	U.NAME="Priya Reddy";

-- 4TH. Write a query to fetch all posts of a particular friend of a person, given his name and the friends name.
SELECT 
	W.POST 
FROM 
	USER U 
LEFT OUTER JOIN FRIEND F ON U.USER_ID = F.USER_ID 
LEFT OUTER JOIN USER FR ON FR.USER_ID = F.FRIEND_ID 
LEFT OUTER JOIN WALL W ON W.USER_ID = FR.USER_ID 
WHERE 
	FR.NAME = 'Arun Kumar' AND U.NAME = 'Rahul Sharma';

-- 5TH. Write a query to fetch all friends of a particular friend of a person, 
-- given the persons name and friend's name.
SELECT 
	FRU.NAME 
FROM 
	USER U 
LEFT OUTER JOIN FRIEND F ON U.USER_ID = F.USER_ID 
LEFT OUTER JOIN USER FU ON F.FRIEND_ID=FU.USER_ID
LEFT OUTER JOIN FRIEND FR ON F.FRIEND_ID=FR.user_id
LEFT OUTER JOIN USER FRU ON FR.FRIEND_ID=FRU.USER_ID
WHERE 
	U.NAME="Uday Kumar" AND FU.NAME="Rohit Sharma";

-- 6TH. Write a query to remove a particular 
-- friend FROM a persons list, given the 
-- persons name

DELETE 
	F 
FROM 
	USER U 
LEFT OUTER JOIN FRIEND F ON U.USER_ID=F.USER_ID 
LEFT OUTER JOIN USER FR ON FR.USER_ID=F.FRIEND_ID 
WHERE 
	U.NAME="Uday kumar" AND FR.NAME="Rohit Sharma";

-- 7TH. Write a query to post
--  something on his wall
INSERT INTO 
	WALL (USER_ID, POST)
SELECT 
	USER_ID, 'hey this is the msg'
FROM 
	USER 
WHERE 
	NAME = 'Uday Kumar';

