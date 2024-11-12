<?php

namespace App\Models;

use CodeIgniter\Model;

class CourseModel extends Model
{
    protected $table      = 'courses';  // The name of the table
    protected $primaryKey = 'id';        // The primary key for the table

    // List the fields that can be inserted into the database
    protected $allowedFields = ['course_name', 'price'];

    // Automatically handles created_at and updated_at fields
    protected $useTimestamps = true;
}
