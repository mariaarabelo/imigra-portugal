
--
-- Insert value.
--
/*
INSERT INTO users VALUES (
  DEFAULT,
  'John Doe',
  'admin@example.com',
  '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W'
); -- Password is 1234. Generated using Hash::make('1234')
*/


-- Tabela Users
-- senha123 pra todos
INSERT INTO Users (Id, Name, Email, Password, BirthDate, Points, Picture, IsBlocked) VALUES(1, 'João Silva', 'joao.silva@email.com', '$2y$10$KfQZSXfDraVyC9A./hi/z.XYUvbYc65dNo86kGuSmISDVrQuZr2uC', '1990-01-01', 100, 'profiles/1.jpg', false); 
INSERT INTO Users (Id, Name, Email, Password, BirthDate, Points, Picture, IsBlocked) VALUES(2, 'Maria Santos', 'maria.santos@email.com', '$2y$10$KfQZSXfDraVyC9A./hi/z.XYUvbYc65dNo86kGuSmISDVrQuZr2uC', '1991-02-02', 200, 'maria_santos.jpg', false);
INSERT INTO Users (Id, Name, Email, Password, BirthDate, Points, Picture, IsBlocked) VALUES(3, 'Pedro Ferreira', 'pedro.ferreira@email.com', '$2y$10$KfQZSXfDraVyC9A./hi/z.XYUvbYc65dNo86kGuSmISDVrQuZr2uC', '1992-03-03', 300, 'pedro_ferreira.jpg', false);
INSERT INTO Users (Id, Name, Email, Password, BirthDate, Points, Picture, IsBlocked) VALUES(4, 'Ana Oliveira', 'ana.oliveira@email.com', '$2y$10$KfQZSXfDraVyC9A./hi/z.XYUvbYc65dNo86kGuSmISDVrQuZr2uC', '1993-04-04', 400, 'ana_oliveira.jpg', false);
INSERT INTO Users (Id, Name, Email, Password, BirthDate, Points, Picture, IsBlocked) VALUES(5, 'Luís Costa', 'luis.costa@email.com', '$2y$10$KfQZSXfDraVyC9A./hi/z.XYUvbYc65dNo86kGuSmISDVrQuZr2uC', '1994-05-05', 500, 'luis_costa.jpg', false);
INSERT INTO Users (Id, Name, Email, Password, BirthDate, Points, Picture, IsBlocked) VALUES(6, 'Sofia Almeida', 'sofia.almeida@email.com', '$2y$10$KfQZSXfDraVyC9A./hi/z.XYUvbYc65dNo86kGuSmISDVrQuZr2uC', '1995-06-06', 600, 'sofia_almeida.jpg', false);
INSERT INTO Users (Id, Name, Email, Password, BirthDate, Points, Picture, IsBlocked) VALUES(7, 'Carlos Rodrigues', 'carlos.rodrigues@email.com', '$2y$10$KfQZSXfDraVyC9A./hi/z.XYUvbYc65dNo86kGuSmISDVrQuZr2uC', '1996-07-07', 700, 'carlos_rodrigues.jpg', false);
INSERT INTO Users (Id, Name, Email, Password, BirthDate, Points, Picture, IsBlocked) VALUES(8, 'Marta Sousa', 'marta.sousa@email.com', '$2y$10$KfQZSXfDraVyC9A./hi/z.XYUvbYc65dNo86kGuSmISDVrQuZr2uC', '1997-08-08', 800, 'marta_sousa.jpg', false);
INSERT INTO Users (Id, Name, Email, Password, BirthDate, Points, Picture, IsBlocked) VALUES(9, 'Rui Pereira', 'rui.pereira@email.com', '$2y$10$KfQZSXfDraVyC9A./hi/z.XYUvbYc65dNo86kGuSmISDVrQuZr2uC', '1998-09-09', 900, 'rui_pereira.jpg', false);
INSERT INTO Users (Id, Name, Email, Password, BirthDate, Points, Picture, IsBlocked) VALUES(10, 'Teresa Gomes', 'teresa.gomes@email.com', '$2y$10$KfQZSXfDraVyC9A./hi/z.XYUvbYc65dNo86kGuSmISDVrQuZr2uC', '1999-10-10', 1000, 'teresa_gomes.jpg', false);

