INSERT INTO phackpcms.user (username, email, password, date_created, date_updated, status) VALUES ('info@yuriblanc.it', 'info@yuriblanc.it', '$xy$10$Zw92VDDlCs1YcIqDmR8YYe7CcAXyIa5nJAhY2uqjZ1CuzydrD6cFq', null, null, '1');
INSERT INTO phackpcms.userrole (id, title, level, date_created, date_updated, status) VALUES (NULL , 'superuser', 0, null, null, '1');
INSERT INTO phackpcms.user_roles (user_id, user_role_id) VALUES (1, 1);
INSERT INTO phackpcms.oauth_client (id, identifier, name, redirect_uri, date_created, date_updated, status) VALUES (1, 'TEST_CLIENT', 'TEST_CLIENT', '/', '2018-01-27 23:07:12', null, '1');
