

-- Materialized Path Tree Structure

-- frontend: MaterializedpathController.php
-- backend:  MptreeController.php

CREATE TABLE `mp_tree` (
 `id` bigint(20) NOT NULL auto_increment,
 `name` varchar(50) NOT NULL,
 `path` varchar(100) NOT NULL,
 `level` int(11) NOT NULL,
 PRIMARY KEY (`id`),
 KEY `mpp_idx` (`path`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--CREATE INDEX mpp_idx ON mp_tree (`path`);

INSERT INTO mp_tree VALUES
    (1, 'FOOD', '1', 0),
    (2, 'VEGETABLE', '1.1', 1),
    (3, 'POTATO', '1.1.1', 2),
    (4, 'TOMATO', '1.1.2', 2),
    (5, 'FRUIT', '1.2', 1),
    (6, 'APPLE', '1.2.1', 2),
    (7, 'BANANA', '1.2.2', 2);

-- TOMATO childs --
INSERT INTO mp_tree VALUES
    (8, 'BLACK PRINCE', '1.1.2.1', 3),
    (9, 'BULL HEART', '1.1.2.2', 3),
    (10, 'MIKADA', '1.1.2.3', 3);

-- POTATO childs --
INSERT INTO mp_tree VALUES
    (11, 'LUCK', '1.1.1.1', 3),
    (12, 'GALA', '1.1.1.2', 3),
    (13, 'TIRAS', '1.1.1.3', 3);