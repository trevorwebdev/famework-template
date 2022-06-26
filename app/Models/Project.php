<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Images;

class Project extends Model {

    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'organization',
        'description',
        'url',
        'priority'
    ];

    protected $dates = ['deleted_at'];


    // Using a pivot table to get all the images associated with the project. This Project belongs to many Images.
    public function images() {

        return $this->belongsToMany(Image::class);
    }

    public function toStandardClass() {

        $project = new \stdClass();

        $project->id = $this->id;
        $project->priority = $this->priority;
        $project->created_at = $this->created_at->format("D, F, Y");
        $project->title = $this->title;
        $project->url = $this->url;
        $project->organization = $this->organization;
        $project->description = $this->description;
        $project->images = $this->images;

        return $project;
    }
}
