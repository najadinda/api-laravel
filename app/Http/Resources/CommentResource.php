<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'post_id' => $this->post_id,
            'user_id' => $this->user_id,
            'comment' => $this->comment,
            'commentator' => $this->whenLoaded('commentator'),
            'created_at' => $this->created_at->toDateTimeString(),
            // 'updated_at' => $this->updated_at->toDateTimeString(),
            // 'user' => new UserResource($this->user), // Include user details in the response
            // 'post' => new PostResource($this->post), // Include post details in the response
        ];
    }
}
