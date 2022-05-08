<?php

namespace App\Http\Controllers;

use App\Http\Requests\News as NewsRequest;
use Illuminate\Http\Request;
use App\Http\Resources\News as NewsResource;
use App\Http\Resources\User;
use App\Models\News;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;

class NewsController extends Controller
{
    /**
     * Return the news.
     * 
     * @param Request $request
     * @return ResourceCollection
     */
    public function index(Request $request): ResourceCollection
    {
        return NewsResource::collection(
            News::paginate($request->input('limit', 20))
        );
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param NewsRequest $request
     * @param News $news
     * @return NewsResource
     */
    public function update(NewsRequest $request, News $news): NewsResource
    {
        $request->request->add(['user_id' => $request->user()->id]);
        $news->update($request->only(['title', 'content', 'user_id']));
        return new NewsResource($news);
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param NewsRequest $request
     * @return NewsResource
     */
    public function store(NewsRequest $request): NewsResource
    {
        return new NewsResource(
            News::create([
                'title' => $request->title,
                'content' => $request->content,
                'user_id' => $request->user()->id
            ])
        );
    }

    /**
     * Return the specified resource.
     * 
     * @param News $news
     * @return NewsResource
     */
    public function show(News $news): NewsResource
    {
        return new NewsResource($news);
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param News $news
     * @return Response
     */
    public function destroy(News $news): Response
    {
        $news->delete();
        return response()->noContent();
    }

    /**
     * Assign a news to given user
     * 
     * @param News $news
     * @return Response
     */
    public function assign(News $news, Request $request): Response
    {
        $news->update([
            'user_id' => $request->user()->id
        ]);
        return response(new User($request->user()), 201);
    }
}
