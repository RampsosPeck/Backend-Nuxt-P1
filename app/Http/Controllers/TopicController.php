<?php

namespace App\Http\Controllers;

use App\Http\Requests\TopicCreateRequest;
use App\Http\Requests\UpdateTopicRequest;
use App\Http\Resources\ResourceTopic;
use App\Post;
use App\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{

	public function index(){
		$topics = Topic::latestFirst()->paginate(5);
		return ResourceTopic::collection($topics);
	}


    //
	public function store(TopicCreateRequest $request){
		$topic = new Topic;
		$topic->title = $request->title;
		$topic->user()->associate($request->user());

		$post = new Post;
		$post->body = $request->body;
		$post->user()->associate($request->user());

		$topic->save();
		$topic->posts()->save($post);

		return new ResourceTopic($topic);

	}

	public function show(Topic $topic){
		return new ResourceTopic($topic);
	}

	public function update(UpdateTopicRequest $request, Topic $topic)
	{
		$this->authorize('update', $topic);
		$topic->title = $request->get('title', $topic->title);
		$topic->save();
		return new ResourceTopic($topic);

	}

	public function destroy(Topic $topic)
	{
		$this->authorize('destroy', $topic);
		$topic->delete();
		return response(null, 204);

	}


}










