<?php

namespace App\Http\Controllers\API\V1\Site\Course;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\V1\Site\Course\CourseSectionResource;
use App\Models\V1\Course\CourseSection;

class CourseSectionController extends Controller
{

    public function show($courseSectionId)
    {
        $courseSection=CourseSection::with('section','course')->findOrFail($courseSectionId);
        return new CourseSectionResource($courseSection);
    }



}
