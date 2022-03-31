CREATE TABLE `tag` (
  `id_tag` int(11) NOT NULL,
  `tag_name` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `tag`
  ADD PRIMARY KEY (`id_tag`);


CREATE TABLE `task` (
  `id_task` int(11) NOT NULL,
  `task_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `task`
  ADD PRIMARY KEY (`id_task`);

CREATE TABLE `task_tag` (
  `id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `task_tag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tag_fk` (`tag_id`),
  ADD KEY `task_fk` (`task_id`);

ALTER TABLE `task_tag`
  ADD CONSTRAINT `tag_fk` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id_tag`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `task_fk` FOREIGN KEY (`task_id`) REFERENCES `task` (`id_task`) ON DELETE CASCADE ON UPDATE CASCADE;
