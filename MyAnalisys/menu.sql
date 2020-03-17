
-- frontend: DragdropnestedController.php
-- backend:  DragdropnestedController.php
-- backend:  CreocodernestedController.php

--
-- База данных: `hierarchy_php`
--

-- --------------------------------------------------------

--
-- Структура таблицы `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tree` int(11) NOT NULL,
  `lft` int(11) NOT NULL,
  `rgt` int(11) NOT NULL,
  `depth` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Дамп данных таблицы `menu`
--

INSERT INTO `menu` (`id`, `tree`, `lft`, `rgt`, `depth`, `name`) VALUES
(9, 9, 1, 16, 0, 'Countries'),
(10, 9, 3, 6, 2, 'Russia'),
(11, 9, 2, 9, 1, 'Europe'),
(12, 9, 7, 8, 2, 'Ukraine'),
(13, 9, 10, 15, 1, 'North America'),
(14, 9, 11, 12, 2, 'USA'),
(15, 9, 13, 14, 2, 'Mexica'),
(16, 9, 4, 5, 3, 'Kazachstan');

