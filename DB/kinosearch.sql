CREATE DATABASE IF NOT EXISTS `kinosearch1`;
USE `kinosearch1`;
-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3307
-- Время создания: Май 22 2021 г., 13:24
-- Версия сервера: 10.3.13-MariaDB-log
-- Версия PHP: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `kinosearch`
--

DELIMITER $$
--
-- Функции
--
CREATE DEFINER=`root`@`%` FUNCTION `movie_score` (`id` INT) RETURNS FLOAT DETERMINISTIC BEGIN
declare score float;
declare views int;
set views = (select count(views.idviews) from views where views.movies_idmovies = id);
if views = 0 then
return 0;
end if;
set score = ((select count(likes.idlikes) from likes where likes.movies_idmovies = id)*100)/views;
RETURN score/10;
END$$

CREATE DEFINER=`root`@`%` FUNCTION `views_count` (`id` INT) RETURNS INT(11) DETERMINISTIC BEGIN
declare count int;
set count = (select count(views.idviews) from views where views.movies_idmovies = id);
RETURN count;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `genre`
--

CREATE TABLE `genre` (
  `idgenre` int(11) NOT NULL,
  `genre_name` varchar(45) NOT NULL,
  `movies_idmovies` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `genre`
--

INSERT INTO `genre` (`idgenre`, `genre_name`, `movies_idmovies`) VALUES
(1, 'Криминал', 1),
(2, 'Драма', 1),
(3, 'Криминал', 2),
(4, 'драма', 2),
(5, 'криминал', 10),
(6, 'Боевик', 10),
(7, 'Мультфильм', 3),
(8, 'мультфильм', 4),
(9, 'боевик', 5),
(10, 'боевик', 6),
(11, 'драма', 7),
(12, 'криминал', 9),
(13, 'боевик', 8);

-- --------------------------------------------------------

--
-- Структура таблицы `likes`
--

CREATE TABLE `likes` (
  `idlikes` int(11) NOT NULL,
  `movies_idmovies` int(11) NOT NULL,
  `users_idusers` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `likes`
--

INSERT INTO `likes` (`idlikes`, `movies_idmovies`, `users_idusers`) VALUES
(9, 8, 70),
(10, 9, 70),
(11, 4, 70),
(12, 1, 70);

-- --------------------------------------------------------

--
-- Структура таблицы `movies`
--

CREATE TABLE `movies` (
  `idmovies` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `prod_year` year(4) NOT NULL,
  `producer` varchar(45) NOT NULL,
  `screenwriter` varchar(45) NOT NULL,
  `director` varchar(45) NOT NULL,
  `operator` varchar(45) NOT NULL,
  `budget` int(11) NOT NULL,
  `movie_path` varchar(45) NOT NULL,
  `review` varchar(380) NOT NULL DEFAULT 'Пока что тут пусто.',
  `upload_date` date NOT NULL,
  `img_path` varchar(45) NOT NULL,
  `duration` int(11) DEFAULT NULL,
  `trailer` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `movies`
--

INSERT INTO `movies` (`idmovies`, `name`, `prod_year`, `producer`, `screenwriter`, `director`, `operator`, `budget`, `movie_path`, `review`, `upload_date`, `img_path`, `duration`, `trailer`) VALUES
(1, 'Убить Билла', 2003, 'Кв.Тарантино', 'Квентин Тарантино', 'Лоуренс Бендер', 'Анджей Секула', 30000000, 'movies/kill_bill.mp4', 'Наемная убийца жестоко мстит бывшим подельникам. Жестокий боевик Квентина Тарантино — с анимацией и отсылками', '2021-04-27', 'imgs/kill_bill.jpg', 111, 'https://www.youtube.com/embed/DhsvdZ92FVo'),
(2, 'Криминальное чтиво', 1994, 'Кв.Тарантино', 'Квентин Тарантино', 'Лоуренс Бендер', 'Анджей Секула', 8000000, 'movies/pulp_fiction.mp4', '2 премии Национального совета обозревателей — за фильм (поровну с «Форрестом Гампом» / Forrest Gump) и за режиссуру, 4 приза «Независимый дух» — за фильм, режиссуру, сценарий (Квентин Тарантино, Роджер Эйвари) и главную мужскую роль (Сэмьюэл Л. Джексон), 2 приза «Давид» Донателло» в Италии — лучшему иностранному режиссёру (Квентин Тарантино) и актёру (Джон Травольта).', '2021-04-27', 'imgs/pulp_test.webp', 154, 'https://www.youtube.com/embed/s7EdQ4FqbhY'),
(3, 'Шрэк', 2001, 'Э. Адамсон', 'Э. Адамсон', ' Дж. Катценберг', 'Сим Эван-Джонс', 60000000, 'movie/shrek.mp4', 'Полная сюрпризов сказка об ужасном болотном огре, который ненароком наводит порядок в Сказочной стране', '2021-04-25', 'imgs/shrek.webp', 90, 'https://www.youtube.com/embed/CwXOrWvPBPk'),
(4, 'Шрэк 2', 2004, 'Э. Адамсон', 'Э. Адамсон', ' Д. Липман', 'Сим Эван-Джонс', 150000000, 'movies/shrek2.mp4', 'Шрэк пытается подружиться с родителями супруги', '2021-04-24', 'imgs/shrek2.webp', 93, 'https://www.youtube.com/embed/xBgSfhp5Fxo'),
(5, 'Брат', 1997, ' Алексей Балабанов', ' Алексей Балабанов', ' Сергей Сельянов', ' Сергей Астахов', 150000, 'movies/brother.mp4', 'Дембель сражается за правду в бандитском Петербурге. Сергей Бодров мл. в знаковом фильме Алексея Балабанова', '2021-04-16', 'imgs/brother.webp', 100, 'https://www.youtube.com/embed/V0xbH91kvNE'),
(6, 'Брат 2', 2000, 'Алексей Балабанов', 'Алексей Балабанов', 'Валери Гобо', 'Сергей Астахов', 3000000, 'movies/brother2.mp4', 'Американцы знакомятся с Данилой Багровым и узнают, в чем сила', '2021-04-04', 'imgs/brother2.webp', 127, 'https://www.youtube.com/embed/HBAADCHpS5s'),
(7, 'Груз 200', 2007, 'Алексей Балабанов', 'Алексей Балабанов', 'Сергей Сельянов', 'Александр Симонов', 570000, 'movies/gruz200.mp4', 'Милиционер расследует исчезновение дочери секретаря райкома. Самый беспощадный фильм Алексея Балабанова', '2021-04-01', 'imgs/gruz200.webp', 90, 'https://www.youtube.com/embed/nQcCLEgu9y4'),
(8, 'Война', 2002, 'Алексей Балабанов', 'Алексей Балабанов', 'Сергей Сельянов', 'Сергей Астахов', 780213, 'movies/war.mp4', 'Алексей Чадов продолжает дело Данилы Багрова. Крайне реалистичная и неполиткорректная драма о чеченской войне', '2021-03-31', 'imgs/war.webp', 120, 'https://www.youtube.com/embed/-Q1LQ4vBQJo'),
(9, 'Жмурки', 2005, 'Алексей Балабанов', 'Алексей Балабанов', 'Сергей Долгошеин', 'Евгений Привин', 4180000, 'movies/zhmurki.mp4', 'Колоритные бандиты, черный юмор и много-много крови — Балабанов примерил стиль Тарантино на Россию 90-х', '2021-03-24', 'imgs/zhmurki.webp', 111, 'https://www.youtube.com/embed/JROndKTL5Y8'),
(10, 'Убить Билла 2', 2004, 'Кв. Тарантино', 'Кв. Тарантино', 'Лоуренс Бендер', 'Анджей Секула', 30000000, 'movies/killbill2.mp4', 'Черная Мамба все ближе к главарю банды. Продолжение синефильского экшена Квентина Тарантино', '2021-04-27', 'imgs/kill_bill2.webp', 137, 'https://www.youtube.com/embed/UuS7iBI7Gog');

-- --------------------------------------------------------

--
-- Структура таблицы `prod_country`
--

CREATE TABLE `prod_country` (
  `idprod_country` int(11) NOT NULL,
  `country_name` varchar(45) NOT NULL,
  `movies_idmovies` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `prod_country`
--

INSERT INTO `prod_country` (`idprod_country`, `country_name`, `movies_idmovies`) VALUES
(1, 'США', 2),
(2, 'США', 1),
(3, 'США', 10),
(4, 'Япония', 10),
(5, 'Россия', 5),
(6, 'Россия', 6),
(7, 'Россия', 8),
(8, 'Россия', 7),
(10, 'Россия', 9),
(11, 'США', 3),
(12, 'США', 4);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `idusers` int(11) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `surname` varchar(45) NOT NULL,
  `login` varchar(15) NOT NULL,
  `password` varchar(45) NOT NULL,
  `reg_date` date NOT NULL,
  `email` varchar(45) NOT NULL,
  `avatar` varchar(45) DEFAULT 'imgs/avatars/no_av.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`idusers`, `first_name`, `surname`, `login`, `password`, `reg_date`, `email`, `avatar`) VALUES
(67, 'test', 'test', 'test1', 'testtesttest', '2021-04-29', 'Taburetka2281337@gmail.com', 'imgs/avatars/no_av.png'),
(68, 'test', 'test', 'test2', '222222222222', '2021-04-29', 'Taburetka228133@gmail.com', '/imgs/avatars/1619709376test-img.jpg'),
(70, 'test', 'test', 'test', 'dwadwadawd', '2021-04-30', 'adwdddwDW@m.ru', 'imgs/avatars/no_av.png'),
(71, 'test', 'test', 'test23', 'testtesttest', '2021-04-30', 't2est@ma.ru', NULL),
(73, 'alert(log_val);', 'alert(log_val);', 'alert(log_val);', 'alert(log_val);', '2021-04-30', 'alert@m.ru', NULL),
(74, 'alert(log_val);', 'alert(log_val);', '', 'alert(log_val);', '2021-04-30', 'al2222ert@m.ru', NULL),
(75, 'alert(log_val);', 'alert(log_val);', 'alert', 'alert(log_val);', '2021-04-30', '2easwd@M.RU', NULL),
(76, 'alert(log_val);', 'alert(log_val);', '23131123', 'alert(log_val);', '2021-04-30', '22wd@M.RU', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `views`
--

CREATE TABLE `views` (
  `idviews` int(11) NOT NULL,
  `movies_idmovies` int(11) NOT NULL,
  `users_idusers` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `views`
--

INSERT INTO `views` (`idviews`, `movies_idmovies`, `users_idusers`) VALUES
(14, 8, 70),
(15, 1, 70);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`idgenre`),
  ADD UNIQUE KEY `idgenre_UNIQUE` (`idgenre`),
  ADD KEY `fk_genre_movies1_idx` (`movies_idmovies`);

--
-- Индексы таблицы `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`idlikes`),
  ADD UNIQUE KEY `idlikes_UNIQUE` (`idlikes`),
  ADD KEY `fk_likes_movies_idx` (`movies_idmovies`),
  ADD KEY `fk_likes_users1_idx` (`users_idusers`);

--
-- Индексы таблицы `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`idmovies`),
  ADD UNIQUE KEY `idmovies_UNIQUE` (`idmovies`);

--
-- Индексы таблицы `prod_country`
--
ALTER TABLE `prod_country`
  ADD PRIMARY KEY (`idprod_country`),
  ADD UNIQUE KEY `idprod_country_UNIQUE` (`idprod_country`),
  ADD KEY `fk_prod_country_movies1_idx` (`movies_idmovies`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idusers`),
  ADD UNIQUE KEY `idusers_UNIQUE` (`idusers`);

--
-- Индексы таблицы `views`
--
ALTER TABLE `views`
  ADD PRIMARY KEY (`idviews`),
  ADD UNIQUE KEY `idviews_UNIQUE` (`idviews`),
  ADD KEY `fk_views_movies1_idx` (`movies_idmovies`),
  ADD KEY `fk_views_users1_idx` (`users_idusers`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `genre`
--
ALTER TABLE `genre`
  MODIFY `idgenre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `likes`
--
ALTER TABLE `likes`
  MODIFY `idlikes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `movies`
--
ALTER TABLE `movies`
  MODIFY `idmovies` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `prod_country`
--
ALTER TABLE `prod_country`
  MODIFY `idprod_country` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `idusers` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT для таблицы `views`
--
ALTER TABLE `views`
  MODIFY `idviews` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `genre`
--
ALTER TABLE `genre`
  ADD CONSTRAINT `fk_genre_movies1` FOREIGN KEY (`movies_idmovies`) REFERENCES `movies` (`idmovies`);

--
-- Ограничения внешнего ключа таблицы `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `fk_likes_movies` FOREIGN KEY (`movies_idmovies`) REFERENCES `movies` (`idmovies`),
  ADD CONSTRAINT `fk_likes_users1` FOREIGN KEY (`users_idusers`) REFERENCES `users` (`idusers`);

--
-- Ограничения внешнего ключа таблицы `prod_country`
--
ALTER TABLE `prod_country`
  ADD CONSTRAINT `fk_prod_country_movies1` FOREIGN KEY (`movies_idmovies`) REFERENCES `movies` (`idmovies`);

--
-- Ограничения внешнего ключа таблицы `views`
--
ALTER TABLE `views`
  ADD CONSTRAINT `fk_views_movies1` FOREIGN KEY (`movies_idmovies`) REFERENCES `movies` (`idmovies`),
  ADD CONSTRAINT `fk_views_users1` FOREIGN KEY (`users_idusers`) REFERENCES `users` (`idusers`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
