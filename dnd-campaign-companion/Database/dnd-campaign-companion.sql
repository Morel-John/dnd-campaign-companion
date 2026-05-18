DROP DATABASE IF EXISTS dnd_campaign_companion;

CREATE DATABASE dnd_campaign_companion;
USE dnd_campaign_companion;

CREATE TABLE user(
	userId					INTEGER		PRIMARY KEY AUTO_INCREMENT,
	username				VARCHAR(50) UNIQUE
);

CREATE TABLE town(
	townId					INTEGER 	PRIMARY KEY AUTO_INCREMENT,
	townname				VARCHAR(50) UNIQUE
);

CREATE TABLE sourcebook(
	bookId					INTEGER 	PRIMARY KEY AUTO_INCREMENT,
	bookname				VARCHAR(50) NOT NULL
);

CREATE TABLE parentrace(
	parentraceId			INTEGER 	PRIMARY KEY AUTO_INCREMENT,
	parentracename			VARCHAR(50) NOT NULL,
	
	bookId					INTEGER,
	
	FOREIGN KEY (bookId) 				REFERENCES sourcebook(bookId)
);

CREATE TABLE race(
	raceId					INTEGER		PRIMARY KEY AUTO_INCREMENT,
	racename				VARCHAR(50) UNIQUE,
	
	parentraceId			INTEGER,
	bookId					INTEGER,
	
	FOREIGN KEY (bookId) 				REFERENCES sourcebook(bookId),
	FOREIGN KEY (parentraceId)			REFERENCES parentrace(parentraceId)
);

CREATE TABLE profession(
	professionId			INTEGER		PRIMARY KEY AUTO_INCREMENT,
	professionname			VARCHAR(50) UNIQUE
);

CREATE TABLE class(
	classId					INTEGER		PRIMARY KEY AUTO_INCREMENT,
	classname				VARCHAR(50) UNIQUE,
	
	bookId					INTEGER,
	
	FOREIGN KEY (bookId) 				REFERENCES sourcebook(bookId)
);

CREATE TABLE subclass(
	subclassId				INTEGER		PRIMARY KEY AUTO_INCREMENT,
	subclassname			VARCHAR(50) UNIQUE,
	
	classId					INTEGER,
	bookId					INTEGER,
	
	FOREIGN KEY (bookId) 				REFERENCES sourcebook(bookId),
	FOREIGN KEY (classId)				REFERENCES class(classId)
);

CREATE TABLE alignment(
	alignmentId				INTEGER		PRIMARY KEY AUTO_INCREMENT,
	alignmentname			VARCHAR(50) UNIQUE
);

CREATE TABLE status(
	statusId				INTEGER		PRIMARY KEY AUTO_INCREMENT,
	statusname				VARCHAR(50) UNIQUE
);

CREATE TABLE size(
	sizeId					INTEGER		PRIMARY KEY AUTO_INCREMENT,
	sizename				VARCHAR(50) UNIQUE,
	image					VARCHAR(255)DEFAULT '../public/assets/img/npc/default2.png'
);

CREATE TABLE npc (
	npcId					INTEGER		PRIMARY KEY AUTO_INCREMENT,
	npcname					VARCHAR(50) UNIQUE,	
	information				VARCHAR(1000),
	image					VARCHAR(255)DEFAULT '../public/assets/img/npc/default.png',
	
	townId					INTEGER		DEFAULT 1,
	parentraceId					INTEGER		DEFAULT 1,
	professionId			INTEGER		DEFAULT 1,
	classId					INTEGER		DEFAULT 1,
	statusId				INTEGER		DEFAULT 1,
	alignmentId				INTEGER		DEFAULT 1,	
	sizeId					INTEGER		DEFAULT 1,
	
	FOREIGN KEY (townId)				REFERENCES town(townId),
	FOREIGN KEY (parentraceId)			REFERENCES parentrace(parentraceId),
	FOREIGN KEY (professionId)			REFERENCES profession(professionId),
	FOREIGN KEY (classId)				REFERENCES class(classId),
	FOREIGN KEY (alignmentId)			REFERENCES alignment(alignmentId),
	FOREIGN KEY (statusId)				REFERENCES status(statusId),
	FOREIGN KEY (sizeId)				REFERENCES size(sizeId)
);

