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
         WHERE MATCH.ARID = ABITRE.ARID
         AND MATCH.JOU_JOID = JOUEUR.JOID
         AND JOUEUR.JOID = 8)
     SET surname = 'Kévin';



/* description textuelles des requêtes de suppression */

/*2 requêtes impliquant 1 table*/

/* 2 requêtes impliquant 2 tables*/

 /* 2 requêtes impliquant plus de 2 tables)*/
