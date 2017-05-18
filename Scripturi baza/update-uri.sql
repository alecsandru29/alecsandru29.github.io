ALTER TABLE UserData
DROP COLUMN Varsta;

ALTER TABLE UserData
ADD Data_nastere VARCHAR2(20 BYTE);

UPDATE userdata
 set Data_Nastere=CONCAT (Cast(RAND()*(28-1)+1 as int),'-',Cast(RAND()*(12-1)+1 as int),'-',Cast(RAND()*(2001-1960)+1960 as int));
 
 ALTER TABLE specs
ADD Dulap int;

UPDATE specs set Dulap=Cast(RAND()*(3-1)+1 as int)


20144  20164