CREATE TABLE quest (
	questId					INTEGER		PRIMARY KEY AUTO_INCREMENT,
	questname				VARCHAR(50),
	questdescription		VARCHAR(200),
	reward					VARCHAR(100),
	
	# userId				VARCHAR(50), 
	# User in der Datenbank anlegen oder wird das durch PHP hinzugefügt?
	
	npcId					INTEGER,	# Questgiver
	townId					INTEGER,
	statusId				INTEGER 	DEFAULT 1,
	
	FOREIGN KEY(npcId)					REFERENCES npc(npcId),
	FOREIGN KEY(townId)					REFERENCES town(townId),
	FOREIGN KEY (statusId)				REFERENCES status(statusId)
);

CREATE TABLE npc_quest(
	npc_questId				INTEGER		PRIMARY KEY AUTO_INCREMENT,
	
	npcId					INTEGER,
	questId					INTEGER,
	
	FOREIGN KEY (npcId)					REFERENCES npc(npcId),
	FOREIGN KEY (questId)				REFERENCES quest(questId)
);

CREATE TABLE logbook(
	logbookId				INTEGER		PRIMARY KEY AUTO_INCREMENT,
	date					DATE,
	title					VARCHAR(50),
	story					VARCHAR(500),
	image					VARCHAR(255)DEFAULT '../public/assets/img/logbook/default.jpg'
);
#########################################################################################
#########################################################################################
#########################################################################################
#########################################################################################

############################## Optionale Ziele ##########################################
/* 
CREATE TABLE note(
	noteId					INTEGER		PRIMARY KEY AUTO_INCREMENT,
	notefield				VARCHAR(200),
	
	userId					INTEGER,
	
	FOREIGN KEY (userId)				REFERENCES user(userId)
);
*/

#########################################################################################
#########################################################################################
#########################################################################################
#########################################################################################

################################### data input ##########################################

INSERT INTO user (username)
	VALUES 
	('admin'),
	('user_one'),
	('user_two');

INSERT INTO town (townname)
	VALUES 
	('Unknown'),
	('Auraigis'),
	('Dämmerwald'),
	('Kenabres'),
	('Hochschmiere'),
	('Iz'),
	('Sarkosis'),
	('Morgenröte'),
	('Blutröte');

INSERT INTO sourcebook (bookname)
VALUES
	# Placeholder
	("Unknown"),
	# Core Rulebooks (IDs 2-7)
	("Player's Handbook (2014)"),
	("Monster Manual (2014)"),
	("Dungeon Master's Guide (2014)"),
	("Player's Handbook (2024)"),
	("Dungeon Master's Guide (2024)"),
	("Monster Manual (2025)"),
	# Rule Supplements (IDs 8-13)
	("Xanathar's Guide to Everything"),
	("Tasha's Cauldron of Everything"),
	("Monsters of the Multiverse"), 
	("Fizban's Treasury of Dragons"),
	("Bigby Presents: Glory of the Giants"),
	("The Book of Many Things"),
	# Campaign Settings (IDs 14-24)
	("Sword Coast Adventurer's Guide"),
	("Guildmasters' Guide to Ravnica"),
	("Acquisitions Incorporated"), 
	("Eberron: Rising from the Last War"), 
	("Explorer's Guide to Wildemount"),
	("Mythic Odysseys of Theros"),
	("Van Richten's Guide to Ravenloft"),
	("Strixhaven: A Curriculum of Chaos"),
	("Spelljammer: Adventures in Space"),
	("Dragonlance: Shadow of the Dragon Queen"),
	("Planescape: Adventures in the Multiverse"),  
	# Adventure Modules (IDs 25-42)
	("Hoard of the Dragon Queen"),
	("The Rise of Tiamat"),
	("Princes of the Apocalypse"),
	("Out of the Abyss"),
	("Curse of Strahd"),
	("Storm King's Thunder"),
	("Tales from the Yawning Portal"),
	("Tomb of Annihilation"),
	("Waterdeep: Dragon Heist"),
	("Waterdeep: Dungeon of the Mad Mage"),
	("Ghosts of Saltmarsh"),
	("Baldur's Gate: Descent into Avernus"),
	("Icewind Dale: Rime of the Frostmaiden"),
	("Candlekeep Mysteries"),
	("The Wild Beyond the Witchlight"),
	("Critical Role: Call of the Netherdeep"),
	("Journeys through the Radiant Citadel"),
	("Keys from the Golden Vault"),
	("Phandelver and Below: The Shattered Obelisk"),
	("Vecna: Eve of Ruin"),
	("Quests from the Infinite Staircase");
	
