--
-- Setup for the article:
-- https://dbwebb.se/kunskap/lagra-innehall-i-databas-for-webbsidor-och-bloggposter-v2
--

--
-- Create the database with a testuser
--
-- CREATE DATABASE IF NOT EXISTS oophp;
-- GRANT ALL ON oophp.* TO user@localhost IDENTIFIED BY "pass";
-- USE oophp;

-- Ensure UTF8 as chacrter encoding within connection.
SET NAMES utf8;


--
-- Create table for Content
--
DROP TABLE IF EXISTS `content`;
CREATE TABLE `content`
(
  `id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `path` CHAR(120) UNIQUE,
  `slug` CHAR(120) UNIQUE,

  `title` VARCHAR(120),
  `data` TEXT,
  `type` CHAR(20),
  `filter` VARCHAR(80) DEFAULT NULL,

  -- MySQL version 5.6 and higher
  `published` DATETIME DEFAULT NULL, -- CURRENT_TIMESTAMP,
  `created` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated` DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,

  -- MySQL version 5.5 and lower
  -- `published` DATETIME DEFAULT NULL,
  -- `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  -- `updated` DATETIME DEFAULT NULL, --  ON UPDATE CURRENT_TIMESTAMP,

  `deleted` DATETIME DEFAULT NULL
) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;

INSERT INTO `content` (`path`, `slug`, `type`, `title`, `data`, `filter`) VALUES
    INSERT INTO `content`
    VALUES (1,'hem',NULL,'Hem','Detta är min hemsida. Den är skriven i [url=http://en.wikipedia.org/wiki/BBCode]bbcode[/url] vilket innebär att man kan formattera texten till [b]bold[/b] och [i]kursiv stil[/i] samt hantera länkar.\r\n\r\nDessutom finns ett filter \'nl2br\' som lägger in <br>-element istället för \\n, det är smidigt, man kan skriva texten precis som man tänker sig att den skall visas, med radbrytningar.','page','bbcode,nl2br','2019-05-17 16:20:00','2019-05-17 16:23:22','2019-05-17 16:24:25',NULL),
           (2,'om',NULL,'Om','Detta är en sida om mig och min webbplats. Den är skriven i [Markdown](http://en.wikipedia.org/wiki/Markdown). Markdown innebär att du får bra kontroll över innehållet i din sida, du kan formattera och sätta rubriker, men du behöver inte bry dig om HTML.\r\n\r\nRubrik nivå 2\r\n-------------\r\n\r\nDu skriver enkla styrtecken för att formattera texten som **fetstil** och *kursiv*. Det finns ett speciellt sätt att länka, skapa tabeller och så vidare.\r\n\r\n###Rubrik nivå 3\r\n\r\nNär man skriver i markdown så blir det läsbart även som textfil och det är lite av tanken med markdown.','page','markdown','2019-05-17 15:37:00','2019-05-17 16:23:22','2019-05-17 16:24:40',NULL),
           (3,'blogpost-1','valkommen-till-min-blogg','Välkommen till min blogg!','Detta är en bloggpost.\r\n\r\nNär det finns länkar till andra webbplatser så kommer de länkarna att bli klickbara.\r\n\r\nhttp://dbwebb.se är ett exempel på en länk som blir klickbar.','post','link,nl2br','2019-05-17 16:30:00','2019-05-17 16:23:22','2019-05-17 16:38:51',NULL),
           (4,'blogpost-2','nu-har-sommaren-kommit','Nu har sommaren kommit','Detta är en bloggpost som berättar att sommaren har kommit, ett budskap som kräver en bloggpost.','post','nl2br',NULL,'2019-05-17 16:23:22',NULL,NULL),
           (5,'blogpost-3','nu-har-hosten-kommit','Nu har hösten kommit','Detta är en bloggpost som berättar att sommaren har kommit, ett budskap som kräver en bloggpost','post','nl2br',NULL,'2019-05-17 16:23:22',NULL,NULL),
           (6,NULL,'hej-och-ha','Hej och hå!','Oj oj oj\r\n\r\nhttps://dbwebb.se/uppgift/bygg-webbsidor-fran-innehall-i-databasen\r\n\r\n\r\nLänkar o rader, va mer kan man önska sig?','page','link,nl2br','2019-05-17 16:28:00','2019-05-17 16:23:50','2019-05-17 16:27:45',NULL);
SELECT `id`, `path`, `slug`, `type`, `title`, `created` FROM `content`;


--
--
--
--   ts TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