-- Tabela Administrator
INSERT INTO Administrators (IdUser) VALUES(1);
INSERT INTO Administrators (IdUser) VALUES(2);
INSERT INTO Administrators (IdUser) VALUES(3);

-- Tabela Content
INSERT INTO contents (id, description, ContentDate) VALUES (1, 'Penso em viajar para Portugal e gostaria de ter informacoes sobre o visto.', '2023-10-15');
INSERT INTO contents (id, description, ContentDate) VALUES (2, 'Resposta à Pergunta 1', '2023-10-15');
INSERT INTO contents (id, description, ContentDate) VALUES (3, 'Outra Resposta à Pergunta 1', '2023-10-16');
INSERT INTO contents (id, description, ContentDate) VALUES (4, 'Qual e a situacao do emprego?', '2023-09-28');
INSERT INTO contents (id, description, ContentDate) VALUES (5, 'Acabo de chegar em Portugal', '2023-08-20');
INSERT INTO contents (id, description, ContentDate) VALUES (6, 'Resposta ofensiva à Pergunta 3', '2023-08-21');
INSERT INTO contents (id, description, ContentDate) VALUES (7, 'Ja estou ca a 5 anos e estou irritada sobre o processo', '2023-07-12');
INSERT INTO contents (id, description, ContentDate) VALUES (8, 'Penso em viajar no proximo ano', '2023-06-05');
INSERT INTO contents (id, description, ContentDate) VALUES (9, 'Procurando Emprego em Portugal', '2023-05-15');
INSERT INTO contents (id, description, ContentDate) VALUES (10, 'Resposta à Pergunta 5', '2023-05-16');
INSERT INTO contents (id, description, ContentDate) VALUES (11, 'Alojamento em Portugal: Dicas Importantes', '2023-04-30');
INSERT INTO contents (id, description, ContentDate) VALUES (12, 'Sistema de Saúde em Portugal', '2023-04-10');
INSERT INTO contents (id, description, ContentDate) VALUES (13, 'Educação em Portugal para Imigrantes', '2023-03-22');
INSERT INTO contents (id, description, ContentDate) VALUES (14, 'Resposta à Pergunta 7', '2023-03-23');
INSERT INTO contents (id, description, ContentDate) VALUES (15, 'Educação em Portugal para Imigrantes', '2023-03-10');
INSERT INTO contents (id, description, ContentDate) VALUES (16, 'Pergunta de Comentário 1', '2023-03-11');
INSERT INTO contents (id, description, ContentDate) VALUES (17, 'Resposta a Pergunta de Comentário 1', '2023-03-12');
INSERT INTO contents (id, description, ContentDate) VALUES (18, 'Comentário sobre Resposta 4', '2023-03-13');
INSERT INTO contents (id, description, ContentDate) VALUES (19, 'Mais informações sobre Vistos de Trabalho', '2023-11-05');
INSERT INTO contents (id, description, ContentDate) VALUES (20, 'Melhores Bairros para Morar em Lisboa', '2023-11-12');
INSERT INTO contents (id, description, ContentDate) VALUES (21, 'Resposta à Pergunta de Comentário 1', '2023-11-15');
INSERT INTO contents (id, description, ContentDate) VALUES (22, 'Pergunta sobre Gastronomia Portuguesa', '2023-11-20');
INSERT INTO contents (id, description, ContentDate) VALUES (23, 'Resposta à Pergunta sobre Gastronomia', '2023-11-21');
INSERT INTO contents (id, description, ContentDate) VALUES (24, 'Comentário na Resposta 21', '2023-11-22');

