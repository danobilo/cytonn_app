<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User as User;
use App\Task as Task;

class TaskTest extends TestCase {

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testNewTaskForm() {

        $user = new User(array('name' => 'John'));
        $this->be($user);

        $response = $this->get('/tasks/new');
        $response->assertStatus(200);
    }

    public function testTaskDetailsPage() {

        $user = new User(array('name' => 'John'));
        $this->be($user);

        $response = $this->get('/tasks/details/2');
        $response->assertStatus(200);
    }

    public function testTaskBoardPage() {

        $user = new User(array('name' => 'John'));
        $this->be($user);

        $response = $this->get('/taskboard');
        $response->assertStatus(200);
    }

    public function testAddTask_WithGet_HasEmptyForm() {
        $task = new Task();

        $response = $this->get('/tasks/new');

        $this->assertCount(1, $response->get('form'));
        $this->assertEquals('', $response->get('form input[name=assigned_to]')->attr('value'));
    }
    
   
    public function testAddRating_WithPost_IsRedirect()
    {
        $task = new Task();
        $response = $task->request('POST',
            '/tasks/new',
            [
                'allow_redirects' => false,
                'multipart' => [
                    [
                        'name' => 'assigned_to',
                        'contents' => '1',
                    ],
                   
                ]
            ]);
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertEquals('/', $response->getHeaderLine('Location'));

        $pdo = new PDO(
            'mysql:host=localhost;dbname=cytonn_app', 'cytonn_app', 'cytonn_app');
        $statement = $pdo->prepare('SELECT * FROM tasks');
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        $this->assertCount(1, $result);
        $this->assertEquals([
            'tasks_id' => '1',
            'assigned_to' => '1',
        ], $result[0]);
    }

}
