<?php

namespace App\Models;

use CodeIgniter\Model;

class AnnouncementModel extends Model
{
    protected $table      = 'anouncements';  // The name of the table
    protected $primaryKey = 'id';        // The primary key for the table

    // List the fields that can be inserted into the database
    protected $allowedFields = ['title', 'description','image'];

    // Automatically handles created_at and updated_at fields
}
