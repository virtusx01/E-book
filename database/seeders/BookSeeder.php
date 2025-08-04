<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;
use Faker\Factory as Faker;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $numberOfParagraphs = $faker->numberBetween(10, 15);
        $randomContent = implode("\n\n", $faker->paragraphs($numberOfParagraphs));
        $book1 =Book::create([
            'title' => 'Crimson Spell',
            'author' => 'F. Scott Fitzgerald',
            'release_date' => '1925-04-10',
            'publisher' => 'Scribner',
            'synopsis' => 'In a fantasy world threatened by ancient powers, the sky is torn by lightning storms and the land crumbles beneath deadly spells. The emergence of the Crimson Spell, a forbidden magic that destroys everything in its path, threatens to engulf all civilization.
                           Only a brave female warrior named Elara stands as the last hope. Armed with a sword imbued with blue magical energy, she is a skilled fighter and a wielder of ancient spells. With the power of mysterious runes she has discovered, Elara embarks on a perilous quest to halt the destruction.
                           On her journey, she must confront unexpected allies in the form of a mysterious fire dragon and battle formidable enemies lurking in the shadows of an ancient castle. Elara must master her own magic before the Crimson Spell manages to consume the world.
                           This is an epic tale of non-stop action, breathtaking magic, and the struggle of a courageous heroine who dares to fight the darkness to save the fate of the world.',
            'content' => $randomContent,
            'number_of_pages' => 10,
            'cover_book' => 'covers/crimson-spell.png',
        ]); $book1->categories()->attach([18, 2]);

        $book2 = Book::create([
            'title' => 'Power Play',
            'author' => 'Jordan Blaze',
            'release_date' => '2022-07-15',
            'publisher' => 'Sports Saga Press',
            'synopsis' => 'A rising basketball star faces his toughest challenge yet, both on and off the court. With incredible athleticism and a mysterious glowing power, he must lead his team to victory while uncovering a conspiracy that threatens to shatter his dreams. This is a high-octane story of sports, action, and the pursuit of greatness.',
            'content' => $randomContent,
            'number_of_pages' => 20,
            'cover_book' => 'covers/power-play.png',
        ]); $book2->categories()->attach([1, 2, 9]);

        $book3 = Book::create([
            'title' => 'The Grimoire of Giggles',
            'author' => 'Alistair Wiffle',
            'release_date' => '2021-03-20',
            'publisher' => 'Whimsical Tales Co.',
            'synopsis' => 'Join a young wizard and his trusty griffin on a whimsical adventure through a magical land filled with floating castles and hidden treasures. But beware, for this grimoire holds not just spells, but also endless giggles and mischievous magic that can turn any serious quest into a hilarious escapade.',
            'content' => $randomContent,
            'number_of_pages' => 21,
            'cover_book' => 'covers/the-grimoire-of-giggles.png',
        ]); $book3->categories()->attach([1, 5, 10, 11, 18]);
        
        $book4 = Book::create([
            'title' => 'Grave Laughs: A Zombie\'s Guide to Comedy',
            'author' => 'Penny Dreadful',
            'release_date' => '2020-11-01',
            'publisher' => 'Undead Publishing',
            'synopsis' => 'Who knew the apocalypse could be so funny? This hilarious guide, written by a zombie stand-up comedian, offers a fresh (and decaying) perspective on humor, survival, and finding joy in the undead afterlife. Get ready for some grave laughs!',
            'content' => $randomContent,
            'number_of_pages' => 18,
            'cover_book' => 'covers/grave-laughs.png',
        ]); $book4->categories()->attach([1, 8, 10]);

        $book5 = Book::create([
            'title' => 'Crimson Secret: A Romantic Thriller',
            'author' => 'Kagami Ren',
            'release_date' => '2024-01-05',
            'publisher' => 'Shadow Alley Books',
            'synopsis' => 'In the neon-lit streets of a rain-soaked city, a dangerous secret binds two strangers together. As they navigate a world of hidden dangers and unexpected passion, they must uncover the truth behind a crimson secret before it consumes them both. A thrilling blend of romance, suspense, and dark urban mystery.',
            'content' => $randomContent,
            'number_of_pages' => 17,
            'cover_book' => 'covers/crimson-secret.png',
        ]); $book5->categories()->attach([1, 3, 7, 4]);

        $book6 = Book::create([
            'title' => 'The Serpent\'s Coil',
            'author' => 'Evelyn Reed',
            'release_date' => '2023-05-10',
            'publisher' => 'Jungle Expeditions Publishing',
            'synopsis' => 'Deep within an uncharted jungle, an intrepid explorer uncovers ancient ruins and a terrifying secret: a mythical serpent guarding a lost treasure. With only a torch and his trusty blade, he must navigate treacherous traps and cunning adversaries to escape the serpent\'s coil and uncover the truth of the jungle\'s heart.',
            'content' => $randomContent,
            'number_of_pages' => 14,
            'cover_book' => 'covers/serpents-coil.png',
        ]); $book6->categories()->attach([1, 2, 11, 4]);
    }
}