INSERT INTO parentrace (parentracename, bookId)	
	VALUES
	# Placeholder
	("Unknown", 1),
	# IDs 2-10 (Common)
	("Dragonborn", 1),
	("Dwarf", 1),
	("Elf", 1),
	("Gnome", 1),
	("Half-Elf", 1),
	("Half-Orc", 1),
	("Halfling", 1),
	("Human", 1),
	("Tiefling", 1),
	# IDs 11-27 (Exotic)
	("Aarakocra", 9),
	("Aasimar", 9),
	("Changeling", 16),
	("Fairy", 38),
	("Firbolg", 9),
	("Genasi", 9),
	("Gith", 9),
	("Goliath", 9),
	("Harengon", 38),
	("Kenku", 9),
	("Locathah", 34),
	("Owlin", 20),
	("Satyr", 9),
	("Tabaxi", 9),
	("Tortle", 9),
	("Triton", 9),
	("Verdan", 15),
	# IDs 28-38 (Monstrous)
	("Bugbear", 9),
	("Centaur", 9),
	("Goblin", 9),
	("Grung", 1),
	("Hobgoblin", 9),
	("Kobold", 9),
	("Lizardfolk", 9),
	("Minotaur", 9),
	("Orc", 9),
	("Shifter", 16),
	("Yuan-Ti", 9),
	# Special
	("Demon",1),
	("God",1);
	
INSERT INTO race (racename,parentraceId,bookId)
	VALUES
	# Placeholder
	("Unknown", 1, 1),
	# Unterrassen (Referenzen angepasst: Dwarf=3, Elf=4, Gnome=5, Halfling=8)
	("Hill Dwarf", 3, 1),
	("Mountain Dwarf", 3, 1),
	("Duergar", 3, 9),
	("High Elf", 4, 1),
	("Wood Elf", 4, 1),
	("Drow", 4, 1),
	("Eladrin", 4, 9),
	("Sea Elf", 4, 9),
	("Shadar-Kai", 4, 9),
	("Forest Gnome", 5, 1),
	("Rock Gnome", 5, 1),
	("Deep Gnome", 5, 9),
	("Lightfoot Halfling", 8, 1),
	("Stout Halfling", 8, 1),
	# Varianten (Referenzen angepasst: Genasi=16, Gith=17)
	("Genasi (Air)", 16, 9),
	("Genasi (Earth)", 16, 9),
	("Genasi (Fire)", 16, 9),
	("Genasi (Water)", 16, 9),
	("Githyanki", 17, 9),
	("Githzerai", 17, 9),
	# Basis-Einträge (Mappen 1:1 auf die neue parentraceId)
	("Dragonborn", 2, 1),
	("Half-Elf", 6, 1),
	("Half-Orc", 7, 1),
	("Human", 9, 1),
	("Tiefling", 10, 1),
	("Aarakocra", 11, 9),
	("Aasimar", 12, 9),
	("Changeling", 13, 16),
	("Fairy", 14, 38),
	("Firbolg", 15, 9),
	("Goliath", 18, 9),
	("Harengon", 19, 38),
	("Kenku", 20, 9),
	("Locathah", 21, 34),
	("Owlin", 22, 20),
	("Satyr", 23, 9),
	("Tabaxi", 24, 9),
	("Tortle", 25, 9),
	("Triton", 26, 9),
	("Verdan", 27, 15),
	("Bugbear", 28, 9),
	("Centaur", 29, 9),
	("Goblin", 30, 9),
	("Grung", 31, 1),
	("Hobgoblin", 32, 9),
	("Kobold", 33, 9),
	("Lizardfolk", 34, 9),
	("Minotaur", 35, 9),
	("Orc", 36, 9),
	("Shifter", 37, 16),
	("Yuan-Ti", 38, 9),
	# Special
	("Demon",39,1),
	("God",40,1);
	
