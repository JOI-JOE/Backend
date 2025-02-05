<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Env;
use Illuminate\Support\Str; // Import the Str helper

class WorkspaceResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'desc'              => Str::limit($this->desc, 50),
            'idMemberCreator'   => $this->id_member_creator,
            'displayName'       => $this->display_name,
            'id'                => $this->id,
            'logoHash'          => '',
            'logoUrl'           => '',
            'name'              => $this->name,
            'teamType'          => $this->teamType->name,
            'url'               => url("/w/" . $this->name),
        ];
    }
}
