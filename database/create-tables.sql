--
-- Use a specific schema and set it as default - lbaw23123.
--
DROP SCHEMA IF EXISTS lbaw23123 CASCADE;
CREATE SCHEMA IF NOT EXISTS lbaw23123;
SET search_path TO lbaw23123;

--
-- Drop any existing tables.
--
DROP TABLE IF EXISTS Users;
DROP TABLE IF EXISTS Administrators;
DROP TABLE IF EXISTS Moderators;
DROP TABLE IF EXISTS Authors;
DROP TABLE IF EXISTS Reports;
DROP TABLE IF EXISTS Changes;
DROP TABLE IF EXISTS Tags;
DROP TABLE IF EXISTS Votes;
DROP TABLE IF EXISTS Contents;
DROP TABLE IF EXISTS Comments;
DROP TABLE IF EXISTS Questions;
DROP TABLE IF EXISTS Answers;
DROP TABLE IF EXISTS Notifications;
DROP TABLE IF EXISTS Report_Notifications;
DROP TABLE IF EXISTS Vote_Notifications;
DROP TABLE IF EXISTS Comment_Notifications;
DROP TABLE IF EXISTS Answer_Notifications;
DROP TABLE IF EXISTS Question_Notifications;
DROP TABLE IF EXISTS Content_Tags;
DROP TABLE IF EXISTS User_Vote_Contents;

--
-- Create tables.
--

CREATE TABLE users  (
   id SERIAL NOT NULL,
   name TEXT NOT NULL,
   email TEXT NOT NULL UNIQUE,
   password TEXT NOT NULL,
   birthDate TEXT, 
   regDate Text DEFAULT CURRENT_DATE,
   points INTEGER DEFAULT 0,
   picture TEXT,
   isBlocked BOOLEAN DEFAULT FALSE,
   remember_token TEXT,
   PRIMARY KEY (Id)
);

CREATE TABLE Administrators  (
   IdUser INTEGER NOT NULL,
   PRIMARY KEY (IdUser),
   FOREIGN KEY (IdUser) REFERENCES Users ON DELETE CASCADE
);

CREATE TABLE contents (
   id SERIAL NOT NULL,
   description TEXT NOT NULL,
   ContentDate TEXT DEFAULT CURRENT_DATE,
   PRIMARY KEY (id)
);

CREATE TABLE authors (
   IdUser INTEGER NOT NULL,
   IdContent INTEGER NOT NULL,
   PRIMARY KEY (IdUser, IdContent),
   FOREIGN KEY (IdUser) REFERENCES Users ON UPDATE CASCADE,
   FOREIGN KEY (IdContent) REFERENCES Contents ON DELETE CASCADE ON UPDATE CASCADE
);


CREATE TABLE questions (
   IdContent INTEGER NOT NULL,
   Title Text NOT NULL,
   PRIMARY KEY (IdContent),
   FOREIGN KEY (IdContent) REFERENCES Contents ON DELETE CASCADE
);

CREATE TABLE answers (
   IdContent INTEGER NOT NULL,
   IdQuestion INTEGER,
   Correct INTEGER DEFAULT 0,
   PRIMARY KEY (IdContent),
   FOREIGN KEY (IdContent) REFERENCES Contents ON DELETE CASCADE,
   FOREIGN KEY (IdQuestion) REFERENCES Questions ON DELETE CASCADE,
   CHECK(Correct IN (0,1))
);

CREATE TABLE comments (
   IdContent INTEGER NOT NULL,
   IdQuestion INTEGER,
   IdAnswer INTEGER,
   PRIMARY KEY (IdContent),
   FOREIGN KEY (IdContent) REFERENCES Contents ON DELETE CASCADE,
   FOREIGN KEY (IdQuestion) REFERENCES Questions ON DELETE CASCADE,
   FOREIGN KEY (IdAnswer) REFERENCES Answers ON DELETE CASCADE,
   CHECK ((IdQuestion IS NOT NULL AND IdAnswer IS NULL) 
      OR (IdQuestion IS NULL AND IdAnswer IS NOT NULL))
);

