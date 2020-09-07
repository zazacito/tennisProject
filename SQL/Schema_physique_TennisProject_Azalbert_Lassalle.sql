/*==============================================================*/
/* Nom de SGBD :  ORACLE Version 10gR2                          */
/* Date de creation :  07/09/2020 11:08:52                      */
/*==============================================================*/


alter table MATCH
   drop constraint FK_MATCH_ARBITRE_ARBITRE;

alter table MATCH
   drop constraint FK_MATCH_JOUE_1_JOUEUR;

alter table MATCH
   drop constraint FK_MATCH_JOUE_2_JOUEUR;

alter table MATCH
   drop constraint FK_MATCH_ORGANISE_TOURNOI;

alter table TOURNOI
   drop constraint FK_TOURNOI_GERE_UTILISAT;

drop table ARBITRE cascade constraints;

drop table JOUEUR cascade constraints;

drop index JOUE_2_FK;

drop index JOUE_1_FK;

drop index ARBITRE_FK;

drop index ORGANISE_FK;

drop table MATCH cascade constraints;

drop index GERE_FK;

drop table TOURNOI cascade constraints;

drop table UTILISATEUR cascade constraints;

/*==============================================================*/
/* Table : ARBITRE                                              */
/*==============================================================*/
create table ARBITRE  (
   ARID                 NUMBER(4)                       not null,
   ARNAME               VARCHAR2(30)                    not null,
   ARSURNAME            VARCHAR2(30)                    not null,
   ARCUNTRY             VARCHAR2(30)                    not null,
   constraint PK_ARBITRE primary key (ARID)
);
/*Trigger pour ajouter l'auto-increment sur l'ID*/
CREATE SEQUENCE SEQ_ARBITRE START WITH 1;

CREATE OR REPLACE TRIGGER ARBITRE_ON_INSERT
   BEFORE INSERT ON ARBITRE 
   FOR EACH ROW
BEGIN
  SELECT SEQ_ARBITRE.NEXTVAL
  INTO   :new.arid
  FROM   dual;
END;
/

/*==============================================================*/
/* Table : JOUEUR                                               */
/*==============================================================*/
create table JOUEUR  (
   JOID                 NUMBER(5)                       not null,
   JONAME               VARCHAR2(30)                    not null,
   JOSURNAME            VARCHAR2(30)                    not null,
   JOCLASS              NUMBER(5)                       not null,
   JOCOUNTRY            VARCHAR2(30)                    not null,
   constraint PK_JOUEUR primary key (JOID)
);


/*Trigger pour ajouter l'auto-increment sur l'ID*/
CREATE SEQUENCE SEQ_JOUEUR START WITH 1;

CREATE OR REPLACE TRIGGER JOUEUR_ON_INSERT
   BEFORE INSERT ON JOUEUR 
   FOR EACH ROW
BEGIN
  SELECT SEQ_JOUEUR.NEXTVAL
  INTO   :new.joid
  FROM   dual;
END;
/


/*==============================================================*/
/* Table : MATCH                                                */
/*==============================================================*/
create table MATCH  (
   MAID                 NUMBER(7)                       not null,
   JOID                 NUMBER(5)                       not null,
   TOID                 NUMBER(4)                       not null,
   ARID                 NUMBER(4)                       not null,
   JOU_JOID             NUMBER(5)                       not null,
   MADATE               DATE                            not null,
   MASCORE              VARCHAR2(100)                   not null,
   MAWINNER             VARCHAR2(30)                    not null,
   MATOUR               VARCHAR2(30)                    not null,
   constraint PK_MATCH primary key (MAID)
);

/*==============================================================*/
/* Index : ORGANISE_FK                                          */
/*==============================================================*/
create index ORGANISE_FK on MATCH (
   TOID ASC
);

/*==============================================================*/
/* Index : ARBITRE_FK                                           */
/*==============================================================*/
create index ARBITRE_FK on MATCH (
   ARID ASC
);

/*==============================================================*/
/* Index : JOUE_1_FK                                            */
/*==============================================================*/
create index JOUE_1_FK on MATCH (
   JOU_JOID ASC
);

/*==============================================================*/
/* Index : JOUE_2_FK                                            */
/*==============================================================*/
create index JOUE_2_FK on MATCH (
   JOID ASC
);

/*==============================================================*/
/* Table : TOURNOI                                              */
/*==============================================================*/
create table TOURNOI  (
   TOID                 NUMBER(4)                       not null,
   USERID                NUMBER(4)                       not null,
   TONAME               VARCHAR2(30)                    not null,
   TOPLACE              VARCHAR2(30)                    not null,
   TOSTARTDATE          DATE                            not null,
   TOENDDATE            DATE                            not null,
   TONUMBER             NUMBER(3)                       not null,
   TORULES              VARCHAR2(30)                    not null,
   constraint PK_TOURNOI primary key (TOID)
);


/*Trigger pour ajouter l'auto-increment sur l'ID*/
CREATE SEQUENCE SEQ_TOURNOI START WITH 1;

CREATE OR REPLACE TRIGGER TOURNOI_ON_INSERT
   BEFORE INSERT ON TOURNOI 
   FOR EACH ROW
BEGIN
  SELECT SEQ_TOURNOI.NEXTVAL
  INTO   :new.toid
  FROM   dual;
END;
/

/*==============================================================*/
/* Index : GERE_FK                                              */
/*==============================================================*/
create index GERE_FK on TOURNOI (
   USERID ASC
);

/*==============================================================*/
/* Table : UTILISATEUR                                          */
/*==============================================================*/
create table UTILISATEUR  (
   USERID                NUMBER(4)                       not null,
   UNAME                VARCHAR2(30)                    not null,
   USURNAME             VARCHAR2(30)                    not null,
   UMDP                 VARCHAR2(30)                    not null,
   constraint PK_UTILISATEUR primary key (USERID)
);


/*Trigger pour ajouter l'auto-increment sur l'ID*/
CREATE SEQUENCE SEQ_TOURNOI START WITH 1;

CREATE OR REPLACE TRIGGER TOURNOI_ON_INSERT
   BEFORE INSERT ON TOURNOI 
   FOR EACH ROW
BEGIN
  SELECT SEQ_TOURNOI.NEXTVAL
  INTO   :new.toid
  FROM   dual;
END;
/

alter table MATCH
   add constraint FK_MATCH_ARBITRE_ARBITRE foreign key (ARID)
      references ARBITRE (ARID);

alter table MATCH
   add constraint FK_MATCH_JOUE_1_JOUEUR foreign key (JOU_JOID)
      references JOUEUR (JOID);

alter table MATCH
   add constraint FK_MATCH_JOUE_2_JOUEUR foreign key (JOID)
      references JOUEUR (JOID);

alter table MATCH
   add constraint FK_MATCH_ORGANISE_TOURNOI foreign key (TOID)
      references TOURNOI (TOID);

alter table TOURNOI
   add constraint FK_TOURNOI_GERE_UTILISAT foreign key (USERID)
      references UTILISATEUR (USERID);
