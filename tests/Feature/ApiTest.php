<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ApiTest extends TestCase
{

    /**
     * Api Post Index function.
     *
     * @return void
     */
    public function testIndexReturnsValidFormat()
    {
        $this->json('get', 'api/posts')
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    '*' => [
                        'userId',
                        'id',
                        'title',
                        'body',
                        'user' => [
                            'id',
                            'name',
                            'username',
                            'email',
                            'address' => [
                                'street',
                                'suite',
                                'city',
                                'zipcode',
                                'geo' => [
                                    'lat',
                                    'lng'
                                ]
                            ],
                            'phone',
                            'website',
                            'company' => [
                                'name',
                                'catchPhrase',
                                'bs'
                            ]

                        ]
                    ]
                ]
            );
    }

    /**
     * Api Post Store function.
     *
     * @return void
     */
    public function storeTest()
    {
        $response = $this->postJson('/api/post', [
            'title' => $this->faker->title,
            'body' => $this->faker->text,
            'userId' => $this->faker->id
        ]);

        $response
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJson([
                'created' => true,
            ]);
    }

    /**
     * Api Post Show function.
     *
     * @return void
     */
    public function testPostIsShownCorrectly()
    {


        $response = $this->getJson('api/post/1');

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->where('id', 1)
                    ->etc()
            );
    }

    /**
     * Api Post Destroy function.
     *
     * @return void
     */
    public function testPostIsDestroyed()
    {
        $this->json('delete', "api/post/1")
            ->assertStatus(Response::HTTP_OK);
    }

    /**
     * Api Post Update function.
     *
     * @return void
     */
    public function testUpdatePostReturnsCorrectData()
    {
        $post = [
            'id' => rand(1, 100),
            'title'  => 'adasdasdasdasd',
            'body'      => 'adasdasdasdasd',
            'userId' => rand(1, 100)
        ];

        $this->json('put', "api/post/" . $post['id'], $post)
            ->assertStatus(Response::HTTP_OK)
            // ->assertExactJson(
            //     [
            //         '*' => [
            //             'id'         => $post['id'],
            //             'title' => $post['title'],
            //             'body'  => $post['body'],
            //             'userId'      => $post['userId']

            //         ]
            //     ]
            // )
        ;
    }
}