INSERT INTO profession (professionname)
	VALUES
	# Placeholder
	("Unknown"),
	# Crafting & Trades
	("Blacksmith"),
	("Carpenter"),
	("Mason"),
	("Tanner"),
	("Weaver"),
	("Tailor"),
	("Cobbler"),
	("Glassblower"),
	("Brewer"),
	("Jeweler"),
	("Potter"),
	("Cooper"),
	# Service & Daily Life
	("Baker"),
	("Innkeeper"),
	("Stablehand"),
	("Cook"),
	("Messenger"),
	("Barber"),
	("Caretaker"),
	("Washer"),
	("Wainwright"),
	("Teamster"),
	# Civic & Security
	("Town Guard"),
	("Bailiff"),
	("Ratcatcher"),
	("Sewer Worker"),
	("Executioner"),
	("Tax Collector"),
	("Night Watchman"),
	("Gaoler"),
	# Scholarly & Alchemical
	("Alchemist"),
	("Scribe"),
	("Cartographer"),
	("Apothecary"),
	("Librarian"),
	("Herbalist"),
	("Bookbinder"),
	# Nature & Resources
	("Hunter"),
	("Fisherman"),
	("Miner"),
	("Merchant"),
	("Lumberjack"),
	("Shepherd"),
	("Farmer"),
	("Beekeeper"),
	("Gravedigger"),
	# Maritime & Travel
	("Sailor"),
	("Shipwright"),
	("Navigator"),
	("Dockhand"),
	# Fantasy Specific (Bonus)
	("Spell-scribe"),
	("Component Merchant"),
	("Portal Attendant"),
	("Golem Mechanic"),
	("Stablemaster of Exotic Mounts");
	
INSERT INTO class (classname, bookId)
VALUES
    ("Unknown", 1),       -- ID 1
    ("Barbarian", 2),     -- ID 2
    ("Bard", 2),          -- ID 3
    ("Cleric", 2),        -- ID 4
    ("Druid", 2),         -- ID 5
    ("Fighter", 2),       -- ID 6
    ("Monk", 2),          -- ID 7
    ("Paladin", 2),       -- ID 8
    ("Ranger", 2),        -- ID 9
    ("Rogue", 2),         -- ID 10
    ("Sorcerer", 2),      -- ID 11
    ("Warlock", 2),       -- ID 12
    ("Wizard", 2),        -- ID 13
    ("Artificer", 9);
    
INSERT INTO subclass (subclassname, classId, bookId)
VALUES
	# Placeholder
    ("Unknown", 1, 1),
    # Barbarian (Class ID 2)
    ("Path of the Berserker", 2, 2),
    ("Path of the Totem Warrior", 2, 2),
    ("Path of the Ancestral Guardian", 2, 8),
    ("Path of the Zealot", 2, 8),
    ("Path of the Beast", 2, 9),
    # Bard (Class ID 3)
    ("College of Lore", 3, 2),
    ("College of Valor", 3, 2),
    ("College of Glamour", 3, 8),
    ("College of Swords", 3, 8),
    ("College of Eloquence", 3, 9),
    # Cleric (Class ID 4)
    ("Life Domain", 4, 2),
    ("Light Domain", 4, 2),
    ("War Domain", 4, 2),
    ("Forge Domain", 4, 8),
    ("Grave Domain", 4, 8),
    ("Twilight Domain", 4, 9),
    # Druid (Class ID 5)
    ("Circle of the Land", 5, 2),
    ("Circle of the Moon", 5, 2),
    ("Circle of Dreams", 5, 8),
    ("Circle of Spores", 5, 9),
    ("Circle of Stars", 5, 9),
    # Fighter (Class ID 6)
    ("Champion", 6, 2),
    ("Battle Master", 6, 2),
    ("Eldritch Knight", 6, 2),
    ("Arcane Archer", 6, 8),
    ("Samurai", 6, 8),
    ("Psi Warrior", 6, 9),
    # Monk (Class ID 7)
    ("Way of the Open Hand", 7, 2),
    ("Way of Shadow", 7, 2),
    ("Way of the Drunken Master", 7, 8),
    ("Way of the Kensei", 7, 8),
    ("Way of Mercy", 7, 9),
    # Paladin (Class ID 8)
    ("Oath of Devotion", 8, 2),
    ("Oath of the Ancients", 8, 2),
    ("Oath of Vengeance", 8, 2),
    ("Oath of Conquest", 8, 8),
    ("Oath of Glory", 8, 9),
    # Ranger (Class ID 9)
    ("Hunter", 9, 2),
    ("Beast Master", 9, 2),
    ("Gloom Stalker", 9, 8),
    ("Horizon Walker", 9, 8),
    ("Fey Wanderer", 9, 9),
    # Rogue (Class ID 10)
    ("Thief", 10, 2),
    ("Assassin", 10, 2),
    ("Arcane Trickster", 10, 2),
    ("Swashbuckler", 10, 8),
    ("Inquisitive", 10, 8),
    ("Soulknife", 10, 9),
    # Sorcerer (Class ID 11)
    ("Draconic Bloodline", 11, 2),
    ("Wild Magic", 11, 2),
    ("Divine Soul", 11, 8),
    ("Aberrant Mind", 11, 9),
    ("Clockwork Soul", 11, 9),
    # Warlock (Class ID 12)
    ("The Archfey", 12, 2),
    ("The Fiend", 12, 2),
    ("The Hexblade", 12, 8),
    ("The Celestial", 12, 8),
    ("The Genie", 12, 9),
    # Wizard (Class ID 13)
    ("School of Evocation", 13, 2),
    ("School of Abjuration", 13, 2),
    ("School of Necromancy", 13, 2),
    ("War Magic", 13, 8),
    ("Bladesinging", 13, 9),
    ("Order of Scribes", 13, 9),
    # Artificer (Class ID 14)
    ("Alchemist", 14, 9),
    ("Armorer", 14, 9),
    ("Artillerist", 14, 9),
    ("Battle Smith", 14, 9);
    
