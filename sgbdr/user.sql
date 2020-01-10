-- ===============================================================================================================
-- bd			: cinepassion38
-- type			: MySql V5.7.21 (WampServer 3.1.3)
-- auteur		: Christophe Goidin <christophe.goidin@ac-grenoble.fr> (lycée louise Michel - Grenoble)
-- rôle			: gestion des utilisateurs
-- création 	:
-- 		?  
-- modification	:
--      octobre 2018    modification du cartouche + commentaires
--						ajout d'une variable afin de stocker le mot de passe par défaut des utilisateurs
-- ===============================================================================================================

-- ===============================================================================================================
--   début de la transaction
-- ===============================================================================================================
START TRANSACTION;

-- ============================================================================
--   mot de passe par défaut
-- ============================================================================
SET @defautMotDePasse = "x";

-- ===============================================================================================================
--   création des tables                                
-- ===============================================================================================================
CREATE TABLE typeUser (
	numTypeUser							TINYINT UNSIGNED AUTO_INCREMENT							COMMENT "Le numéro du type d'utilisateur",
	libelleTypeUser						ENUM("administrateur", "membre", "visiteur") NOT NULL	COMMENT "Le libellé du type d'utilisateur",
	CONSTRAINT PK_TypeUser				PRIMARY KEY (numTypeUser)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8;

CREATE TABLE user (
	loginUser							VARCHAR(20)												COMMENT "Le login de l'utilisateur",
	motDePasseUser						VARCHAR(128) NOT NULL									COMMENT "Le mot de passe chiffré de l'utilisateur à l'aide de l'algorithme SHA2 512bits",
	prenomUser							VARCHAR(20) NOT NULL									COMMENT "Le prénom de l'utilisateur",
	nomUser								VARCHAR(20) NOT NULL									COMMENT "Le nom de l'utilisateur",
	dateNaissanceUser					DATE NOT NULL											COMMENT "La date de naissance de l'utilisateur",
	sexeUser							ENUM("H", "F") DEFAULT "H" NOT NULL						COMMENT "Le sexe de l'utilisateur : H ou F",
	adresseUser							VARCHAR(30)												COMMENT "L'adresse de l'utilisateur : Numéro de la voie, type de la voie et libellé de la voie",
	codePostalUser						VARCHAR(5)												COMMENT "Le code postal de l'utilisateur",
	villeUser							VARCHAR(20)												COMMENT "Le libellé de la ville de l'utilisateur",
	telephoneFixeUser					VARCHAR(10)												COMMENT "Le numéro de téléphone fixe de l'utilisateur",
	telephonePortableUser				VARCHAR(10)												COMMENT "Le numéro de téléphone portable de l'utilisateur",
	mailUser							VARCHAR(40) NOT NULL									COMMENT "L'adresse électronique de l'utilisateur",
	avatarUser							VARCHAR(20)												COMMENT "Le nom de l'avatar de l'utilisateur",
	nbTotalConnexionUser				INTEGER UNSIGNED DEFAULT 0 NOT NULL						COMMENT "Le nombre total de connexion de l'utilisateur",
	nbEchecConnexionUser				TINYINT UNSIGNED DEFAULT 0 NOT NULL						COMMENT "Le nombre d'échecs de connexion de l'utilisateur",
	dateHeureCreationUser				DATETIME NOT NULL										COMMENT "La date et l'heure de la création de l'utilisateur",
	dateHeureDerniereConnexionUser		DATETIME												COMMENT "La date et l'heure de la dernière connexion de l'utilisateur",
	typeUser							TINYINT UNSIGNED NOT NULL								COMMENT "Le numéro du type d'utilisateur",
	CONSTRAINT PK_User					PRIMARY KEY (loginUser),
	CONSTRAINT UK_TelephonePortableUser	UNIQUE KEY (telephonePortableUser),
	CONSTRAINT UK_MailUser				UNIQUE KEY (mailUser),
	CONSTRAINT FK_TypeUser				FOREIGN KEY (typeUser) REFERENCES typeUser(numTypeUser) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=UTF8;

-- ============================================================================
--   modification du délimiter
-- ============================================================================
DELIMITER //

-- ============================================================================
--   procédure stockée permettant l'ajout des utilisateurs
-- ============================================================================
CREATE PROCEDURE ajoutUser(IN pTypeUser ENUM("administrateur", "membre", "visiteur"),
						   IN pLoginUser VARCHAR(20),
						   IN pMotDePasseUser VARCHAR(20),
						   IN pPrenomUser VARCHAR(20),
						   IN pNomUser VARCHAR(20),
						   IN pDateNaissanceUser DATE, 
						   IN pSexeUser ENUM("H", "F"),
						   IN pAdresseUser VARCHAR(30),
						   IN pCodePostalUser VARCHAR(5),
						   IN pVilleUser VARCHAR(20),
						   IN pTelephoneFixeUser VARCHAR(10),
						   IN pTelephonePortableUser VARCHAR(10),
						   IN pMailUser VARCHAR(40),
						   IN pAvatarUser VARCHAR(20))
BEGIN
	INSERT INTO user VALUES (pLoginUser, SHA2(pMotDePasseUser, 512), pPrenomUser, pNomUser, pDateNaissanceUser, pSexeUser, pAdresseUser, pCodePostalUser, pVilleUser, pTelephoneFixeUser, pTelephonePortableUser, pMailUser, IF(pAvatarUser <> "?", pAvatarUser, IF(pSexeUser = "H", "H", "F")), 0, 0, SYSDATE(), null, (SELECT numTypeUser FROM typeUser WHERE libelleTypeUser = pTypeUser));
END //

-- ============================================================================
--   repositionnement du délimiteur à sa valeur initiale
-- ============================================================================
DELIMITER ;

-- ===============================================================================================================
--   insertion des type d'utilisateurs
-- ===============================================================================================================
INSERT INTO typeUser(libelleTypeUser) VALUES ("administrateur"), ("membre"), ("visiteur");

-- ===============================================================================================================
--   insertion des utilisateurs
-- ===============================================================================================================
CALL ajoutUser("administrateur","Admin",	@defautMotDePasse, "Kevin",		"Beaugoss",			"1995-08-19", "H", "14 rue des fringues",		"58410", "Jmelapette",			"0452535455", "0611221128", "KevinBioutifull38@gmail.com", 	"general");
CALL ajoutUser("membre",		"x01",		@defautMotDePasse, "Nordine",	"Ateur",			"1952-06-21", "H", "7 rue verte",				"38190", "Villard-Bonnot",		"0424203090", "0614523344", "x01@yahoo.com", 				"comics1");
CALL ajoutUser("membre",		"x02",		@defautMotDePasse, "Alain",		"Vairse",			"1989-05-17", "H", "10 Bd des Lilas",			"38420", "Domene",				"0420803435", "0617823344", "x02@yahoo.com",				"comics2");
CALL ajoutUser("membre",		"x03",		@defautMotDePasse, "Alain",		"Proviste",			"1984-04-27", "H", "124 rue bleue",		   		"38420", "Domene",				"0427208430", "0624266344", "x03@yahoo.com", 				"comics3");
CALL ajoutUser("membre",		"x04",		@defautMotDePasse, "Aline",		"Eha",				"1983-05-11", "F", "14bis avenue bobo",			"38190", "Villard-Bonnot",		"0420283040", "0675212344", "x04@yahoo.com", 				"comics4");
CALL ajoutUser("membre",		"x05",		@defautMotDePasse, "Alonzo",	"Toilette",			"1989-05-10", "H", "10 rue des pensées",		"38000", "Grenoble",			"0423203032", "0688223344", "x05@free.fr", 					"logan");
CALL ajoutUser("membre",		"x06",		@defautMotDePasse, "Alphonse",	"Leclou",			"1988-03-24", "H", "12 Bd victor Hugo",			"38000", "Grenoble",			"0420204439", "0632223694", "x06@yahoo.com", 				"Ood");
CALL ajoutUser("membre",		"x07",		@defautMotDePasse, "Amar",		"Diprochain",		"1993-05-27", "H", "17 Bd victor Hugo",			"38000", "Grenoble",			"0480293539", "0617223474", "x07@yahoo.com", 				"?");
CALL ajoutUser("membre",		"x08",		@defautMotDePasse, "Amédée",	"Lunettepourlire",	"1978-11-22", "H", "14 avenue des fleurs",		"38420", "Domene",				"0430243037", "0661223114", "x08@netcourrier.com", 			"erreurNormalement!");
CALL ajoutUser("membre",		"x09",		@defautMotDePasse, "Andy",		"Vojambon",			"1975-05-27", "H", "10 rue rouge",				"59000", "Lille",				"0399283035", "0654229844", "x09@netcourrier.com", 			"?");
CALL ajoutUser("membre",		"x10",		@defautMotDePasse, "Angèle",	"Labha",			"1985-10-28", "F", "15 allée des poux",			"75000", "Paris",				"0150783544", "0685223366", "x10@yahoo.com", 				"shadowCat");
CALL ajoutUser("membre",		"x11",		@defautMotDePasse, "Anna",		"Conda",			"1986-05-22", "F", "18 rue des losanges",		"38190", "Villard-Bonnot",		"0458993034", "0669223332", "x11@netcourrier.com", 			"avengersBlackWidow");
CALL ajoutUser("membre",		"x12",		@defautMotDePasse, "Anne-Laure","Ondanse",			"1999-09-29", "F", "11 allée de l'empire",		"38190", "Villard-Bonnot",		"0455874458", "0610223315", "x12@yahoo.com", 				"spiderWoman");
CALL ajoutUser("membre",		"x13",		@defautMotDePasse, "Annie",		"Versaire",			"1996-05-25", "F", "120 rue verte",				"38000", "Grenoble",			"0474458874", "0624223321", "x13@yahoo.com", 				"?");
CALL ajoutUser("membre",		"x14",		@defautMotDePasse, "Annie",		"Male",				"1975-08-30", "F", "8 chemin du fort",			"38420", "Domene",				"0445552114", "0640223547", "x14@yahoo.com", 				"?");
CALL ajoutUser("membre",		"x15",		@defautMotDePasse, "Alphonse",	"Kelpeuve",			"1978-08-27", "H", "99 chemin vert",			"38190", "Villard-Bonnot",		"0445552121", "0608223658", "x15@cegetel.net", 				"smith");
CALL ajoutUser("membre",		"x16",		@defautMotDePasse, "Armelle",	"Couvert",			"1989-04-03", "F", "8 rue de l'horloger",		"38190", "Villard-Bonnot",		"0454546688", "0605223212", "x16@yahoo.com", 				"barretWallace");
CALL ajoutUser("membre",		"x17",		@defautMotDePasse, "Armelle",	"Lapendulaleur",	"1989-05-23", "F", "15 av françois Mitterrand", "38190", "Villard-Bonnot",		"0420256560", "0647223555", "x17@cegetel.net", 				"araignee");
CALL ajoutUser("membre",		"x18",		@defautMotDePasse, "Aude",		"Javel",			"1984-04-05", "F", "45 chemin du bosquet",		"38000", "Grenoble",			"0424544588", "0635223988", "x18@yahoo.com", 				"cochon");
CALL ajoutUser("membre",		"x19",		@defautMotDePasse, "Barack",	"Afritt",			"1989-05-06", "H", "105 rue du fleuve bleu",	"38000", "Grenoble",			"0420208877", "0648223988", "x19@netcourrier.com", 			"cochon");
CALL ajoutUser("membre",		"x20",		@defautMotDePasse, "Benny",		"Soitil",			"1984-03-27", "H", "50 allée de la Chine",		"38000", "Grenoble",			"0424555455", "0681223488", "x20@yahoo.com", 				"crabe");
CALL ajoutUser("membre",		"x21",		@defautMotDePasse, "Cali",		"Fourchon",			"1989-05-30", "H", "20 av du général Leclerc",	"38190", "Villard-Bonnot",		"0427744551", "0641823344", "x21@netcourrier.com", 			"crocodile");
CALL ajoutUser("membre",		"x22",		@defautMotDePasse, "Carla",		"Jumid",			"1979-08-27", "F", "54 rue noire",				"38000", "Grenoble",			"0487445444", "0656623344", "x22@yahoo.com", 				"elephant");
CALL ajoutUser("membre",		"x23",		@defautMotDePasse, "César",		"Ienne",			"1989-05-02", "H", "54 allée des cartouches",	"38190", "Villard-Bonnot",		"0428756984", "0623623344", "x23@yahoo.com", 				"hippopotame");
CALL ajoutUser("membre",		"x24",		@defautMotDePasse, "Chris",		"Entème",			"1979-07-30", "H", "17 rue Maupassant",			"75002", "Paris",				"0154874452", "0687723344", "x24@yahoo.com", 				"mouton");
CALL ajoutUser("membre",		"x25",		@defautMotDePasse, "Claire",	"Voyant",			"1989-05-20", "F", "14 rue des îles",			"75001", "Paris",				"0125656544", "0644423344", "x25@yahoo.com", 				"pingouin");
CALL ajoutUser("membre",		"x26",		@defautMotDePasse, "Daisy",		"Rable",			"1992-02-17", "F", "02 chemin des glaçons",		"38190", "Villard-Bonnot",		"0420774587", "0611265144", "x26@yahoo.com", 				"poulet");
CALL ajoutUser("membre",		"x27",		@defautMotDePasse, "Elie",		"Minet",			"1983-05-20", "H", "04bis rue de Paris",		"38420", "Domene",				"0445219412", "0611221544", "x27@free.fr", 					"devil");
CALL ajoutUser("membre",		"x28",		@defautMotDePasse, "Ella",		"Toutpourplaire",	"1989-02-10", "F", "10 rue d'Alger",			"69000", "Lyon",				"0452488752", "0611220044", "x28@free.fr", 					"logoBatman");
CALL ajoutUser("membre",		"x29",		@defautMotDePasse, "Emma",		"Toufécela",		"1985-05-27", "F", "18 rue du soleil ",			"62100", "Calais",				"0321554445", "0671205544", "x29@yahoo.com", 				"zombie1");
CALL ajoutUser("membre",		"x30",		@defautMotDePasse, "Eva",		"Afonlakess",		"1989-12-27", "F", "14 rue des nuages",			"62100", "Calais",				"0321544485", "0681069449", "x30@yahoo.com", 				"zombie2");
CALL ajoutUser("membre",		"x31",		@defautMotDePasse, "Firmin",	"Peutagueule",		"1984-05-22", "H", "27 rue de Paris",			"69000", "Lyon",				"0454411245", "0661488344", "x31@yahoo.com", 				"zangief");
CALL ajoutUser("visiteur",		"x32",		@defautMotDePasse, "Henri",		"Gole",				"1979-10-05", "H", "15 allée des ploucs",		"75000", "Paris",				"0152211452", "0617652344", "x32@free.fr", 					"?");
CALL ajoutUser("visiteur",		"x33",		@defautMotDePasse, "Ines",		"Tétic",			"1978-05-04", "F", "19 chemin des anges",		"38000", "Grenoble",			"0498774447", "0731328745", "x33@yahoo.com", 				"?");
CALL ajoutUser("visiteur",		"x34",		@defautMotDePasse, "Jade",		"Orlapizza",		"1989-05-27", "F", "17 allée du diable",		"06000", "Nice",				"0422110001", "0614288346", "x34@free.fr", 					"?");
CALL ajoutUser("visiteur",		"x35",		@defautMotDePasse, "Jamie",		"Lepaquet",			"1989-11-30", "H", "174 rue de la mer",			"06000", "Nice",				"0487745521", "0615423548", "x35@yahoo.com", 				"?");
CALL ajoutUser("visiteur",		"x36",		@defautMotDePasse, "Jean",		"Peuplu",			"1980-05-27", "H", "11 rue du lac",				"74000", "Annecy",				"0432145524", "0681223652", "x36@free.fr", 					"?");
CALL ajoutUser("visiteur",		"x37",		@defautMotDePasse, "Jean-Loup",	"Pahune",			"1989-03-24", "H", "14 avenue du Parmelan",		"74000", "Annecy",				"0445225411", "0611223233", "x37@cegetel.net", 				"?");
CALL ajoutUser("visiteur",		"x38",		@defautMotDePasse, "Jerry",		"Tméladanse",		"1980-02-20", "H", "21 rue des montagnes",		"74000", "Annecy",				"0499652144", "0661223477", "x38@yahoo.com", 				"?");
CALL ajoutUser("visiteur",		"x39",		@defautMotDePasse, "John",		"Deuf",				"1989-05-07", "H", "19 chemin de la mer",		"62100", "Calais",				"0321998855", "0617223984", "x39@yahoo.com", 				"?");
CALL ajoutUser("visiteur",		"x40",		@defautMotDePasse, "Justin",	"Ptipeu",			"1977-04-23", "H", "41 rue de la frite",		"59000", "Lille",				"0320002566", "0681223621", "x40@free.fr", 					"?");
CALL ajoutUser("visiteur",		"x41",		@defautMotDePasse, "Karl",		"Age",				"1989-05-24", "H", "20 rue de la lune",			"59000", "Lille",				"0320099544", "0614223020", "x41@yahoo.com", 				"?");
CALL ajoutUser("visiteur",		"x42",		@defautMotDePasse, "Kelly",		"Vrogne",			"1978-03-23", "F", "74 av des diamants",		"38190", "Villard-Bonnot",		"0429885621", "0611223484", "x42@yahoo.com", 				"?");
CALL ajoutUser("visiteur",		"x43",		@defautMotDePasse, "Lara",		"Caille",			"1980-05-22", "F", "12 rue des triangles",		"74000", "Annecy",				"0432125412", "0645223310", "x43@gmail.com", 				"?");
CALL ajoutUser("visiteur",		"x44",		@defautMotDePasse, "Laurie",	"Kulère",			"1975-12-27", "F", "18 avenue du coeur",		"59000", "Lille",				"0321554128", "0681223666", "x44@yahoo.com", 				"?");
CALL ajoutUser("visiteur",		"x45",		@defautMotDePasse, "Line",		"Oxydable",			"1989-05-23", "F", "88 av mars",				"38190", "Villard-Bonnot",		"0422459547", "0651227845", "x45@yahoo.fr", 				"?");
CALL ajoutUser("visiteur",		"x46",		@defautMotDePasse, "Lorie",		"Zonlointain",		"1989-12-27", "F", "14 rue rose",				"59000", "Lille",				"0351001945", "0641224122", "x46@netcourrier.com", 			"?");
CALL ajoutUser("visiteur",		"x47",		@defautMotDePasse, "Marc",		"Assin",			"1987-05-17", "H", "27 rue Chaplin",			"73000", "Chambery",			"0478549478", "0619225448", "x47@gmail.com", 				"?");
CALL ajoutUser("visiteur",		"x48",		@defautMotDePasse, "Martial",	"Lacour",			"1989-12-27", "H", "12 bd de la nuit",			"38000", "Grenoble",			"0491949256", "0616221200", "x48@yahoo.com", 				"?");
CALL ajoutUser("visiteur",		"x49",		@defautMotDePasse, "Médé",		"Capote",			"1979-04-10", "H", "44 rue des mimosas",		"73000", "Chambery",			"0422594524", "0655221598", "x49@gmail.com", 				"?");
CALL ajoutUser("visiteur",		"x50",		@defautMotDePasse, "Mélanie",	"Maldanlacage",		"1981-05-27", "F", "17 avenue Mermoz",			"73000", "Chambery",			"0491947854", "0666223206", "x50@yahoo.fr", 				"?");
CALL ajoutUser("visiteur",		"x51",		@defautMotDePasse, "Mike",		"Rosoft",			"1979-05-23", "H", "14 chemin des frelons",		"73000", "Chambery",			"0432925144", "0618224589", "x51@yahoo.com", 				"?");
CALL ajoutUser("visiteur",		"x52",		@defautMotDePasse, "Nathan",	"Paskejelefasse",	"1988-04-28", "H", "18 rue des fraises",		"38190", "Villard-Bonnot",		"0425491234", "0671222125", "x52@yahoo.fr", 				"?");
CALL ajoutUser("visiteur",		"x53",		@defautMotDePasse, "Odette",	"Fairfasse",		"1989-05-27", "F", "10 rue des oranges",		"62100", "Calais",				"0321221948", "0615222266", "x53@yahoo.com", 				"?");
CALL ajoutUser("visiteur",		"x54",		@defautMotDePasse, "Olga",		"Tokilébon",		"1989-01-24", "F", "17 bd des melons",			"62100", "Calais",				"0312105445", "6112265870", "x54@cegetel.net", 				"?");
CALL ajoutUser("visiteur",		"x55",		@defautMotDePasse, "Pat",		"Réloin",			"1984-05-27", "H", "10 rue des cerises",		"38190", "Villard-Bonnot",		"0420203030", "0601224215", "x55@gmail.com", 				"?");
CALL ajoutUser("visiteur",		"x56",		@defautMotDePasse, "Patrice",	"Tounet",			"1983-01-10", "H", "17bis rue du bronzage",		"62100", "Calais",				"0321225491", "0681248999", "x56@yahoo.com", 				"?");
CALL ajoutUser("visiteur",		"x57",		@defautMotDePasse, "Paul",		"Icevopapier",		"1985-05-12", "H", "10 rue des haricots",		"38420", "Domene",				"0425225419", "0614265221", "x57@netcourrier.com",			"?");
CALL ajoutUser("visiteur",		"x58",		@defautMotDePasse, "Rémi",		"Sion",				"1979-08-14", "H", "14 rue des courgettes",		"38190", "Villard-Bonnot",		"0454954214", "0641478521", "x58@gmail.com", 				"?");

-- ===============================================================================================================
--   validation de la transaction
-- ===============================================================================================================
COMMIT;
