INSERT INTO user (id, username, email, password, date_created, date_updated, status) VALUES (1, 'info@yuriblanc.it', 'info@yuriblanc.it', '$2y$10$Zw92VDDlCs1YcIqDmR8YYe7CcAXyIa5nJAhY2uqjZ1CuzydrD6cFq', '2017-12-28 23:27:31', null, '1');
INSERT INTO userrole (id, title, level, date_created, date_updated, status) VALUES (1, 'superuser', 0, '2017-12-28 23:30:32', null, '1');
INSERT INTO user_roles (user_id, user_role_id) VALUES (1, 1);

INSERT INTO phackpcms.user (username, email, password, date_created, date_updated, status) VALUES ('info@yuriblanc.it', 'info@yuriblanc.it', '$2y$10$Zw92VDDlCs1YcIqDmR8YYe7CcAXyIa5nJAhY2uqjZ1CuzydrD6cFq', null, null, '1');