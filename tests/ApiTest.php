<?php

use Illuminate\Support\Facades\Artisan;

class ApiTest extends TestCase
{
    public function setUp() :void
    {
        parent::setUp();
        Artisan::call("migrate");
        $this->artisan("db:seed", ["--class" => "DatabaseSeeder"]);
    }

    public function testCategories()
    {
        $get = $this->json("GET", "api/categories");
        $get->seeStatusCode(200);
        $get->seeJsonStructure([[
            "id",
            "name",
            "created_at",
            "updated_at"
        ]]);
        $get->seeJsonContains([
            "id" => 1
        ]);
        $get->seeJsonContains([
            "id" => 5
        ]);
        $get->seeJsonDoesntContains([
            "id" => 6
        ]);

        $update = $this->json("PUT", "api/categories/1", ["name" => "newName"]);
        $update->seeStatusCode(200);
        $update->seeJsonContains([
            "id" => 1,
            "name" => "newName"
        ]);

        $create = $this->json("POST", "api/categories", ["name" => "newCategory"]);
        $create->seeStatusCode(201);
        $create->seeJsonContains([
            "id" => 6,
            "name" => "newCategory"
        ]);
    }

    public function testPosts() {
        $get = $this->json("GET", "api/posts/1");
        $get->seeStatusCode(200);
        $get->seeJsonStructure([[
            "id",
            "content",
            "created_at",
            "updated_at",
            "category_id"
        ]]);
        $get->seeJsonContains([
            "category_id" => 1
        ]);
        $get->seeJsonDoesntContains([
            "category_id" => 2
        ]);

        $update = $this->json("PUT", "api/posts/1", ["content" => "newContent"]);
        $update->seeStatusCode(200);
        $update->seeJsonContains([
            "id" => 1,
            "content" => "newContent"
        ]);

        $create = $this->json("POST", "api/posts", ["content" => "newPost", "category_id" => 1]);
        $create->seeStatusCode(201);
        $create->seeJsonContains([
            "id" => 16,
            "content" => "newPost",
            "category_id" => 1
        ]);
        $this->json("GET", "api/posts/1")->seeJsonContains([
            "id" => 16
        ]);

        $delete = $this->json("DELETE", "api/posts/16");
        $delete->seeStatusCode(200);
        $this->json("GET", "api/posts/1")->seeJsonDoesntContains([
            "id" => 16
        ]);
    }

    public function tearDown() :void
    {
        Artisan::call("migrate:reset");
        parent::tearDown();
    }

}