-- Tabela Author 
INSERT INTO authors (IdUser, IdContent) VALUES (1, 1);
INSERT INTO authors (IdUser, IdContent) VALUES (1, 4);
INSERT INTO authors (IdUser, IdContent) VALUES (2, 2);
INSERT INTO authors (IdUser, IdContent) VALUES (3, 3);
INSERT INTO authors (IdUser, IdContent) VALUES (4, 5);
INSERT INTO authors (IdUser, IdContent) VALUES (5, 6);
INSERT INTO authors (IdUser, IdContent) VALUES (6, 7);
INSERT INTO authors (IdUser, IdContent) VALUES (7, 8);
INSERT INTO authors (IdUser, IdContent) VALUES (8, 9);
INSERT INTO authors (IdUser, IdContent) VALUES (9, 10);
INSERT INTO authors (IdUser, IdContent) VALUES (1, 11);
INSERT INTO authors (IdUser, IdContent) VALUES (3, 13);
INSERT INTO authors (IdUser, IdContent) VALUES (5, 15);
INSERT INTO authors (IdUser, IdContent) VALUES (7, 17);
INSERT INTO authors (IdUser, IdContent) VALUES (3, 18);
INSERT INTO authors (IdUser, IdContent) VALUES (10, 21);
INSERT INTO authors (IdUser, IdContent) VALUES (1, 22);
INSERT INTO authors (IdUser, IdContent) VALUES (2, 23);
INSERT INTO authors (IdUser, IdContent) VALUES (3, 24);

-- Tabela Question
INSERT INTO questions (IdContent, Title) VALUES (1, 'Como Solicitar um Visto de Residência?');
INSERT INTO questions (IdContent, Title) VALUES (4, 'Quais São as Oportunidades de Emprego?');
INSERT INTO questions (IdContent, Title) VALUES (5, 'Quanto Tempo Demora para Obter a Residência Permanente?');
INSERT INTO questions (IdContent, Title) VALUES (7, 'Qual o Processo para Obter a Cidadania Portuguesa?');
INSERT INTO questions (IdContent, Title) VALUES (8, 'Quais Documentos São Necessários na Chegada a Portugal?');
INSERT INTO questions (IdContent, Title) VALUES (11, 'Como funciona o Alojamento em Portugal?');
INSERT INTO questions (IdContent, Title) VALUES (13, 'O Sistema de Saúde em Portugal e Bom?');
INSERT INTO questions (IdContent, Title) VALUES (15, 'E facil o acesso dos Imigrantes nas escolas?');
INSERT INTO questions (IdContent, Title) VALUES (16, 'Pergunta de Comentário 1?');
INSERT INTO questions (IdContent, Title) VALUES (19, 'Como Funcionam os Vistos de Trabalho em Portugal?');
INSERT INTO questions (IdContent, Title) VALUES (20, 'Como Encontrar Apartamentos em Lisboa?');
INSERT INTO questions (IdContent, Title) VALUES (22, 'Qual e o melhor prato da Gastronomia Portuguesa?');

-- Tabela Answer
INSERT INTO answers (IdContent, IdQuestion, Correct) VALUES (2, 1, 1);
INSERT INTO answers (IdContent, IdQuestion, Correct) VALUES (3, 1, 0);
INSERT INTO answers (IdContent, IdQuestion, Correct) VALUES (6, 4, 1);
INSERT INTO answers (IdContent, IdQuestion, Correct) VALUES (12, 7, 1);
INSERT INTO answers (IdContent, IdQuestion, Correct) VALUES (14, 7, 1);
INSERT INTO answers (IdContent, IdQuestion, Correct) VALUES (17, 16, 0);
INSERT INTO answers (IdContent, IdQuestion, Correct) VALUES (21, 8, 1);
INSERT INTO answers (IdContent, IdQuestion, Correct) VALUES (23, 22, 1);

-- Tabela Comment
INSERT INTO comments (IdContent, IdQuestion, IdAnswer) VALUES (9, 1, NULL);
INSERT INTO comments (IdContent, IdQuestion, IdAnswer) VALUES (10, NULL, 3);
INSERT INTO comments (IdContent, IdQuestion, IdAnswer) VALUES (18, NULL, 17);
INSERT INTO comments (IdContent, IdQuestion, IdAnswer) VALUES (24, NULL, 21);

