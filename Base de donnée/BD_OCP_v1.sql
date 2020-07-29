/*==============================================================*/
/* Nom de SGBD :  MySQL 5.0                                     */
/* Date de création :  14/07/2020 23:32:35                      */
/*==============================================================*/


drop table if exists COMPTE_BANQUE;

drop table if exists DOCUMENT;

drop table if exists SIGNATAIRES;

drop table if exists UTILISATEUR;

drop table if exists VILLE;

/*==============================================================*/
/* Table : COMPTE_BANQUE                                        */
/*==============================================================*/
create table COMPTE_BANQUE
(
   NUM_COMPTE           char(256) not null,
   CODE_VILLE           int,
   AGENCE               char(256),
   ADRESSE              char(256),
   primary key (NUM_COMPTE)
);

/*==============================================================*/
/* Table : DOCUMENT                                             */
/*==============================================================*/
create table DOCUMENT
(
   N_DOCUMENT           char(256) not null,
   NUM_COMPTE           char(256),
   DATE                 date,
   OBJECT               char(256),
   CIN_BEN              char(256),
   NOM_BEN_PC           char(256),
   NOM_BEN_MOR          char(256),
   RIB_BEN              char(256),
   OP_TYPE              char(256),
   DOC_MONTANT          float,
   primary key (N_DOCUMENT)
);

/*==============================================================*/
/* Table : SIGNATAIRES                                          */
/*==============================================================*/
create table SIGNATAIRES
(
   N_DOCUMENT           char(256) not null,
   EMAIL                char(256) not null,
   primary key (N_DOCUMENT, EMAIL)
);

/*==============================================================*/
/* Table : UTILISATEUR                                          */
/*==============================================================*/
create table UTILISATEUR
(
   EMAIL                char(256) not null,
   PASSWORD             char(256),
   ROLE                 int,
   primary key (EMAIL)
);

/*==============================================================*/
/* Table : VILLE                                                */
/*==============================================================*/
create table VILLE
(
   CODE_VILLE           int not null,
   NOM_VILLE            char(256),
   primary key (CODE_VILLE)
);

alter table COMPTE_BANQUE add constraint FK_REFERENCE_4 foreign key (CODE_VILLE)
      references VILLE (CODE_VILLE) on delete restrict on update restrict;

alter table DOCUMENT add constraint FK_REFERENCE_1 foreign key (NUM_COMPTE)
      references COMPTE_BANQUE (NUM_COMPTE) on delete restrict on update restrict;

alter table SIGNATAIRES add constraint FK_REFERENCE_2 foreign key (N_DOCUMENT)
      references DOCUMENT (N_DOCUMENT) on delete restrict on update restrict;

alter table SIGNATAIRES add constraint FK_REFERENCE_3 foreign key (EMAIL)
      references UTILISATEUR (EMAIL) on delete restrict on update restrict;

