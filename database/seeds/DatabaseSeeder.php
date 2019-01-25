<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // create a custom client user
        $user = factory(App\User::class)->create([
            'email' => 'mm@mm.mm',
            'password' => bcrypt('secret'),
        ]);

        $user->profile()->create(factory(App\Profile::class)->make(['user_id' => $user->id])->toArray());

        // create a custom contractor user
        $contractorUser = factory(App\User::class)->create([
            'email' => 'cc@cc.cc',
            'password' => bcrypt('secret'),
        ]);
        $contractorUser->profile()->create(factory(App\Profile::class)->make(['user_id' => $contractorUser->id])->toArray());

        factory(App\Project::class, 5)->create();

        $users = App\User::whereNotIn('id', [1])->get();

        // create some projects
        $projects = factory(App\Project::class, 5)->create([
            'user_id' => $user->id
        ])->each(function($project) use ($users) {
            $users->each(function($user) use ($project) {
                $proposal = factory(App\Proposal::class)->create(['user_id' => $user->id, 'project_id' => $project->id]);

                $user->fresh();

                $profile = \App\Profile::where('user_id', $user->id)->first();

                if (! $profile) {
                    factory(App\Profile::class)->create(['user_id' => $user->id]);
                }
            });

            $proposals = $project->proposals()->get();

            $proposals->each(function($proposal) use ($project) {
                $chat = factory(App\Conversation::class)->create(['project_id' => $project->id, 'proposal_id' => $proposal->id]);

                // dd($project->owner);
                $chat->addParticipants([$project->user_id, $proposal->user_id]);
                // $chat->addParticipant($proposal->owner);
            });
        });

        factory(App\Message::class, 5)->states('for_existing_conversations')->create();
        
    }
}
