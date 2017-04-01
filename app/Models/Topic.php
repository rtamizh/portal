<?php

namespace App\Models;

use App\Helpers\HasTimestamps;
use App\Helpers\HasSlug;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Topic extends Model
{
    use HasSlug, HasTimestamps;

    /**
     * @var string
     */
    protected $table = 'topics';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    public function id(): int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function slug(): string
    {
        return $this->slug;
    }

    /**
     * @return \App\Models\Threads[]
     */
    public function threads()
    {
        return $this->threadsRelation;
    }

    public function paginatedThreads(int $perPage = 10): LengthAwarePaginator
    {
        return $this->threadsRelation()->paginate($perPage);
    }

    public function threadsRelation(): HasMany
    {
        return $this->hasMany(Thread::class, 'topic_id');
    }
}