INSERT INTO alignment (alignmentname)
	VALUES
	('Unknown'),
	('Friend'),
	('Enemy');

INSERT INTO status (statusname)
	VALUES
	('Unknown'),
	('Alive'),
	('Dead'),
	('In progress'),
	('Active'),
	('Completed'),
	('Missed');

INSERT INTO size (sizename,image)
	VALUES
	('Medium','../public/assets/img/size/medium.png'),
	('Tiny','../public/assets/img/size/tiny.png'),
	('Large','../public/assets/img/size/large.png'),
	('Huge','../public/assets/img/size/huge.png'),
	('Gargantuan','../public/assets/img/size/gargantuan.png');

INSERT INTO npc (npcname, parentraceId, professionId, classId, statusId, alignmentId, sizeId, townId, information, image)
	VALUES
	('Amros der Wall'		,22,	24,			8,		3,		2,		  1,		2,"Died in the last fight...",'../public/assets/img/npc/01_Amros_der_Wall.PNG'),
	('Bruder Tristian', 	 9, DEFAULT, DEFAULT, DEFAULT, 2, DEFAULT,DEFAULT, "DEFAULT",'../public/assets/img/npc/02_Bruder_Tristian.png'),
	('Kelly Kupferblatt', 	 	DEFAULT, DEFAULT, DEFAULT, 2, DEFAULT, DEFAULT,DEFAULT, "DEFAULT",'../public/assets/img/npc/03_Kelly_Kupferblatt.PNG'),
	('Morfeus',  			 9, DEFAULT, DEFAULT, DEFAULT, 2, DEFAULT,DEFAULT, "DEFAULT",'../public/assets/img/npc/04_Morfeus.jpg'),
	('Peter Humanoid', 		 2, DEFAULT, DEFAULT, DEFAULT, 2, DEFAULT,DEFAULT, "DEFAULT",'../public/assets/img/npc/05_Peter_Humanoid.PNG'),
	('Priscilla', 			 9, DEFAULT, DEFAULT, DEFAULT, DEFAULT, DEFAULT,DEFAULT, "DEFAULT",'../public/assets/img/npc/06_Priscilla.jpg'),
	('Rhiannon Argynvost',	 4, DEFAULT, DEFAULT, DEFAULT, 2, DEFAULT,DEFAULT, "DEFAULT",'../public/assets/img/npc/07_Rhiannon_Argynvost.PNG'),
	('Sonya Blutkessel', 	 9, DEFAULT, DEFAULT, DEFAULT, 2, DEFAULT,DEFAULT, "DEFAULT",'../public/assets/img/npc/08_Sonya_Blaukessel.jpg'),
	('Staunton Vhane', 		 9, DEFAULT, DEFAULT, DEFAULT, DEFAULT, DEFAULT,DEFAULT, "DEFAULT",'../public/assets/img/npc/09_Staunton_Vhane.PNG'),
	('Tauriel', 			 10, DEFAULT, DEFAULT, DEFAULT, 2, DEFAULT,DEFAULT, "DEFAULT",'../public/assets/img/npc/10_Tauriel.jpg'),
	('Triks Risk Iktis', 	 33, DEFAULT, DEFAULT, DEFAULT, 2, DEFAULT,DEFAULT, "DEFAULT",'../public/assets/img/npc/11_Triks_Risk_Iktis.jpg'),
	('Tyrilla Federschwung', 22, DEFAULT, DEFAULT, DEFAULT, 2, DEFAULT,DEFAULT, "DEFAULT",'../public/assets/img/npc/12_Tyrilla_Federschwung.png'),
	('Dreskari', 			 39, DEFAULT, DEFAULT, DEFAULT, 3, DEFAULT,DEFAULT, "DEFAULT",'../public/assets/img/npc/13_Dreskari.PNG'),
	('Ignir', 				 39, DEFAULT, DEFAULT, DEFAULT, 3, DEFAULT,DEFAULT, "DEFAULT",'../public/assets/img/npc/14_Ignir.jpg'),
	('Minagho', 			 39, DEFAULT, DEFAULT, DEFAULT, 3, DEFAULT,DEFAULT, "DEFAULT",'../public/assets/img/npc/15_Minagho.PNG'),
	('Vulgrim', 			 39, 53, 	  DEFAULT, DEFAULT, 3, DEFAULT,DEFAULT, "DEFAULT",'../public/assets/img/npc/16_Vulgrim.png'),
	('Fendruh', 			 23, DEFAULT, DEFAULT, DEFAULT, DEFAULT, DEFAULT,DEFAULT, "DEFAULT",'../public/assets/img/npc/19_Fendruh.jpg'),
	('Schmerzschmied', 		 39, DEFAULT, DEFAULT, 3, 3, DEFAULT,DEFAULT, "DEFAULT",'../public/assets/img/npc/20_Schmerzschmied.png'),
	('Bob', 				 9, DEFAULT, DEFAULT, DEFAULT, 2, DEFAULT,DEFAULT, "DEFAULT",'../public/assets/img/npc/21_Bob.png'),
	('Can', 				 36, DEFAULT, DEFAULT, DEFAULT, 2, DEFAULT,DEFAULT, "DEFAULT",'../public/assets/img/npc/22_Can.PNG'),
	('Deckart_Cain', 		 9, DEFAULT, DEFAULT, DEFAULT, 2, DEFAULT,DEFAULT, "DEFAULT",'../public/assets/img/npc/23_Deckart_Cain.jpg'),
	('Draka', 				 36, DEFAULT, DEFAULT, DEFAULT, 2, DEFAULT,DEFAULT, "DEFAULT",'../public/assets/img/npc/24_Paladin_Draka.PNG'),
	('Lachir', 				 10, DEFAULT, DEFAULT, DEFAULT, DEFAULT, DEFAULT,DEFAULT, "DEFAULT",'../public/assets/img/npc/25_Lachir.jpg'),
	('Nenio', 				 9, DEFAULT, DEFAULT, DEFAULT, DEFAULT, DEFAULT,DEFAULT, "DEFAULT",'../public/assets/img/npc/26_Nenio.png'),
	('Riss', 				 DEFAULT, DEFAULT, DEFAULT, 2, DEFAULT, DEFAULT,DEFAULT, "DEFAULT",'../public/assets/img/npc/27_Riss.jpg'),
	('Yuki', 				 22, DEFAULT, DEFAULT, DEFAULT, 2, DEFAULT,DEFAULT, "DEFAULT",'../public/assets/img/npc/28_Yuki.PNG'),
	('Arenameister', 		 39, DEFAULT, DEFAULT, DEFAULT, 3, DEFAULT,DEFAULT, "DEFAULT",'../public/assets/img/npc/29_Arenameister.jpg');

