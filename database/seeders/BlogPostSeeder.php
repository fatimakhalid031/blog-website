<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use Illuminate\Database\Seeder;

class BlogPostSeeder extends Seeder
{
    public function run(): void
    {
        BlogPost::create([
            'title' => 'On the Quiet Art of Staying',
            'slug' => 'on-the-quiet-art-of-staying',
            'excerpt' => 'In a world that glorifies leaving, I am learning the slow discipline of staying put — in places, in people, in myself.',
            'content' => "There is a certain romance in leaving. The train station goodbye, the packed suitcase, the unknown city waiting to be discovered. We grow up on stories of departures — the hero leaving home, the adventurer setting sail, the artist moving to a foreign land to find themselves.\n\nBut what about the ones who stay?\n\nI have been thinking about staying as a practice. Not as a failure of ambition or a lack of opportunity, but as a conscious choice. To stay means to watch the same tree change through all four seasons. To know the barista's name at the local café. To be there for the slow, unglamorous work of showing up.\n\nStaying is mundane. It does not make for good dinner party stories. But there is a depth to it that constant movement can never reach. When you stay, you stop performing for new audiences. You stop curating a version of yourself for fresh eyes. You simply are.\n\nI am learning that staying is not passive. It is an active, daily choice to remain present. To not check out. To not plan the escape route while still in the room.\n\nAnd maybe — just maybe — that is where the real living happens.",
            'category' => 'musings',
            'is_published' => true,
            'published_at' => now()->subDays(2),
        ]);

        BlogPost::create([
            'title' => 'Notes on Becoming a Morning Person (and Failing)',
            'slug' => 'notes-on-becoming-a-morning-person',
            'excerpt' => 'I wanted to be the kind of person who greets the dawn with a green smoothie and journal. Instead, I hit snooze four times.',
            'content' => "I have a theory that \"morning person\" is a personality trait you are born with, like being left-handed or having blue eyes. No amount of discipline will rewire your circadian rhythm.\n\nBut I tried anyway.\n\nFor three glorious weeks, I woke up at 5:30 AM. I stretched. I drank lemon water. I wrote three pages of stream-of-consciousness in a leather-bound journal. I was insufferable.\n\nThen winter came, and my bed became a gravitational force I could not escape.\n\nHere is what I have concluded: the morning is not inherently superior to any other time of day. We have romanticized it — the quiet, the golden light, the sense of having a head start. But some of us do our best thinking at midnight, when the world is asleep and there is no one to perform for.\n\nSo I have stopped trying to be a morning person. Instead, I am learning to be a present person — whenever the alarm finally wins.",
            'category' => 'diary',
            'is_published' => true,
            'published_at' => now()->subDays(5),
        ]);

        BlogPost::create([
            'title' => 'The Internet is a Haunted House',
            'slug' => 'the-internet-is-a-haunted-house',
            'excerpt' => "We keep returning to places online that no longer exist, searching for ghosts of conversations we once had.",
            'content' => "I caught myself scrolling through a forum I had not visited in years. The threads were still there, frozen in time — inside jokes from 2019, arguments about things I no longer care about, usernames of people whose real names I never learned.\n\nIt felt like walking through an abandoned house where the furniture is still covered in sheets.\n\nThe internet has become a vast graveyard of our former selves. Old Twitter accounts we abandoned, blogs we stopped updating, MySpace profiles with custom CSS that no longer renders. We leave digital footprints everywhere and never look back.\n\nBut sometimes we do look back. And it is strange — like running into a version of yourself you barely recognize. The things you cared about. The way you wrote. The person you were trying to become.\n\nI do not know if this is melancholy or nostalgia or something in between. Maybe it is just the cost of living through so much change in such a short time.\n\nThe internet is a haunted house. And we are the ghosts, haunting ourselves.",
            'category' => 'essays',
            'is_published' => true,
            'published_at' => now()->subDays(10),
        ]);

        $this->command->info('Seeded 3 blog posts!');
    }
}
