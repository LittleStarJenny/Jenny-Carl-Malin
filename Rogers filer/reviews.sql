-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2019 at 10:40 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jennydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `revId` int(11) NOT NULL,
  `reviewText` text,
  `reviewScore` varchar(3) NOT NULL DEFAULT '0',
  `reviewDate` date NOT NULL DEFAULT '2000-01-01',
  `bookId` int(11) NOT NULL,
  `reviewAuthor` varchar(64) NOT NULL DEFAULT 'Agda Grinigsson'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`revId`, `reviewText`, `reviewScore`, `reviewDate`, `bookId`, `reviewAuthor`) VALUES
(1, 'The first book is Harry Potter and the Philosopher\'s Stone. The story starts with Number 4 Privet Drive about a boy called Harry Potter who lives in the cupboard under the stairs of a house owned by Mr and Mrs Dursley with their overly spoiled son called Dudley. In the fist quarter of the book it shows how Harry begins to receive letters which are addressed to him, in his cupboard and at the top of the letter a crest show the letters S,G,R AND H embellished with a snake, a griffin, an eagle and a badger. Even though this alone sounds mysterious Mr and Mrs Dursley don\'t allow him to read the letters and will go to any length to stop him. As the book progresses The Dursleys go away to a hut in the middle of the ocean to ensure no letters can arrive, but at midnight (before Harry\'s birthday) a giant of a man, later on to be recognised as Hagrid, bursts in and tells Harry he\'s a wizard! Hagrid also tells Harry how he came to live at Privet Drive as his parents were murdered by the Dark Lord, Lord Voldemort. He also gives Harry the letter he had been hoping for for weeks it includes a letter to say that Harry will be attending Hogwarts school for Witchcraft and Wizardry and a list of essentials for his year ahead.', '5', '2000-01-01', 1, 'Agda Grinigsson'),
(2, 'One Ring to rule them all, One Ring to find them, One Ring to bring them all and in the darkeness bind them\r\n\r\nIn ancient times the Rings of Power were crafted by the Elven-smiths, and Sauron, The Dark Lord, forged the One Ring, filling it with his own power so that he could rule all others. But the One Ring was taken from him, and though he sought it throughout Middle-earth, it remained lost to him. After many ages it fell into the hands of Bilbo Baggins, as told in The Hobbit.\r\n\r\nIn a sleepy village in the Shire, young Frodo Baggins finds himself faced with an immense task, as his elderly cousin Bilbo entrusts the Ring to his care. Frodo must leave his home and make a perilous journey across Middle-earth to the Cracks of Doom, there to destroy the Ring and foil the Dark Lord in his evil purpose.', '5', '2000-01-01', 2, 'Agda Grinigsson'),
(3, 'This is probably one of the most boring book I\'ve ever read!\r\nI think it would be nice to read for your small children as a bedtime story but not for anything else. I had to read the whole book since it was a school thing and I died of boredom several times while reading it. Then everytimne I died Mio came and resurrected me ,and I died again, and he resurrected me, and i died and so on...\r\nNothing really happens in the book except Mio riding around with his extremely annoying friend Jum-Jum!\r\nDon\'t read this book!', '1', '2012-08-13', 3, 'Agda Grinigsson'),
(4, 'After years of being behind the times, I’m finally making an effort to read all the Harry Potter books for the first time. My experience with THE PHILOSOPHER’S STONE was pleasant. THE CHAMBER OF SECRETS was also charming, but I don’t think I’ve connected with the book as well as I did the first book which is making this review frustratingly difficult to write.\r\n\r\nMy lack of connection with the story may not necessarily be because the novel was mediocre. Like I said I enjoyed it. I’m 90% certain the main reason I had issues was because I mostly listened while driving and before falling asleep at night. My car is surprisingly noisy and falling asleep while listening meant I missed things. Missing elements of a plot is never helpful.\r\n\r\nLack of connection is the only complaint I’ve had. The direction the series is starting to take is really intriguing. The characters are starting to get more morally ambiguous and complicated. The writing itself is charming and easy to follow.\r\n\r\nHARRY POTTER AND THE CHAMBER OF SECRETS was a nice read, but I wasn’t in love with it. I imagine this feeling is mostly due to my connection issues. The story, writing, and narration continue to be incredibly enjoyable but I still wish things were a little darker. I look forward to starting THE PRISONER OF AZKABAN as soon as possible.', '4', '2015-11-20', 4, 'Agda Grinigsson'),
(5, 'For as long as I can remember, I have loved serial fiction and saga stories. The Lord of the Rings trilogy and associated books by J.R.R. Tolkien are a treasure. I first found the books when I was 14 and had to re-read again when the movies came out in the last decade or so. The second book, The Two Towers, was a worth follow-up, enhancing every original love I had with the story. I\'m generally not a fan of the fantasy genre, and have only read perhaps 20 books in total, less than 3% of my entire reading history. But something about these books absolutely stands out among to me as a truly amazing series. I liken it to Star Wars as a movie and film phenomena, when it comes to the saga story. But this one started out as a set of books, which makes it even more fantastic...\r\n\r\nFor me, although I loved all three in the series, the middle one was the least favorite, but they were all still 4+. The first one introduces everything and sets the stage. The last one is the epic battle. The middle one... pure awesome storytelling... but it\'s the middle. Full of history, secrets, revelations, explanations... you learn the most here. But you also get a little overwhelmed with the sheet amount to remember. But I like that about it too. And to tell the story of dark versus light. To see people you love fall to their death. To think so much will change for the worse. It\'s a challenge to decide which part of the story to love most.\r\n\r\nIf you\'ve not read the series, it\'s probably 2000 pages in its entirety. I still think you should read it... but start with book 1 of course. You can\'t read out of order. Then let\'s chat again! :)', '4', '2012-01-07', 5, 'Agda Grinigsson'),
(6, 'Ronja rövardotter föds en stormig natt då hela Mattisborgen rämnar när en blixt slår ner. Samtidigt föds också fiendesläkten, gossebarnet Birk. De båda rövarbanden hatar varandra som synden. Men Ronja och Birk förenas av ett syskonband efter att ha räddat livet på varandra.\r\n\r\nMin favorit bland Lindgrens sagor. Iallafall - en av favoriterna. Jag älskar språket, karaktärerna, historien och skogen. Det här är en saga som inte liknar någonting annat. Astrid Lindgren fångar läsaren från första sidan till den sista. Ronja Rövardotter är omöjlig att lägga ifrån sig. När sista sidan är läst överfalls läsaren av saknad och längtan efter mer.', '5', '2005-05-30', 6, 'Agda Grinigsson'),
(7, 'J.K. Rowling has sidestepped the usual series-writer trap of sticking so closely to a successful formula that each book is just more of the same. With Harry about to enter adolescence, the series, too, seems to be changing; this entry is darker, more complex, and morally more ambiguous than the first two. As he is forced by the Dementors to confront his parents\' deaths directly, Harry -- who was always so cool in the earlier books -- is more emotionally unstable. Unlike the static characters in other series, Harry is getting older, with all that entails.\r\n\r\nRowling is a master of careful plotting, and the author is rumored to have planned out the whole story of the series in advance, for a total of seven books. In this volume, her planning shows, and the complexity is so great that, at times, it even inspires rereading. Rowling knows her readers, but even as she stretches their intellect, she never loses them.', '5', '2000-01-01', 7, 'Agda Grinigsson'),
(9, 'Precis som när jag skrev om Mio, min Mio känns det lite konstigt att skriva om en bok som är så pass erkänd som Bröderna Lejonhjärta. Men jag vill ändå säga saker om den här boken, så därför gör jag det. Precis som med Mio vet ni förmodligen redan vad boken handlar om, men jag drar det ändå:\r\n\r\nSkorpans modiga, vackra, fantastiska storebror Jonatan dör ifrån honom när Jonatan räddar Skorpan ur en brand. Egentligen var det meningen att Skorpan skulle dö först. Att han skulle sitta i Nangijala och vänta på Jonatan. Skorpan var sjuk och skulle dö, och Jonatan hade sagt att så skulle det bli. Men så blev det inte.\r\n\r\nIstället är det Jonatan som får vänta i Nangijala. När Skorpan kommer till Körsbärsdalen i Nangijala verkar det vara paradiset, men någonting hotar detta paradis. Grannbyn Törnrosdalen har blivit ockuperad av den onde Tengil. Han har gjort invånarna i byn till slavar, och om inte Körsbärsdalen också kämpar för sig kan det hända dem också. Den modige Jonatan står först i ledet att bekämpa Tengil, vilket inte är helt ofarligt. Speciellt inte då det finns en förrädare i Körsbärsdalen.\r\n\r\nDet som jag lärt mig uppskatta mest med Astrid Lindgren är att samtidigt som hennes böcker är roliga, spännande och nästan helt omöjliga att länga ifrån sig, finns det även ett mått av mörker och allvar. Hennes böcker är inte bara spännande berättelser, utan innehåller också något annat. Bröderna Lejonhjärta är ju egentligen en hemsk historia om en liten pojke som är dödssjuk. Hans bror dör i en eldsvåda, och så småningom dör även den lilla pojken. Och sen blir det trubbel i paradiset som måste lösas, och den lilla pojkens bror kämpar fastän han inte måste. Djupet i berättelsen gör att det blir mer än bara en barnbok också. Jag tycker att det här är en bok som i allra högsta grad också angår mig, och uppskattade den väldigt mycket medan jag läste den (och även i efterhand så klart).\r\n\r\nSom jag skrev i ett tidigare inlägg tycker jag att boken känns himla aktuell just nu. Just nu, imorgon och alltid. Att göra något som en inte måste för att hjälpa någon annan. Det borde vi göra oftare. Jag tror att Jonatan kan ha blivit en utav mina största litterära förebilder faktiskt.', '0', '2000-01-01', 9, 'Agda Grinigsson'),
(10, 'Andra boken om Emil har kanske inte lika kända hyss som den första. Där den hade både Soppskålen och Ida i Flaggstången är de här, med undantag för det sista, lite mindre ikoniska. Men likväl tycker jag den här boken är bättre. \r\nHyssen, som är tre precis som i förra boken, är dels dagen Emil täljde sin 100:de trägubbe, Marknaden i Vimmerby och slutligen bokens mest berömda, det stora Tabberaset i Katthult. \r\n\r\nAlla tre visar upp Emil som den härliga karaktären han är och jag njöt mer av den här boken än den första. \r\nAnledningen är att Astrid här verkligen fått kläm på sina karaktärer (det är t.ex. i den här boken den välkända repliken \"Förgrömmade onge\", gör sin debut) och det är en ren fröjd att läsa om Emil och Katthultarna. Kapitlen är längre och går djupare in på karaktärerna så man lär känna dem bättre. Det här är ett återkommande drag hos Astrid, då hennes böcker växer med läsarna. Men tro inte att bara för att boken är \"mognare\" att den saknar charm och humor. Den är minst lika underhållande som den första. \r\n\r\nTro nu för all del inte att jag ogillade den fösta boken. Nej, nej. Alla tre Emil böckerna är något som varje barn borde ha fått läsa eller fått högläst för sig. Emils hyss hör till allmänbildningen, och om du inte fick det som barn så tycker jag du borde läsa dem nu. \r\nFör Emil är en rar liten gosse. Och vi älskar honom precis som han är.', '5', '2016-03-16', 16, 'Agda Grinigsson'),
(11, 'a rousing climax to the most ravishing love story of the modern age. tempestuous, tormented Frodo at long last learns to accept the love of his lifemate - the loyal and submissive Samwise Gamgee, bottom-extraordinaire. this is truly a tale of love\'s labour hard-won, and at such a cost! but love conquers all in the end, and even bitter, militantly hetero villain Sauron cannot stand in the heart\'s path for too long. in this third book of the torrid trilogy, Frodo\'s love-hate relationship with the concept of commitment - deftly symbolized by a gorgeous, one-of-a-kind, designer ring - reaches a dramatic fever pitch, as he wrestles with his awkward feelings about monogamy & gay marriage in the boiling, repressive deserts of \"Mordor\" (clearly a stand-in for maverick Texazona). fortunately, the maternal Sam is constantly by his side to offer succor - forever the wind beneath Frodo\'s wings.\r\n\r\n? ? ? ? ?\r\n\r\nthe incredibly racy & erotic atmosphere is filled with a circuit party\'s worth of soldier types, as well as many classic queer icons: butch trade turned romantic male-model Aragorn; saucy friends-with-benefits Merry & Pippin; the tough & dour yet loveable uber-dyke Arwen; little bear-daddy Gimli; cringing closet-case Oh My Precious; fey pretty-boy Legolas; the exquisite drag queen enchantress Galadriel; and of course, presiding over them all, flouncing from scene to scene, battling his nasty sourpuss of an ex-boyfriend Saruman, and just chewing up the scenery like no one else...the fabulous and effervescent Gandalf the Gay. you go, girlfriend! \r\n\r\ndespite the couple dozen unnecessary scenes of Sam staring dreamily into Frodo\'s sad sad eyes, this is truly a flawless and timeless gay classic, one that boldly states Love Is a Glorious Burden That We Must Ever Shoulder. love knows no boundaries. and even the smallest of men can have the biggest....\"heart\", i suppose. queer fave Enya even contributes to the soundtrack. Return of the King is a luscious, deliriously homoerotic fantasia.\r\n\r\noops, forgot i wasn\'t reviewing the thrillingly fagtastic film version. well, as far as the novel goes, it is perfect. i wouldn\'t change a word. even the poetry is awesome.', '5', '2011-05-11', 8, 'Agda Grinigsson'),
(111, 'aaaaaa', '0', '2010-01-01', 4, 'Agda Gnatigsson'),
(112, 'aaaaaa', '0', '2010-01-01', 4, 'Agda Gnatigsson'),
(113, 'aaaaaa', '0', '2010-01-01', 4, 'Agda Gnatigsson');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`revId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `revId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
