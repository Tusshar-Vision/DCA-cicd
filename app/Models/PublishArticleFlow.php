<?php

namespace App\Models;

use EightyNine\Approvals\Models\ApprovableModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublishArticleFlow extends ApprovableModel
{
    use HasFactory;

    protected $fillable = ["name"];
}