INSERT INTO quest (questname, questdescription, reward, npcId, townId, statusId) 
VALUES
    ('The Lost Amulet Scroll', 'Locate the stolen amulet of the ancient priestess within the Dark Forest. Danger lurks behind every tree.', '100 Gold Pieces, 1 Healing Potion', 14, 3, DEFAULT),
    ('Rescue of the Villagers', 'Free the villagers abducted by bandits to the north. Time is short, and the threat is dire.', '150 Gold Pieces, +1 Longsword', 7, 8, DEFAULT),
    ('The Stolen Scroll', 'A priceless scroll has been purloined from the Mages'' Library. Recover it before dark magic is unleashed.', '200 Gold Pieces, Potion of Magic', 22, 1, DEFAULT),
    ('Cursed Treasure', 'Explore the ancient ruins, retrieve the treasure, and break the foul curse laid upon it. Beware of traps and undead.', '300 Gold Pieces, Ring of Resistance', 1, 5, DEFAULT),
    ('Monster Hunter Contract', 'Slay the savage chimera terrorizing the trade routes. It strikes under the cover of night and is extremely lethal.', '250 Gold Pieces, +2 Bow', 27, 9, DEFAULT), 
    ('The Missing Merchant', 'A prominent merchant has vanished without a trace. Track him down in the mires and secure his cargo.', '150 Gold Pieces, 1 Healing Potion', 11, 2, DEFAULT),
    ('The Purloined Crystal', 'The precious crystals of the Tower of Arcane have been stolen. Hunt down the thief and return the gems.', '200 Gold Pieces, Spell Component', 5, 6, DEFAULT),
    ('Freeing the Prisoner', 'Rescue the captured blacksmith from the raiders'' dungeon. He holds vital intelligence regarding hidden hoards.', '100 Gold Pieces, +1 Smithing Tools', 19, 4, DEFAULT),
    ('Ghostly Apparition', 'Investigate the ancestral manor and exorcise the spirits terrorizing the inhabitants. Beware of illusions.', '150 Gold Pieces, Amulet of Protection', 3, 7, DEFAULT),
    ('The Vanished Caravan', 'A supply caravan has gone missing in the mountain passes. Locate it and bring the goods back safely.', '200 Gold Pieces, 1 Healing Potion', 18, 5, DEFAULT);