-- Tabela Vote
INSERT INTO Votes (Id, VoteDate) VALUES (1, '2023-10-16');
INSERT INTO Votes (Id, VoteDate) VALUES (2, '2023-10-17');
INSERT INTO Votes (Id, VoteDate) VALUES (3, '2023-10-18');
INSERT INTO Votes (Id, VoteDate) VALUES (4, '2023-10-19');
INSERT INTO Votes (Id, VoteDate) VALUES (5, '2023-10-20');
INSERT INTO Votes (Id, VoteDate) VALUES (6, '2023-10-21');
INSERT INTO Votes (Id, VoteDate) VALUES (7, '2023-10-22');
INSERT INTO Votes (Id, VoteDate) VALUES (8, '2023-10-23');
INSERT INTO Votes (Id, VoteDate) VALUES (9, '2023-10-24');
INSERT INTO Votes (Id, VoteDate) VALUES (10, '2023-10-25');

-- Tabela User_Vote_Content
INSERT INTO User_Vote_contents (IdUser, IdVote, IdContent) VALUES (1, 1, 1);
INSERT INTO User_Vote_contents (IdUser, IdVote, IdContent) VALUES (2, 2, 2);
INSERT INTO User_Vote_contents (IdUser, IdVote, IdContent) VALUES (3, 3, 3);
INSERT INTO User_Vote_contents (IdUser, IdVote, IdContent) VALUES (4, 4, 4);
INSERT INTO User_Vote_contents (IdUser, IdVote, IdContent) VALUES (5, 5, 5);
INSERT INTO User_Vote_contents (IdUser, IdVote, IdContent) VALUES (6, 6, 6);
INSERT INTO User_Vote_contents (IdUser, IdVote, IdContent) VALUES (7, 7, 7);
INSERT INTO User_Vote_contents (IdUser, IdVote, IdContent) VALUES (8, 8, 8);
INSERT INTO User_Vote_contents (IdUser, IdVote, IdContent) VALUES (9, 9, 9);
INSERT INTO User_Vote_contents (IdUser, IdVote, IdContent) VALUES (10, 10, 10);

-- Tabela Tag
INSERT INTO Tags (Id, description) VALUES (1, 'Visa');
INSERT INTO Tags (Id, description) VALUES (2, 'Tourism');
INSERT INTO Tags (Id, description) VALUES (3, 'Health');
INSERT INTO Tags (Id, description) VALUES (4, 'Education');
INSERT INTO Tags (Id, description) VALUES (5, 'Job');
INSERT INTO Tags (Id, description) VALUES (6, 'Residence Permit');
INSERT INTO Tags (Id, description) VALUES (7, 'Portuguese Citizenship');
INSERT INTO Tags (Id, description) VALUES (8, 'Accommodation');
INSERT INTO Tags (Id, description) VALUES (9, 'Culture');


-- Tabela Content_Tag 
INSERT INTO Content_Tags (IdTag, IdContent) VALUES (1, 1);
INSERT INTO Content_Tags (IdTag, IdContent) VALUES (5, 4);
INSERT INTO Content_Tags (IdTag, IdContent) VALUES (3, 5);
INSERT INTO Content_Tags (IdTag, IdContent) VALUES (4, 7);
INSERT INTO Content_Tags (IdTag, IdContent) VALUES (3, 8);
INSERT INTO Content_Tags (IdTag, IdContent) VALUES (6, 11);
INSERT INTO Content_Tags (IdTag, IdContent) VALUES (7, 13);
INSERT INTO Content_Tags (IdTag, IdContent) VALUES (8, 15);
INSERT INTO Content_Tags (IdTag, IdContent) VALUES (9, 16);
INSERT INTO Content_Tags (IdTag, IdContent) VALUES (1, 19);
INSERT INTO Content_Tags (IdTag, IdContent) VALUES (6, 20);
INSERT INTO Content_Tags (IdTag, IdContent) VALUES (9, 22);


-- Tabela Change
INSERT INTO Changes (Id, IdContent, description, ChangeDate) VALUES (1, 1, 'Atualização: Novas informações sobre o processo de visto.', '2023-10-16');
INSERT INTO Changes (Id, IdContent, description, ChangeDate) VALUES (2, 4, 'Correção de erro ortográfico no conteúdo.', '2023-10-17');
INSERT INTO Changes (Id, IdContent, description, ChangeDate) VALUES (3, 5, 'Atualização: Inclusão de mais detalhes sobre residência permanente.', '2023-10-18');
INSERT INTO Changes (Id, IdContent, description, ChangeDate) VALUES (4, 10, 'Adição de informações sobre eventos culturais em Lisboa em 2023.', '2023-10-19');
INSERT INTO Changes (Id, IdContent, description, ChangeDate) VALUES (5, 21, 'Atualização: Novos eventos culturais adicionados.', '2023-10-20');