CREATE TABLE Votes  (
   Id SERIAL NOT NULL,
   VoteDate TEXT DEFAULT CURRENT_DATE,
   PRIMARY KEY (Id)
);

CREATE TABLE User_Vote_Contents (
   IdUser INTEGER NOT NULL,
   IdVote INTEGER NOT NULL,
   IdContent INTEGER NOT NULL,
   PRIMARY KEY (IdUser, IdVote, IdContent),
   FOREIGN KEY (IdUser) REFERENCES Users ON UPDATE CASCADE,
   FOREIGN KEY (IdVote) REFERENCES Votes ON UPDATE CASCADE,
   FOREIGN KEY (IdContent) REFERENCES Contents ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE Tags  (
   Id SERIAL NOT NULL,
   description TEXT NOT NULL, 
   PRIMARY KEY (Id)
);

CREATE TABLE Content_Tags (
   IdTag INTEGER NOT NULL,
   IdContent INTEGER NOT NULL,
   PRIMARY KEY (IdTag, IdContent),
   FOREIGN KEY (IdTag) REFERENCES Tags ON UPDATE CASCADE,
   FOREIGN KEY (IdContent) REFERENCES Contents ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE Changes  (
   Id SERIAL NOT NULL,
   IdContent INTEGER NOT NULL,
   description TEXT NOT NULL,
   ChangeDate TEXT DEFAULT CURRENT_DATE,
   PRIMARY KEY (Id),
   FOREIGN KEY (IdContent) REFERENCES Contents ON UPDATE CASCADE
);

CREATE TABLE Moderators  (
   Id SERIAL NOT NULL,
   Name TEXT NOT NULL,
   Email TEXT NOT NULL UNIQUE,
   Password TEXT NOT NULL,
   BirthDate TEXT, 
   RegDate TEXT DEFAULT CURRENT_DATE,
   Picture TEXT,
   remember_token TEXT,
   PRIMARY KEY (Id)
);
  
CREATE TABLE Reports  (
   Id SERIAL NOT NULL,
   IdUser INTEGER NOT NULL,
   IdContent INTEGER,
   IdModerator INTEGER,
   description TEXT NOT NULL,
   ReportDate TEXT DEFAULT CURRENT_DATE,
   Status BOOLEAN DEFAULT FALSE,
   PRIMARY KEY (Id),
   FOREIGN KEY (IdUser) REFERENCES Users ON UPDATE CASCADE,
   FOREIGN KEY (IdContent) REFERENCES Contents ON UPDATE CASCADE,
   FOREIGN KEY (IdModerator) REFERENCES Moderators ON UPDATE CASCADE
);

CREATE TABLE Notifications  (
   Id SERIAL NOT NULL,
   IdUser INTEGER,
   IdModerator INTEGER,
   description TEXT NOT NULL,
   NotificationDate TEXT DEFAULT CURRENT_DATE,
   PRIMARY KEY (Id),
   FOREIGN KEY (IdUser) REFERENCES Users ON UPDATE CASCADE,
   FOREIGN KEY (IdModerator) REFERENCES Moderators ON UPDATE CASCADE,
      CHECK ((IdUser IS NOT NULL AND IdModerator IS NULL) 
      OR (IdUser IS NULL AND IdModerator IS NOT NULL))
);

CREATE TABLE Vote_Notifications (
   IdNotification INTEGER NOT NULL,
   PRIMARY KEY (IdNotification),
   FOREIGN KEY (IdNotification) REFERENCES Notifications ON DELETE CASCADE
);

CREATE TABLE Answer_Notifications (
   IdNotification INTEGER NOT NULL,
   PRIMARY KEY (IdNotification),
   FOREIGN KEY (IdNotification) REFERENCES Notifications ON DELETE CASCADE 
); 

CREATE TABLE Comment_Notifications (
   IdNotification INTEGER NOT NULL,
   PRIMARY KEY (IdNotification),
   FOREIGN KEY (IdNotification) REFERENCES Notifications ON DELETE CASCADE
); 


CREATE TABLE Report_Notifications (
   IdNotification INTEGER NOT NULL,
   PRIMARY KEY (IdNotification),
   FOREIGN KEY (IdNotification) REFERENCES Notifications ON DELETE CASCADE
);    
