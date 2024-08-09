-- Trigger para impedir que os dados relacionados a um usuário sejam excluídos quando apagar a conta

CREATE OR REPLACE FUNCTION preserve_user_data()
RETURNS TRIGGER AS 
$BODY$
BEGIN
  
  UPDATE Question
  SET IdUser = 0  
  WHERE IdUser = OLD.IdUser;

  UPDATE Answer
  SET IdUser = 0 
  WHERE IdUser = OLD.IdUser;

  UPDATE Comment
  SET IdUser = 0  
  WHERE IdUser = OLD.IdUser;

  UPDATE Vote
  SET IdUser = 0  
  WHERE IdUser = OLD.IdUser;

  DELETE FROM Users WHERE IdUser = OLD.IdUser;

  RETURN OLD;
END;
$BODY$ 
LANGUAGE plpgsql;

CREATE TRIGGER preserve_user_data_trigger
INSTEAD OF DELETE ON Users
FOR EACH ROW
EXECUTE FUNCTION preserve_user_data();


--Trigger de premiação a cada 100 votos que acumular nas suas interações
CREATE FUNCTION award_user_prize_on_interactions()
RETURNS TRIGGER AS 
$BODY$
BEGIN
  
  DECLARE user_id INT;

  IF TG_TABLE_NAME = 'Question' THEN
    SELECT IdUser INTO user_id FROM Question WHERE IdQuestion = NEW.IdQuestion;
  ELSIF TG_TABLE_NAME = 'Answer' THEN
    SELECT IdUser INTO user_id FROM Answer WHERE IdAnswer = NEW.IdAnswer;
  ELSIF TG_TABLE_NAME = 'Comment' THEN
    SELECT IdUser INTO user_id FROM Comment WHERE IdComment = NEW.IdComment;
  END IF;

  DECLARE user_vote_count INT;
  SELECT SUM(VoteValue) INTO user_vote_count
  FROM Vote
  WHERE IdUser = user_id
  AND (IdContent = NEW.IdQuestion OR IdContent = NEW.IdAnswer OR IdContent = NEW.IdComment);

  
  IF user_vote_count >= 100 THEN
    RAISE NOTICE 'Usuário com ID % acumulou 100 votos em suas interações e recebeu uma premiação.', user_id;
  END IF;

  RETURN NEW;
END;
$BODY$ 
LANGUAGE plpgsql;


CREATE TRIGGER award_user_prize_on_interactions_trigger
AFTER INSERT ON Question, Answer, Comment
FOR EACH ROW
EXECUTE FUNCTION award_user_prize_on_interactions();
