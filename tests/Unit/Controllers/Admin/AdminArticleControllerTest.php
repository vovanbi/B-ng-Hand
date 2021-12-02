<?php

namespace Tests\Unit\Controllers\Admin;

use Tests\TestCase;
use WithoutMiddleware;

class AdminArticleControllerTest extends TestCase
{
    public function testViewIndexAdminArticle(){
	    $this->withoutMiddleware();
	    $response = $this->post(route('post.login', ['email' => 'ShoesShop.UED@gmail.com','password' => '123',]));
    	$response = $this->get('admin/article');
    	$response->assertStatus(200);
    	$response->assertViewIs('admin.article.index')->assertSee('Quản lý bài viết');
    	$this->assertTrue(isset($response['articles']));
    }
}
