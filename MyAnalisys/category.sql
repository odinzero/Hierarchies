
--
-- База данных: `mysite-local`
--

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `parent_id`, `name`) VALUES
(1, 0, 'ROOT'),
(2, 1, 'avtoCategory_0'),
(3, 1, 'avtoCategory_1'),
(4, 1, 'avtoCategory_2'),
(5, 1, 'avtoCategory_3'),
(6, 1, 'avtoCategory_4'),
(7, 1, 'avtoCategory_5'),
(8, 1, 'avtoCategory_6'),
(9, 2, 'cat_0_1'),
(10, 2, 'cat_0_2'),
(11, 2, 'cat_0_3'),
(12, 3, 'cat_1_1'),
(13, 3, 'cat_1_2'),
(14, 3, 'cat_1_3'),
(15, 4, 'cat_2_1'),
(16, 4, 'cat_2_2'),
(17, 4, 'cat_2_3'),
(18, 5, 'cat_3_1'),
(19, 5, 'cat_3_2'),
(20, 5, 'cat_3_3'),
(21, 6, 'cat_4_1'),
(22, 6, 'cat_4_2'),
(23, 6, 'cat_4_3'),
(24, 9, 'cat_0_1_1'),
(25, 9, 'cat_0_1_2'),
(26, 9, 'cat_0_1_3'),
(27, 10, 'cat_0_2_1'),
(28, 10, 'cat_0_2_2'),
(29, 10, 'cat_0_2_3'),
(30, 11, 'cat_0_3_1'),
(31, 11, 'cat_0_3_2'),
(32, 11, 'cat_0_3_3'),
(33, 24, 'cat_0_1_1_1'),
(34, 24, 'cat_0_1_1_2'),
(35, 24, 'cat_0_1_1_3'),
(36, 25, 'cat_0_1_2_1'),
(37, 25, 'cat_0_1_2_2'),
(38, 25, 'cat_0_1_2_3'),
(39, 25, 'cat_0_1_2_4'),
(40, 25, 'cat_0_1_2_5'),
(41, 26, 'cat_0_1_3_1'),
(42, 26, 'cat_0_1_3_2');