INSERT INTO npc_quest(npcId, questId) 
	VALUES
	(1, 2),  
	(2, 3),  
	(3, 5),  
	(4, 1),  
	(5, 6),  
	(6, 4),
	(7, 7),  
	(8, 9),  
	(9, 10), 
	(10, 8); 

INSERT INTO logbook (date, title, story, image) VALUES 
(
    '2024-05-01', 
    'Der Aufbruch in Oakhaven', 
    'Die Gruppe traf sich im "Tänzelnden Pony". Der Wirt berichtete von seltsamen Geräuschen im Keller. Nach einer kurzen Untersuchung entdeckten die Helden ein Nest von Riesenratten und einen geheimen Tunnel, der tief unter die Stadt führt. Sie fanden eine alte Karte, die auf ein vergessenes Grab hinweist.',
    DEFAULT
),
(
    '2024-05-08', 
    'Das Grab des vergessenen Königs', 
    'Tief in den Tunneln unter Oakhaven stießen die Abenteurer auf eine uralte Gruft. Skelettkrieger bewachten den Eingang. Nach einem harten Kampf konnte die Gruppe ein mysteriöses Amulett bergen, das seltsam in der Dunkelheit leuchtet. Grog der Riese wäre beinahe in eine Fallgrube gestürzt.',
    DEFAULT
),
(
    '2024-05-15', 
    'Verrat in der Hauptstadt', 
    'Die Gruppe erreichte die Hauptstadt, um das Amulett untersuchen zu lassen. Dort wurden sie jedoch von Stadtwachen abgefangen. Ein unbekannter Adliger scheint ein großes Interesse an ihrem Fund zu haben. Er bot ihnen Schutz an, doch die Gruppe traut seinem Lächeln nicht. Werden sie sein Angebot annehmen?',
    DEFAULT
);
SELECT n.npcname, t.townname, c.classname,po.professionname, pr.parentracename, a.alignmentname, s.statusname, si.sizename, n.npcId, n.image
FROM npc as n
JOIN town as t on t.townId=n.townId
JOIN class as c on c.classId=n.classId
JOIN profession as po on po.professionId = n.professionId
JOIN parentrace as pr on pr.parentraceId = n.parentraceId
JOIN alignment as a on a.alignmentId=n.alignmentId
JOIN status as s on s.statusId=n.statusId
JOIN size as si on si.sizeId=n.sizeId
