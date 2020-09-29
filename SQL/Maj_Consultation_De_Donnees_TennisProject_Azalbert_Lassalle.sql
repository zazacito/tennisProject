/* description textuelles des requêtes de mise à jour */

 /*2 requêtes impliquant 1 table*/
 UPDATE JOUEUR
 SET JOUEUR.JOCLASS = 12
 WHERE JOUEUR.JOID = 1 ;

UPDATE MATCH
SET MATCH.MADATE = TO_DATE('2020/09/08', 'yyyy/mm/dd')
WHERE MATCH.MATOUR = ‘Huitièmes’
AND MATCH.TOID = 1;

 /* 2 requêtes impliquant 2 tables*/

 UPDATE (SELECT MATCH.JOU_JOID,
                MATCH.MAWINNER winner,
                MATCH.MASCORE score
           FROM MATCH,
                JOUEUR
         WHERE MATCH.JOU_JOID = JOUEUR.JOID
         AND JOUEUR.JOID = 8)
    SET score = '6/4 6/0 6/0',
        winner = 'Joueur 1';

UPDATE (SELECT ARBITRE.ARID,
               ARBITRE.ARSURNAME surname,
               MATCH.ARID
          FROM MATCH,
               ARBITRE
        WHERE MATCH.ARID = ARBITRE.ARID
        AND MATCH.MAID = 8)
   SET surname = 'Kévin';

 /* 2 requêtes impliquant plus de 2 tables)*/

 UPDATE (SELECT MATCH.JOU_JOID,
                JOUEUR.JOID,
                ARBITRE.ARSURNAME surname,
                ARBITRE.ARID,
                MATCH.ARID
           FROM MATCH,
                JOUEUR,
                ARBITRE
         WHERE MATCH.ARID = ARBITRE.ARID
         AND MATCH.JOU_JOID = JOUEUR.JOID
         AND JOUEUR.JOID = 8)
     SET surname = 'Kévin';



/* description textuelles des requêtes de suppression */

/*2 requêtes impliquant 1 table*/
DELETE FROM MATCH
WHERE MATCH.MADATE < '2022/04/10'

DELETE FROM ARBITRE
WHERE ARBITRE.ARID = 2
/* 2 requêtes impliquant 2 tables*/

DELETE (SELECT MATCH.JOU_JOID,
               MATCH.MAWINNER winner,
               MATCH.MASCORE score
          FROM MATCH,
               JOUEUR
        WHERE MATCH.JOU_JOID = JOUEUR.JOID
        AND JOUEUR.JOID = 8);

DELETE (SELECT ARBITRE.ARID,
               MATCH.ARID
          FROM MATCH,
               ARBITRE
        WHERE MATCH.ARID = ARBITRE.ARID
        AND ARBITRE.ARID = 2);


 /* 2 requêtes impliquant plus de 2 tables)*/


 /* description textuelles des requêtes de suppression */

/*5 requêtes impliquant 1 table dont 1 avec un group By et une avec un Order By*/
SELECT ARNAME FROM ARBITRE;

SELECT * FROM JOUEUR
ORDER by JOCLASS DESC;

SELECT JOCOUNTRY, AVG(JOCLASS)
FROM JOUEUR
GROUP BY JOCOUNTRY;

SELECT * FROM MATCH
WHERE TOID = 1;

SELECT * FROM MATCH
WHERE TOID = 1
AND MADATE < TO_DATE('2022/04/10', 'yyyy/mm/dd');

-- 5 requêtes impliquant 2 tables avec jointures internes dont 1 externe + 1 group by + 1 tri

SELECT JOUEUR.JONAME,MATCH.MADATE
FROM JOUEUR,MATCH
WHERE JOUEUR.JOID = MATCH.JOID;

SELECT JOUEUR.JONAME,JOUEUR.JOID,MATCH.MADATE,JOUEUR.JOCLASS
FROM JOUEUR,MATCH
WHERE JOUEUR.JOID = MATCH.JOID
ORDER BY JOUEUR.JOCLASS DESC;

SELECT JOCOUNTRY, AVG(JOCLASS)
FROM JOUEUR,MATCH
WHERE JOUEUR.JOID = MATCH.JOID
GROUP BY JOCOUNTRY;


-- requêtes impliquant plus de 2 tables avec jointures internes dont 1 externe + 1 group by + 1 tri
SELECT JOUEUR.JONAME,MATCH.MADATE,ARBITRE.ARNAME
FROM JOUEUR,MATCH,ARBITRE
WHERE JOUEUR.JOID = MATCH.JOID
AND MATCH.ARID = ARBITRE.ARID;

SELECT JOUEUR.JONAME,JOUEUR.JOID,MATCH.MADATE,JOUEUR.JOCLASS,ARBITRE.ARNAME
FROM JOUEUR,MATCH,ARBITRE
WHERE JOUEUR.JOID = MATCH.JOID
AND MATCH.ARID = ARBITRE.ARID
ORDER BY JOUEUR.JOCLASS DESC;

SELECT JOUEUR.JOCOUNTRY, AVG(JOUEUR.JOCLASS),ARBITRE.ARNAME
FROM JOUEUR,MATCH,ARBITRE
WHERE JOUEUR.JOID = MATCH.JOID
AND MATCH.ARID = ARBITRE.ARID
GROUP BY JOCOUNTRY;
