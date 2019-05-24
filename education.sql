-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 15 2019 г., 17:42
-- Версия сервера: 5.6.38
-- Версия PHP: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `education`
--

-- --------------------------------------------------------

--
-- Структура таблицы `db_curses`
--

CREATE TABLE `db_curses` (
  `id_curs` int(11) NOT NULL,
  `name_curs` varchar(250) NOT NULL,
  `discription_curs` text NOT NULL,
  `img_curs` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `db_curses`
--

INSERT INTO `db_curses` (`id_curs`, `name_curs`, `discription_curs`, `img_curs`) VALUES
(1, 'Математика', '\"Web-бағдарламалау негіздері” курсын аяқтағаннан кейін сіздер веб-сайт жасаудың негіздерін үйренетін боласыздар. Сонымен қатар, өздеріңіздің жеке парақшаңызды немесе онлайн-дүкеннің интерфейсін (front-end) жасай алатын боласыздар.', '3.jpg'),
(2, 'Физика', '\"Web-бағдарламалау негіздері” курсын аяқтағаннан кейін сіздер веб-сайт жасаудың негіздерін үйренетін боласыздар. Сонымен қатар, өздеріңіздің жеке парақшаңызды немесе онлайн-дүкеннің интерфейсін (front-end) жасай алатын боласыздар.', '4.jpeg'),
(3, 'WEB бағдарламалау', '\"Web-бағдарламалау негіздері” курсын аяқтағаннан кейін сіздер веб-сайт жасаудың негіздерін үйренетін боласыздар. Сонымен қатар, өздеріңіздің жеке парақшаңызды немесе онлайн-дүкеннің интерфейсін (front-end) жасай алатын боласыздар.', '5.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `db_curses_sections`
--

CREATE TABLE `db_curses_sections` (
  `id_curses_sections` int(11) NOT NULL,
  `id_group` int(11) NOT NULL,
  `name_curses_sections` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `db_curses_sections`
--

INSERT INTO `db_curses_sections` (`id_curses_sections`, `id_group`, `name_curses_sections`) VALUES
(1, 2, 'Бөлім-1'),
(9, 2, 'Бөлім-2');

-- --------------------------------------------------------

--
-- Структура таблицы `db_groups`
--

CREATE TABLE `db_groups` (
  `id_group` int(11) NOT NULL,
  `name_group` varchar(50) NOT NULL,
  `id_curs` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `mo` int(11) NOT NULL,
  `tu` int(11) NOT NULL,
  `we` int(11) NOT NULL,
  `th` int(11) NOT NULL,
  `fr` int(11) NOT NULL,
  `sa` int(11) NOT NULL,
  `su` int(11) NOT NULL,
  `time` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `db_groups`
--

INSERT INTO `db_groups` (`id_group`, `name_group`, `id_curs`, `user_id`, `mo`, `tu`, `we`, `th`, `fr`, `sa`, `su`, `time`) VALUES
(2, 'WEB-1', 3, 11, 1, 0, 1, 0, 1, 0, 1, '15:00 - 17:00'),
(3, 'WEB-2', 3, 11, 0, 1, 0, 1, 0, 1, 0, '12:00 - 14:00'),
(4, 'Математика-1', 1, 11, 1, 0, 1, 0, 1, 0, 0, '16:00 - 18:00');

-- --------------------------------------------------------

--
-- Структура таблицы `db_groups_docs`
--

CREATE TABLE `db_groups_docs` (
  `id_group_doc` int(11) NOT NULL,
  `id_group` int(11) NOT NULL,
  `id_curses_sections` int(11) NOT NULL,
  `name_doc` varchar(250) NOT NULL,
  `url_doc` varchar(250) NOT NULL,
  `type_doc` varchar(50) NOT NULL,
  `date_upload` varchar(50) NOT NULL,
  `points` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `db_groups_docs`
--

INSERT INTO `db_groups_docs` (`id_group_doc`, `id_group`, `id_curses_sections`, `name_doc`, `url_doc`, `type_doc`, `date_upload`, `points`) VALUES
(7, 2, 1, 'Word', 'test_Страницы.docx', 'application/vnd.openxmlformats-officedocument.word', '14.05.2019', 0),
(8, 2, 1, 'Лекция', 'test_Khaggarti_R_-_Diskretnaya_matematika_dlya_progr.pdf', 'application/pdf', '14.05.2019', 0),
(9, 2, 1, 'Word doc', 'test_Страницы1.doc', 'application/msword', '14.05.2019', 0),
(13, 2, 1, 'asdasdasdsad', '170931_Khaggarti_R_-_Diskretnaya_matematika_dlya_progr.pdf', 'application/pdf', '14.05.2019', 0),
(14, 3, 7, 'sadasd', '171159_Khaggarti_R_-_Diskretnaya_matematika_dlya_progr.pdf', 'application/pdf', '14.05.2019', 0),
(16, 3, 7, 'asd asdsad', '184238_Khaggarti_R_-_Diskretnaya_matematika_dlya_progr.pdf', 'application/pdf', '14.05.2019', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `db_groups_testing_info`
--

CREATE TABLE `db_groups_testing_info` (
  `id_groups_testing_info` int(11) NOT NULL,
  `id_group` int(11) NOT NULL,
  `id_curses_sections` int(11) NOT NULL,
  `name_test` varchar(250) NOT NULL,
  `start_test` varchar(20) NOT NULL,
  `end_test` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `db_groups_testing_info`
--

INSERT INTO `db_groups_testing_info` (`id_groups_testing_info`, `id_group`, `id_curses_sections`, `name_test`, `start_test`, `end_test`) VALUES
(1, 2, 1, 'Қорытынды тестілеу', '14.05.2019', '19.05.2019'),
(4, 2, 9, 'Пробный тест', '15.05.2019', '17.05.2019'),
(5, 2, 1, 'Пробный', '15.05.2019', '16.05.2019');

-- --------------------------------------------------------

--
-- Структура таблицы `db_student_curs`
--

CREATE TABLE `db_student_curs` (
  `student_curs_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `id_curs` int(11) NOT NULL,
  `id_group` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `db_student_curs`
--

INSERT INTO `db_student_curs` (`student_curs_id`, `user_id`, `id_curs`, `id_group`) VALUES
(6, 12, 3, 2),
(9, 12, 1, 4),
(10, 18, 3, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `db_testing`
--

CREATE TABLE `db_testing` (
  `id_testing` int(11) NOT NULL,
  `id_groups_testing_info` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `start_date` varchar(10) NOT NULL,
  `mark` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `db_testing`
--

INSERT INTO `db_testing` (`id_testing`, `id_groups_testing_info`, `user_id`, `start_date`, `mark`) VALUES
(1, 1, 18, '15.05.2019', 100),
(3, 1, 12, '15.05.2019', 80),
(5, 5, 18, '15.05.2019', 100),
(6, 5, 12, '15.05.2019', 60);

-- --------------------------------------------------------

--
-- Структура таблицы `db_testing_questions`
--

CREATE TABLE `db_testing_questions` (
  `id_testing_questions` int(11) NOT NULL,
  `id_groups_testing_info` int(11) NOT NULL,
  `id_curses_sections` int(11) NOT NULL,
  `question_text` text NOT NULL,
  `correct_answer` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `db_testing_questions`
--

INSERT INTO `db_testing_questions` (`id_testing_questions`, `id_groups_testing_info`, `id_curses_sections`, `question_text`, `correct_answer`) VALUES
(2, 1, 1, '<p><b>«Саяси қуғын-сүргін» ұғымының пайда болған кезеңі</b></p><p><b><br></b></p><p>A) ХІХ ғ. 20 ж.ж</p><p>B) ХVІІ ғ</p><p>C) ХХ ғ. басы</p><p>D) ХХ ғ. соңы</p><p>E) ХХ ғ. 30 жылдары</p>', 'B'),
(3, 1, 1, '<p><b>«Саяси қуғын-сүргін» ұғымының пайда болған кезеңі</b></p><p><b><br></b></p><p>A) ХІХ ғ. 20 ж.ж</p><p>B) ХVІІ ғ</p><p>C) ХХ ғ. басы</p><p>D) ХХ ғ. соңы</p><p>E) ХХ ғ. 30 жылдары</p>', 'C'),
(4, 1, 1, '<p><b>«Саяси қуғын-сүргін» ұғымының пайда болған кезеңі</b></p><p><br></p><p>A) ХІХ ғ. 20 ж.ж</p><p>B) ХVІІ ғ</p><p>C) ХХ ғ. басы</p><p>D) ХХ ғ. соңы</p><p>E) ХХ ғ. 30 жылдары</p>', 'D'),
(5, 1, 1, '<p><b>«Саяси қуғын-сүргін» ұғымының пайда болған кезеңі</b></p><p><b><br></b></p><p>A) ХІХ ғ. 20 ж.ж</p><p>B) ХVІІ ғ</p><p>C) ХХ ғ. басы</p><p>D) ХХ ғ. соңы</p><p>E) ХХ ғ. 30 жылдары</p>', 'A'),
(6, 1, 1, '<p><b>«Саяси қуғын-сүргін» ұғымының пайда болған кезеңі</b></p><p><b><br></b></p><p>A) ХІХ ғ. 20 ж.ж</p><p>B) ХVІІ ғ</p><p>C) ХХ ғ. басы</p><p>D) ХХ ғ. соңы</p><p>E) ХХ ғ. 30 жылдары</p>', 'D'),
(7, 4, 9, '<p><b>Әріпке берілетін дәстүрлі анықтама </b></p><p><b><br></b></p><p>A) Дыбысты жазудағы шартты таңба </p><p>B) Сөздің дұрыс жазылуы</p><p>C) Сөздің дұрыс айтылуы</p><p>D) Дыбыстардың белгілі бір жинағы</p><p>E) Дыбыстың шарттылық белгісі</p>', 'A'),
(8, 5, 1, '<p><b>Әріпке берілетін дәстүрлі анықтама </b></p><p><b><br></b></p><p>A) Дыбысты жазудағы шартты таңба </p><p>B) Сөздің дұрыс жазылуы</p><p>C) Сөздің дұрыс айтылуы</p><p>D) Дыбыстардың белгілі бір жинағы</p><p>E) Дыбыстың шарттылық белгісі</p>', 'A'),
(9, 5, 1, '<p><b>Әріпке берілетін дәстүрлі анықтама</b></p><p><b><br></b></p><p>A) Дыбысты жазудағы шартты таңба</p><p>B) Сөздің дұрыс жазылуы</p><p>C) Сөздің дұрыс айтылуы</p><p>D) Дыбыстардың белгілі бір жинағы</p><p>E) Дыбыстың шарттылық белгісі</p>', 'B'),
(10, 5, 1, '<p>	</p><p><b>Әріпке берілетін дәстүрлі анықтама</b></p><p><b><br></b></p><p>A) Дыбысты жазудағы шартты таңба</p><p>B) Сөздің дұрыс жазылуы</p><p>C) Сөздің дұрыс айтылуы</p><p>D) Дыбыстардың белгілі бір жинағы</p><p>E) Дыбыстың шарттылық белгісі</p>', 'C'),
(11, 5, 1, '<p>	</p><p><b>Әріпке берілетін дәстүрлі анықтама</b></p><p><b><br></b></p><p>A) Дыбысты жазудағы шартты таңба</p><p>B) Сөздің дұрыс жазылуы</p><p>C) Сөздің дұрыс айтылуы</p><p>D) Дыбыстардың белгілі бір жинағы</p><p>E) Дыбыстың шарттылық белгісі</p>', 'D'),
(12, 5, 1, '<p>	</p><p><b>Әріпке берілетін дәстүрлі анықтама</b></p><p><b><br></b></p><p>A) Дыбысты жазудағы шартты таңба</p><p>B) Сөздің дұрыс жазылуы</p><p>C) Сөздің дұрыс айтылуы</p><p>D) Дыбыстардың белгілі бір жинағы</p><p>E) Дыбыстың шарттылық белгісі</p>', 'E');

-- --------------------------------------------------------

--
-- Структура таблицы `db_users`
--

CREATE TABLE `db_users` (
  `user_id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_ava` varchar(250) NOT NULL,
  `user_sname` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_mname` varchar(255) NOT NULL,
  `user_phone` varchar(250) NOT NULL,
  `user_email` varchar(250) NOT NULL,
  `user_type` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `db_users`
--

INSERT INTO `db_users` (`user_id`, `login`, `password`, `user_ava`, `user_sname`, `user_name`, `user_mname`, `user_phone`, `user_email`, `user_type`) VALUES
(1, 'salamat', '202cb962ac59075b964b07152d234b70', 'arman_salamat_img11.jpg', 'Шындалы', 'Саламат', 'Болатұлы', '8(707) 199-5202', 'salamat@shyndaly.kz', 1),
(11, 'test', '202cb962ac59075b964b07152d234b70', 'test_img9.jpg', 'Шаяхметова', 'Мейргуль', '', '8(707) 777-7777', 'test@mail.ru', 2),
(12, 'test_stud', '827ccb0eea8a706c4c34a16891f84e7b', 'test_stud_img4.jpg', 'Жолшиева', 'Кунсулу', '', '8(707) 777-7777', 'salamat@5991.kz', 3),
(18, 'ashat', '827ccb0eea8a706c4c34a16891f84e7b', 'ashat_img6.jpg', 'Нурмахамбетов', 'Асхат', '', '8(778) 768-1382', 'ashat@mail.ru', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `db_users_type`
--

CREATE TABLE `db_users_type` (
  `user_type` int(11) NOT NULL,
  `type_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `db_users_type`
--

INSERT INTO `db_users_type` (`user_type`, `type_name`) VALUES
(1, 'Администратор'),
(2, 'Мұғалім'),
(3, 'Оқушы');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `db_curses`
--
ALTER TABLE `db_curses`
  ADD PRIMARY KEY (`id_curs`);

--
-- Индексы таблицы `db_curses_sections`
--
ALTER TABLE `db_curses_sections`
  ADD PRIMARY KEY (`id_curses_sections`);

--
-- Индексы таблицы `db_groups`
--
ALTER TABLE `db_groups`
  ADD PRIMARY KEY (`id_group`);

--
-- Индексы таблицы `db_groups_docs`
--
ALTER TABLE `db_groups_docs`
  ADD PRIMARY KEY (`id_group_doc`);

--
-- Индексы таблицы `db_groups_testing_info`
--
ALTER TABLE `db_groups_testing_info`
  ADD PRIMARY KEY (`id_groups_testing_info`);

--
-- Индексы таблицы `db_student_curs`
--
ALTER TABLE `db_student_curs`
  ADD PRIMARY KEY (`student_curs_id`);

--
-- Индексы таблицы `db_testing`
--
ALTER TABLE `db_testing`
  ADD PRIMARY KEY (`id_testing`);

--
-- Индексы таблицы `db_testing_questions`
--
ALTER TABLE `db_testing_questions`
  ADD PRIMARY KEY (`id_testing_questions`);

--
-- Индексы таблицы `db_users`
--
ALTER TABLE `db_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Индексы таблицы `db_users_type`
--
ALTER TABLE `db_users_type`
  ADD PRIMARY KEY (`user_type`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `db_curses`
--
ALTER TABLE `db_curses`
  MODIFY `id_curs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `db_curses_sections`
--
ALTER TABLE `db_curses_sections`
  MODIFY `id_curses_sections` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `db_groups`
--
ALTER TABLE `db_groups`
  MODIFY `id_group` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `db_groups_docs`
--
ALTER TABLE `db_groups_docs`
  MODIFY `id_group_doc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `db_groups_testing_info`
--
ALTER TABLE `db_groups_testing_info`
  MODIFY `id_groups_testing_info` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `db_student_curs`
--
ALTER TABLE `db_student_curs`
  MODIFY `student_curs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `db_testing`
--
ALTER TABLE `db_testing`
  MODIFY `id_testing` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `db_testing_questions`
--
ALTER TABLE `db_testing_questions`
  MODIFY `id_testing_questions` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `db_users`
--
ALTER TABLE `db_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `db_users_type`
--
ALTER TABLE `db_users_type`
  MODIFY `user_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
