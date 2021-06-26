<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str; // use this for mutators
use Illuminate\Database\Eloquent\SoftDeletes;

class Story extends Model
{
    use SoftDeletes;
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'body', 'type', 'status',
    ];

    // if applicable laravel will no check for mass assignment
    // protected $guarded= [];

    // Relationship with User Model because story belongs to user
    public function user()
    {
    	return $this->belongsTo(\App\User::class);
    }

    // Tags relationship
    public function tags()
    {
        return $this->belongsToMany(\App\Tag::class);
    }

    // visitors can not view the inactive story also include the builder for this
    protected static function booted()
    {
        // static::addGlobalScope('active', function(Builder $builder){
        //     $builder->where('status', 1);
        // });
    }

    // for getting the first letter capital of title (Called it Accessor)
    public function getTitleAttribute( $value )
    {
        return ucfirst($value);
    }

    // Custome Accessor
    public function getFootnoteAttribute()
    {
        return 'type: ' . $this->type . ', created at: ' . date('y-m-d', strtotime($this->created_at));
    }

    // creating mutators with set property while accessor use get property
    public function setTitleAttribute( $value )
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function getThumbnailAttribute()
    {
        if($this->image){
            return asset('storage/'. $this->image);
        }else{
            return asset('storage/thumbnail.jpg');
        }
    }
}
