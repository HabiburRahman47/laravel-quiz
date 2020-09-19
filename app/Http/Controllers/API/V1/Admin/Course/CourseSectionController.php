<?php

namespace App\Http\Controllers\API\V1\Admin\Course;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\V1\Admin\Course\CourseSectionResource;
use App\Model\V1\Course\CourseSection;

class CourseSectionController extends Controller
{

    public function show($courseSectionId)
    {
        $courseSection=CourseSection::with('section','course')->findOrFail($courseSectionId);
        return new CourseSectionResource($courseSection);
    }



}