-- Tabela Moderator senha123
INSERT INTO Moderators (Id, Name, Email, Password, BirthDate, Picture) VALUES (1, 'Grace', 'grace@example.com', '$2y$10$KfQZSXfDraVyC9A./hi/z.XYUvbYc65dNo86kGuSmISDVrQuZr2uC', '1990-07-25', 'grace.jpg');
INSERT INTO Moderators (Id, Name, Email, Password, BirthDate, Picture) VALUES (2, 'David', 'david@example.com', '$2y$10$KfQZSXfDraVyC9A./hi/z.XYUvbYc65dNo86kGuSmISDVrQuZr2uC', '1985-12-18', 'david.jpg');
INSERT INTO Moderators (Id, Name, Email, Password, BirthDate, Picture) VALUES (3, 'Sophia', 'sophia@example.com', '$2y$10$KfQZSXfDraVyC9A./hi/z.XYUvbYc65dNo86kGuSmISDVrQuZr2uC', '1987-03-30', 'sophia.jpg');
INSERT INTO Moderators (Id, Name, Email, Password, BirthDate, Picture) VALUES (4, 'Jackson', 'jackson@example.com', '$2y$10$KfQZSXfDraVyC9A./hi/z.XYUvbYc65dNo86kGuSmISDVrQuZr2uC', '1992-11-05', 'jackson.jpg');
INSERT INTO Moderators (Id, Name, Email, Password, BirthDate, Picture) VALUES (5, 'Ava', 'ava@example.com', '$2y$10$KfQZSXfDraVyC9A./hi/z.XYUvbYc65dNo86kGuSmISDVrQuZr2uC', '1994-08-15', 'ava.jpg');
INSERT INTO Moderators (Id, Name, Email, Password, BirthDate, Picture) VALUES (6, 'Oliver', 'oliver@example.com', '$2y$10$KfQZSXfDraVyC9A./hi/z.XYUvbYc65dNo86kGuSmISDVrQuZr2uC', '1986-02-12', 'oliver.jpg');
INSERT INTO Moderators (Id, Name, Email, Password, BirthDate, Picture) VALUES (7, 'Chloe', 'chloe@example.com', '$2y$10$KfQZSXfDraVyC9A./hi/z.XYUvbYc65dNo86kGuSmISDVrQuZr2uC', '1991-09-28', 'chloe.jpg');
INSERT INTO Moderators (Id, Name, Email, Password, BirthDate, Picture) VALUES (8, 'Liam', 'liam@example.com', '$2y$10$KfQZSXfDraVyC9A./hi/z.XYUvbYc65dNo86kGuSmISDVrQuZr2uC', '1989-06-10', 'liam.jpg');
INSERT INTO Moderators (Id, Name, Email, Password, BirthDate, Picture) VALUES (9, 'Emma', 'emma@example.com', '$2y$10$KfQZSXfDraVyC9A./hi/z.XYUvbYc65dNo86kGuSmISDVrQuZr2uC', '1993-04-04', 'emma.jpg');
INSERT INTO Moderators (Id, Name, Email, Password, BirthDate, Picture) VALUES (10, 'William', 'william@example.com', '$2y$10$KfQZSXfDraVyC9A./hi/z.XYUvbYc65dNo86kGuSmISDVrQuZr2uC', '1984-01-22', 'william.jpg');


