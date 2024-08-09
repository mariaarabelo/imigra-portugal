---------------------------------------------------------
-- INDICES
---------------------------------------------------------   

CREATE INDEX user_content ON author USING btree (IdUser); CLUSTER author USING user_content;

CREATE INDEX idx_contenttag_idtag ON ContentTag USING btree (IdTag);

CREATE INDEX vote_user_index ON Vote USING btree (IdUser); 


---------------------
-- FTS INDICE
--------------------- 

Add special columns to store search vectors.
ALTER TABLE Question
ADD COLUMN tsvector_title TSVECTOR;
ADD COLUMN tsvector_description TSVECTOR;


-- Create a function to calculate and update ts_vectors with field weighting.
CREATE FUNCTION question_search_update() RETURNS TRIGGER AS $$
BEGIN
 IF TG_OP = 'INSERT' THEN
NEW.tsvector_title = setweight(to_tsvector('english', NEW.Title), 'A');
NEW.tsvector_description = setweight(to_tsvector('english', NEW.Description), 'B');


 END IF;
 IF TG_OP = 'UPDATE' THEN
         IF (NEW.Title <> OLD.Title) THEN
           NEW.tsvector_title = setweight(to_tsvector('english', NEW.Title), 'A');
         END IF;
IF (NEW.Description <> OLD.Description) THEN
NEW.tsvector_description = setweight(to_tsvector('english', NEW.Description), 'B');
END IF;
 END IF;
 RETURN NEW;
END $$
LANGUAGE plpgsql;


-- Create a trigger to call the function whenever a new question is inserted or updated.
CREATE TRIGGER question_search_update
 BEFORE INSERT OR UPDATE ON question
 FOR EACH ROW
 EXECUTE PROCEDURE question_search_update();


-- Create an FTS index on the search vector column Title.
CREATE INDEX idx_question_title ON question USING gin (tsvector_title, tsvector_description);
