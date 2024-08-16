<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostDetailResource extends JsonResource
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
            'title' => $this->title,
            'content' => $this->content,
            'author' => $this->author,
            'writer' => $this->whenLoaded('writer'),
            'comments' => $this->whenLoaded('comments', function () {
                return collect($this->comment)->each(function ($comment) {
                    $comment->commentator;
                    return $comment;
                });
            }),
            'comment_total' => $this->whenLoaded('comments', function() {
                return $this->comments->count();
            }),
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }
}
