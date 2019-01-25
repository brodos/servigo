<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClientProjectTest extends TestCase
{
	use RefreshDatabase;

    /** @test */
    public function a_guest_or_cannot_see_the_create_project_form()
    {
    	$this->get(route('client-projects.create'))
    		->assertStatus(302)
    		->assertRedirect(route('login'));
    }

    /** @test */
    public function a_guest_cannot_create_a_project()
    {
    	$project = make('App\Project');

    	$this->post(route('client-projects.store'), $project->toArray())
    		->assertRedirect(route('login'));

		$this->post(route('client-projects.store'), [])
    		->assertRedirect(route('login'));
    }

    /** @test */
    public function a_guest_or_cannot_see_the_edit_project_form()
    {
    	$project = create('App\Project');

    	$this->get(route('client-projects.edit', $project))
    		->assertStatus(302)
    		->assertRedirect(route('login'));
    }

    /** @test */
    public function a_guest_cannot_edit_a_project()
    {
    	$project = create('App\Project');

    	$new_project = make('App\Project');

    	$this->patch(route('client-projects.update', $project), $new_project->toArray())
    		->assertRedirect(route('login'));

		$this->patch(route('client-projects.update', $project), [])
    		->assertRedirect(route('login'));
    }

    /** @test */
    public function a_guest_cannot_delete_a_project()
    {
    	$project = create('App\Project');

    	$this->delete(route('client-projects.destroy', $project))
    		->assertRedirect(route('login'));
    }

    /** @test */
    public function an_authenticated_contractor_cannot_see_the_create_project_form()
    {
    	$contractor = $this->getRoledUser('contractor');

    	$this->signIn($contractor);

    	$this->get(route('client-projects.create'))
    		->assertStatus(403);
    }

    /** @test */
    public function an_authenticated_contractor_cannot_create_a_project()
    {
    	$contractor = $this->getRoledUser('contractor');

    	$this->signIn($contractor);

    	$project = make('App\Project', ['user_id' => $contractor->id]);

    	$this->post(route('client-projects.store'), $project->toArray())
    		->assertStatus(403);

		$this->post(route('client-projects.store'), [])
    		->assertStatus(403);
    }

    /** @test */
    public function an_authenticated_client_can_see_the_create_project_form()
    {
    	$client = $this->getRoledUser('client');

    	$this->signIn($client);

    	$this->get(route('client-projects.create'))
    		->assertOk()
    		->assertSee('form');
    }

    /** @test */
    public function an_authenticated_client_can_create_a_project()
    {
    	$client = $this->getRoledUser('client');

    	$this->signIn($client);

    	$project = make('App\Project', ['user_id' => $client->id]);

    	$response = $this->post(route('client-projects.store'), $project->toArray())
    		->assertStatus(302);

    	$this->get($response->headers->get('Location'))
    		->assertOk()
    		->assertSee($project->name)
    		->assertSee($project->description);
    }

    /** @test */
    public function a_project_needs_a_name()
    {
    	$client = $this->getRoledUser('client');

    	$this->signIn($client);

    	$project = make('App\Project', ['user_id' => $client->id, 'name' => null]);

    	$this->post(route('client-projects.store'), $project->toArray())
    		->assertSessionHasErrors(['name']);

    	$project = create('App\Project', ['user_id' => $client->id]);

    	$this->patch(route('client-projects.update', $project), ['name' => null])
    		->assertSessionHasErrors(['name']);
    }

    /** @test */
    public function a_project_needs_a_description()
    {
    	$client = $this->getRoledUser('client');

    	$this->signIn($client);

    	$project = make('App\Project', ['user_id' => $client->id, 'description' => null]);

    	$this->post(route('client-projects.store'), $project->toArray())
    		->assertSessionHasErrors(['description']);

    	$project = create('App\Project', ['user_id' => $client->id]);

    	$this->patch(route('client-projects.update', $project), ['description' => null])
    		->assertSessionHasErrors(['description']);
    }

    /** TOFIX */
    public function a_client_can_see_only_his_active_projects()
    {
    	$client = $this->getRoledUser('client');

    	$this->signIn($client);

    	$project1 = create('App\Project', ['user_id' => $client->id]);
    	$project2 = create('App\Project', ['user_id' => $client->id]);
    	$project3 = create('App\Project', ['user_id' => $client->id]);

        $client2 = $this->getRoledUser('client');

    	$otherClientProject = create('App\Project', ['user_id' => $client2->id]);

    	$this->get(route('client-projects.index'))
    		->assertSee($project1->name)
    		->assertSee($project2->name)
    		->assertSee($project3->name)
    		->assertDontSee($otherClientProject->name);

    	$this->get(route('client-projects.show', $otherClientProject))
    		->assertNotFound();
    }

    /** TOFIX */
    public function a_client_can_see_only_his_draft_projects()
    {
    	$client = $this->getRoledUser('client');

    	$this->signIn($client);

    	$project = create('App\Project', ['user_id' => $client->id]);

        $client2 = $this->getRoledUser('client');
    	$otherClientProject = create('App\Project', ['user_id' => $client2->id]);

    	$this->get(route('client-draft-projects.index'))
    		->assertSee($project->name)
    		->assertDontSee($otherClientProject->name);

    	$this->get(route('client-projects.show', $otherClientProject))
    		->assertNotFound();
    }

    /** @test */
    public function a_client_can_see_the_edit_form_for_his_project()
    {
		$client = $this->getRoledUser('client');

    	$this->signIn($client);

    	$project = create('App\Project', ['user_id' => $client->id]); 	

    	$this->get(route('client-projects.edit', $project->id))
    		->assertOk()
    		->assertSee('form');
    }

    /** @test */
    public function a_client_can_update_his_project()
    {
		$client = $this->getRoledUser('client');

    	$this->signIn($client);

    	$project = create('App\Project', ['user_id' => $client->id]); 	

    	$response = $this->patch(route('client-projects.update', $project->id), ['name' => 'test name', 'description' => 'text description' . $project->description] )
    		->assertSessionHasNoErrors()
    		->assertRedirect(route('client-projects.show', $project));
    }

    /** @test */
    public function a_client_can_update_only_his_project()
    {
		$client = $this->getRoledUser('client');

    	$this->signIn($client);

        $client2 = $this->getRoledUser('client');
    	$project = create('App\Project', ['user_id' => $client2->id]); 	

    	$this->patch(route('client-projects.update', $project->id), ['name' => 'test name', 'description' => 'text description' . $project->description] )
    		->assertStatus(403);
    }

    /** @test */
    public function a_client_can_delete_his_own_project ()
    {
    	$client = $this->getRoledUser('client');

    	$this->signIn($client);

    	$project = create('App\Project', ['user_id' => $client->id]);

    	$response = $this->delete(route('client-projects.destroy', $project));

    	$response->assertRedirect(route('client-projects.index'));
    		
    	$this->assertDatabaseMissing('projects', ['id' => $project->id]);
    }

    /** @test */
    public function a_client_cannot_delete_other_clients_project ()
    {
    	$client = $this->getRoledUser('client');

    	$this->signIn($client);

    	$project = create('App\Project');

    	$response = $this->delete(route('client-projects.destroy', $project));
    	$response->assertStatus(403);
    		
    	$this->assertDatabaseHas('projects', ['id' => $project->id]);
    }
}