-- Tabela Report 
INSERT INTO Reports (Id, IdUser, IdContent, IdModerator, description, ReportDate) VALUES (1, 1, 2, NULL, 'Conteúdo inapropriado', '2023-10-16');
INSERT INTO Reports (Id, IdUser, IdContent, IdModerator, description, ReportDate) VALUES (2, 3, 4, NULL, 'Suspeita de plágio', '2023-10-17');
INSERT INTO Reports (Id, IdUser, IdContent, IdModerator, description, ReportDate) VALUES (3, 5, 7, NULL, 'Discurso de ódio', '2023-10-18');
INSERT INTO Reports (Id, IdUser, IdContent, IdModerator, description, ReportDate) VALUES (4, 8, 10, NULL, 'Conteúdo spam', '2023-10-19');
INSERT INTO Reports (Id, IdUser, IdContent, IdModerator, description, ReportDate) VALUES (5, 9, 12, NULL, 'Violação dos termos de uso', '2023-10-20');
INSERT INTO Reports (Id, IdUser, IdContent, IdModerator, description, ReportDate) VALUES (6, 2, 6, 1, 'Conteúdo inapropriado', '2023-11-01');
INSERT INTO Reports (Id, IdUser, IdContent, IdModerator, description, ReportDate) VALUES (7, 4, 10, 2, 'Suspeita de plágio', '2023-11-02');
INSERT INTO Reports (Id, IdUser, IdContent, IdModerator, description, ReportDate) VALUES (8, 6, 17, 3, 'Discurso de ódio', '2023-11-03');
INSERT INTO Reports (Id, IdUser, IdContent, IdModerator, description, ReportDate) VALUES (9, 8, 23, 4, 'Conteúdo spam', '2023-11-04');
INSERT INTO Reports (Id, IdUser, IdContent, IdModerator, description, ReportDate) VALUES (10, 10, 24, 5, 'Violação dos termos de uso', '2023-11-05');
INSERT INTO Reports (Id, IdUser, IdContent, IdModerator, description, ReportDate) VALUES (11, 2, 7, 1, 'Discurso ofensivo', '2023-10-01');
INSERT INTO Reports (Id, IdUser, IdContent, IdModerator, description, ReportDate) VALUES (12, 4, NULL, 1, 'Discurso ofensivo', '2023-10-01');
INSERT INTO Reports (Id, IdUser, IdContent, IdModerator, description, ReportDate, Status) VALUES (13, 4, 9, 1, 'Comentario ofensivo', '2020-10-01', TRUE);

-- Tabela Notification
INSERT INTO Notifications (Id, IdUser, IdModerator, description, NotificationDate) VALUES (1, 1, NULL, 'Você recebeu um novo voto em seu conteúdo.', '2023-11-01');
INSERT INTO Notifications (Id, IdUser, IdModerator, description, NotificationDate) VALUES (2, 3, NULL, 'Sua resposta recebeu um novo comentário.', '2023-11-02');
INSERT INTO Notifications (Id, IdUser, IdModerator, description, NotificationDate) VALUES (3, NULL, 4, 'Conteúdo foi relatado e está sob revisão.', '2023-11-03');
INSERT INTO Notifications (Id, IdUser, IdModerator, description, NotificationDate) VALUES (4, 8, NULL, 'Você recebeu um voto em seu comentário.', '2023-11-04');
INSERT INTO Notifications (Id, IdUser, IdModerator, description, NotificationDate) VALUES (5, 10, NULL, 'Sua resposta foi marcada como a melhor resposta.', '2023-11-05');

-- Tabela de Notificação Específicas (Vote,  Answer, Comment, Report)
-- Tabela Vote_Notification
INSERT INTO Vote_Notifications (IdNotification) VALUES (1);
INSERT INTO Vote_Notifications (IdNotification) VALUES (4);

-- Tabela Answer_Notification
INSERT INTO Answer_Notifications (IdNotification) VALUES (5);

-- Tabela Comment_Notification
INSERT INTO Comment_Notifications (IdNotification) VALUES (2);

-- Tabela Report_Notification
INSERT INTO Report_Notifications (IdNotification) VALUES (3);

-- Atualiza a sequencia de cada tabela
SELECT setval('users_id_seq', (SELECT MAX(id) FROM users));
SELECT setval('contents_id_seq', (SELECT MAX(id) FROM contents));
SELECT setval('tags_id_seq', (SELECT MAX(id) FROM tags));
SELECT setval('votes_id_seq', (SELECT MAX(id) FROM votes));
