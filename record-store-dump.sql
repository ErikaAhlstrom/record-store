-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 17, 2021 at 07:54 AM
-- Server version: 5.7.32
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `recordstoredb`
--

-- --------------------------------------------------------

--
-- Table structure for table `records`
--

CREATE TABLE `records` (
  `id_record` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_swedish_ci DEFAULT NULL,
  `description` varchar(1000) COLLATE utf8_swedish_ci DEFAULT NULL,
  `price` decimal(11,0) DEFAULT NULL,
  `year_released` varchar(45) COLLATE utf8_swedish_ci DEFAULT NULL,
  `cover` varchar(45) COLLATE utf8_swedish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `records`
--

INSERT INTO `records` (`id_record`, `title`, `description`, `price`, `year_released`, `cover`) VALUES
(1, 'Dawn Chorus: Limited Edition Purple Vinyl 2LP', 'LuckyMe proudly present the new album from Jacques Greene ~ Dawn Chorus on limited edition purple vinyl. The record is bold step forward and his most collaborative project to date, featuring additional production and instruments from film composer Brian Reitzell (Lost In Translation), cello by London’s Oliver Coates, additional production from Clams Casino and vocal contributions from ambient artist Julianna Barwick, rapper Cadence Weapon and singers Ebhoni and Rochelle Jordan. If the Canadian artist’s 2017 debut album Feel Infinite was the soundtrack to a dream pregame – amping you up to lose yourself in the club – then Dawn Chorus resides in the post-rave reflective moment. A time of heightened sensuality and latent possibility.', '31', '2020', 'assets/covers/1.jpeg'),
(2, 'Chemz / Dolphinz', '‘Chemz’ is hooky, rushy and loved-up - both an unhinged premonition of unleashed post-pandemic joy, and a demonic flashback to past ecstasies in a hardcore style perfected in the UK. ‘Chemz’ is a 12 minute rave monster that has ingested several tracks and incorporated them into its distended body. At the other end of the Burial bi-polar spectrum, ‘Dolphinz’ is a desolate oceanic love letter to our underwater friends.', '12', '2019', 'assets/covers/2.png'),
(3, 'Uwami', 'Dark, searching amapiano electronic music from a new producer. Relatively new style of music for listeners outside South Africa. Reflects the feeling of 2020: stark, disruptive, scary. Part of a wave of young producers making vital new music in SA. Sounds like nothing else right now.', '24', '2018', 'assets/covers/3.jpeg'),
(4, 'Crooks & Lovers: 10th Anniversary Expanded Edition Triple Vinyl', 'In 2010, Mount Kimbie released their debut album, Crooks & Lovers, to widespread acclaim. Perfectly capturing the heady atmosphere of the moment, the album melded the wide-eyed mentality of what had become known as ‘Post-Dubstep’ with an open-minded musical sensibility that produced an instant classic. Ten years later, the album is reissued on Hotflush with a bonus disc of the band’s first ever release.', '36', '2021', 'assets/covers/4.jpeg'),
(5, 'This Is Telex: CD', 'This Is Telex is a brand new compilation collecting 14 tracks from the innovative Belgium trio, covering their career from formation in 1978 up to the final album in 2006. This compilation includes the hit single Moskow Disko as well as their Eurovision Song Contest entry, aptly called Euro-vision.', '13', '2020', 'assets/covers/5.jpeg'),
(6, 'Chew The Scenery: Signed Poppy Red Vinyl', 'Chew The Scenery is the debut album from Oscar Lang. Single \'poppy red\' coloured vinyl with printed inner, lyric sheet & download card, sleeve signed by Oscar exclusively for recordstore.co.uk.', '26', '2021', 'assets/covers/6.png'),
(7, 'Jubilee: Black Vinyl', 'From the moment she began writing her new album, Japanese Breakfast’s Michelle Zauner knew that she wanted to call it Jubilee. After all, a jubilee is a celebration of the passage of time—a festival to usher in the hope of a new era in brilliant technicolor. Zauner’s first two albums garnered acclaim for the way they grappled with anguish; Psychopomp was written as her mother underwent cancer treatment, while Soft Sounds From Another Planet took the grief she held from her mother‘s death and used it as a conduit to explore the cosmos. Now, at the start of a new decade, Japanese Breakfast is ready to fight for happiness, an all-too-scarce resource in our seemingly crumbling world.', '22', '2017', 'assets/covers/7.jpeg'),
(8, 'Cascade: Limited Edition Double Scarlet Vinyl', 'His last solo album for Beggars, Cascade came after a time of change for Peter Murphy. He had dissolved his longtime backing band and moved to Turkey with his family. After a year of soul-searching and re-discovery, the songs flowed. He said “It confirmed my belief that writing – like painting or any art form – comes from a very silent place that’s not dependent on outside stimulus. It was like rediscovering the initial innocence and purity that’s there when you join your first band.” The album was written with Paul Statham and produced by Pascal Gabriel. It also contains guitar work by noted artist Michael Brook.', '30', '2017', 'assets/covers/8.jpeg'),
(9, 'Changephobia: Limited Edition Cassette', 'Changephobia is the 2nd full-length solo record from Grammy Awardwinning songwriter, producer, and composer Rostam Batmanglij. An adventurous new direction for Rostam, the songs collected on Changephobia are deeply personal, yet universal for anyone who has ever experienced doubt. In addition to being a founding member of the seminal New York Indie Rock Band, Vampire Weekend, Rostam has been described as “one of the great pop and indie-rock producers of his generation.', '10', '2021', 'assets/covers/9.jpeg'),
(10, 'Spang Sisters: Soft Lilac Vinyl', 'RnB-flecked bedroom folk duo Spang Sisters are excited to confirm that their debut full length album will be arriving this spring.\\n                The Brighton/Bristol duo have a palpable appreciation and knowledge of the music of yesteryear, which manifests itself with poise throughout the band’s output. The Velvet Underground, Motown, Dr.Dre and the Japanese folk band Happy End have all contributed inspiration to a debut record that is unlike any other.', '25', '2020', 'assets/covers/10.jpeg'),
(11, '‘Happier Than Ever’ Vinyl', NULL, '43', '2021', 'assets/covers/11.png'),
(12, 'The Beginning', 'The Queen of Synthwave presents the singles and b-sides that started it all, including NINA\'s four seminal songs in digital and physical formats plus the addition of instrumentals. NINA\'s earliest releases introduced to a new generation of fans and adepts. Also included, the iconic Blondie’s \'Heart Of Glass\' reimagined as a Synthwave anthem. A crowd favourite at the live shows.', '14', '2018', 'assets/covers/12.jpeg'),
(13, 'lifes a beach: standard cassette', 'Standard clear frosted cassette with ‘life’s a beach’ artwork', '9', '2016', 'assets/covers/13.jpg'),
(14, 'Reprise: Exclusive Deluxe 180gm Crystal Clear Vinyl 2LP + Little Idiot Slipmat - Double Vinyl LP', 'Moby’s latest album Reprise available now in special 2-LP limited edition on top-quality 180g crystal clear vinyl! Double LP in gatefold sleeve, includes Moby’s personal essay on this exciting new project, rich selection of photos by and of the artist and black polyester slipmat with Little Idiot design.', '50', '2020', 'assets/covers/14.png'),
(15, 'Piece Of Your Heart/ Lose Control: Exclusive Picture Disc Vinyl', 'Limited 10inch Picture-Vinyl in transparent foil sleeve', '14', '2017', 'assets/covers/15.png'),
(16, 'Pink Noise: Pink Vinyl LP', 'Laura Mvula’s new album ‘Pink Noise’ is set for release on July 2nd. ‘Pink Noise’ explores a side of Laura previously uncharted. As triumphant as ever, the album is a battle cry and stark reminder of the sheer talent of the critically acclaimed artist. This is Laura in a new found light - still reflecting her distinctive signature sound but showing the progression of an artist who has come into her own.', '24', '2021', 'assets/covers/16.jpeg'),
(17, 'For My Mama And Anyone Who Look Like Her: Limited Edition Mango Colour Vinyl', 'Richmond, Virginia-based artist McKinley Dixon has always used his music as a tool for healing, exploring, and unpacking the Black experience in order to create stories for others like him. For My Mama And Anyone Who Look Like Her, Dixon’s debut album on Spacebomb, is the culmination of a journey where heartbreak and introspection challenged him to adapt new ways of communicating physically and mentally, as well as across time and space. The language accessibility aspect of this project draws right back to communication and connecting,” Dixon explains. “I think about the messaging, and how this can be a way for another Black person, someone who looks like me, to listen to this and process the past.', '26', '2018', 'assets/covers/17.png'),
(18, 'Andy: Gatefold Rose Vinyl', 'Raleigh Ritchie releases his highly anticipated second album, ANDY. A twelve track project, Andy sees Bristol born and London-hailing Raleigh holding a colossal magnifying glass to himself. Over the production, for the most part, from long-term collaborator Chris Loco but also, the incredibly talented GRADES on “Time In A Tree” and “27 Club”, Raleigh leaves no stone unturned. The album is a creation of heartbreakingly honest songs that seamlessly fuses sweeping soul and mellow R&B with forward-thinking electronica and gutsy orchestral moments. (Raleigh has become well known for working with the sensational Rosie Danvers and Wired Strings.) This is a truly powerful record, a long-awaited return that packs a poignant punch.', '24', '2019', 'assets/covers/18.png'),
(19, 'Sound Ancestors (Arranged By Kieran Hebden', 'Gil Evans to Miles Davis…. Holger Czukay to the ensemble known as Can….Jean Claude Vannier to Serge Gainsbourg on Histoire de Melody Nelson. That’s the only way to explain the specificity of Four Tet and Madlib’s collaboration, in this special album that showcases a two-decade long friendship that has resulted in an album that follows Madlib’s classics like Quasimoto’s The Unseen, Madvillainy and his Pinata and Bandana albums with Freddie Gibbs.', '34', '2021', 'assets/covers/19.png'),
(20, 'Stay Sane', 'Ocean Wisdom reveals he will be releasing his hotly-anticipated third album ’Stay Sane’ on February 19th 2021 on his own label Beyond Measure Records. The album will feature latest single ‘Drilly Rucksack’. Speaking on the album, Ocean said: “This album is called ‘Stay Sane’ and I made it to help myself cope after losses and tribulations. I hope it can help other people to heal and relax.”', '16', '2021', 'assets/covers/20.jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `records`
--
ALTER TABLE `records`
  ADD PRIMARY KEY (`id_record`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `records`
--
ALTER TABLE `records`
  MODIFY `id_record` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
