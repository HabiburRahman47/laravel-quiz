<?php
/*
*   07.11.2019
*   MenusMenu.php
*/

namespace App\Http\Menus;

use App\MenuBuilder\MenuBuilder;
use Illuminate\Support\Collection;
use App\Models\Menus;
use App\MenuBuilder\RenderFromDatabaseData;

class GetSidebarMenu implements MenuInterface
{

    private $mb; //menu builder
    private $menu;

    public function __construct()
    {
        $this->mb = new MenuBuilder();
    }

    private function getMenuFromDB($menuId, $menuName)
    {
        $this->menu = $this->getAppMenu($menuId);
    }

    private function getAppMenu($menuId): Collection
    {
        $menuToBuild = null;
        $dashboard = ["id" => 1, "parent_id" => null, "name" => "Dashboard", "href" => "/", "icon" => "cil-speedometer", "slug" => "link"];
        //
        $settings = ["id" => 10, "parent_id" => null, "name" => "Settings", "href" => null, "icon" => "cil-calculator", "slug" => "dropdown"];
        $settingsNotes = ["id" => 11, "parent_id" => $settings["id"], "name" => "Notes", "href" => "/notes", "icon" => null, "slug" => "link"];
        $settingsEmail = ["id" => 12, "parent_id" => $settings["id"], "name" => "Email", "href" => "/mail", "icon" => null, "slug" => "link",];
        //
        $themeSection = ["id" => 19, "parent_id" => null, "name" => "Theme", "href" => null, "icon" => null, "slug" => "title",];
        $color = ["id" => 20, "parent_id" => null, "name" => "Colors", "href" => "/colors", "icon" => "cil-drop1", "slug" => "link"];

        //property
        $propertySection = ["id" => 30, "parent_id" => null, "name" => "Property", "href" => null, "icon" => "cil-calculator", "slug" => "dropdown"];
        $propertyTypes = ["id" => 31, "parent_id" => $propertySection["id"], "name" => "PropertyTypes", "href" => route('web.admin.property-types.index'), "icon" => null, "slug" => "link"];
        $property = ["id" => 32, "parent_id" => $propertySection["id"], "name" => "Properties", "href" => route('web.admin.properties.index'), "icon" => null, "slug" => "link",];

        //department
        $departmentSection = ["id" => 36, "parent_id" => null, "name" => "Department Management", "href" => null, "icon" => "cil-calculator", "slug" => "dropdown"];
        $department = ["id" => 37, "parent_id" => $departmentSection["id"], "name" => "Department", "href" => route('web.admin.departments.index'), "icon" => null, "slug" => "link"];
        //section
        $section = ["id" => 38, "parent_id" => $departmentSection["id"], "name" => "Section", "href" => route('web.admin.sections.index'), "icon" => null, "slug" => "link"];
        //course
        $course = ["id" => 49, "parent_id" => $departmentSection["id"], "name" => "Course", "href" => route('web.admin.courses.index'), "icon" => null, "slug" => "link"];
        //section-course
        $sectionCourse = ["id" => 50, "parent_id" => $departmentSection["id"], "name" => "Section With Course", "href" => route('web.admin.section-courses.index'), "icon" => null, "slug" => "link"];
        //course-section-teacher
        $courseSectionTeacher = ["id" => 51, "parent_id" => $departmentSection["id"], "name" => "Course Section Teacher", "href" => route('web.admin.course-section-teachers.index'), "icon" => null, "slug" => "link"];
        //student
        $student = ["id" => 52, "parent_id" => $departmentSection["id"], "name" => "Student", "href" => route('web.admin.students.index'), "icon" => null, "slug" => "link"];

        //Attendance
        $attendanceSection = ["id" => 60, "parent_id" => null, "name" => "Attendance Management", "href" => null, "icon" => "cil-calculator", "slug" => "dropdown"];
        $attendance = ["id" => 61, "parent_id" => $attendanceSection["id"], "name" => "Attendance", "href" => route('web.admin.attendances.index'), "icon" => null, "slug" => "link"];
        //card
        $card = ["id" => 62, "parent_id" => $attendanceSection["id"], "name" => "Card", "href" => route('web.admin.cards.index'), "icon" => null, "slug" => "link"];

        //Quiz
        $quizSection = ["id" => 70, "parent_id" => null, "name" => "Quiz Management", "href" => null, "icon" => "cil-calculator", "slug" => "dropdown"];
        $quiz = ["id" => 71, "parent_id" => $quizSection["id"], "name" => "Quiz", "href" => route('web.admin.quizzes.index'), "icon" => null, "slug" => "link"];
        //Quiz-result
        //  $quizResult= ["id" => 72, "parent_id" => $quizSection["id"], "name" => "Quiz Result", "href" => route('web.admin.quiz-results.index'), "icon" => null, "slug" => "link"];
          $quizResult = ["id" => 72, "parent_id" => $quizSection["id"], "name" => "Quiz Result", "href" => route('web.admin.quiz-results.index'), "icon" => null, "slug" => "link"];
       
        //question
        $question = ["id" => 73, "parent_id" => $quizSection["id"], "name" => "Question", "href" => route('web.admin.questions.index'), "icon" => null, "slug" => "link"];
        $questionChoice = ["id" => 74, "parent_id" => $quizSection["id"], "name" => "Question With Choice", "href" => route('web.admin.question-choices.index'), "icon" => null, "slug" => "link"];
        //choice
        $choice = ["id" => 75, "parent_id" => $quizSection["id"], "name" => "Choice", "href" => route('web.admin.choices.index'), "icon" => null, "slug" => "link"];
        //quiz-question
        $quizQuestion = ["id" => 76, "parent_id" => $quizSection["id"], "name" => "Quiz With Question", "href" => route('web.admin.quiz-questions.index'), "icon" => null, "slug" => "link"];
          //category
        $category = ["id" => 77, "parent_id" => $quizSection["id"], "name" => "Category", "href" => route('web.admin.categories.index'), "icon" => null, "slug" => "link"];
        //quiz-session
        $quizSession = ["id" => 78, "parent_id" => $quizSection["id"], "name" => "Quiz Session", "href" => route('web.admin.quiz-sessions.index'), "icon" => null, "slug" => "link"];
        //quiz-session-answer
         $quizSessionAns = ["id" => 78, "parent_id" => $quizSection["id"], "name" => "Quiz Session Answer", "href" => route('web.admin.quiz-session-answers.index'), "icon" => null, "slug" => "link"];

       


       






        //////////////////////////////
        $leftMenuData = [
            $dashboard,
            $propertySection,$propertyTypes,$property,$departmentSection,$department,$section,$course,$sectionCourse,$courseSectionTeacher,
            $student,$card,$attendance,$attendanceSection,$quiz,$quizSection,$quizResult,$category,$question,$questionChoice,$choice,$quizQuestion,$quizSession,$quizSessionAns,

            $settings, $settingsNotes, $settingsEmail,
            $themeSection, $color,
        ];
        //
        $topMenuData = [$dashboard, $settings, $settingsNotes, $settingsEmail];


        if ($menuId == 1) {
            return $this->buildMenu($leftMenuData, $menuId);
        }
        return $this->buildMenu($topMenuData, $menuId);

    }

    public function get($role, $menuId = 2)
    {
        $this->getMenuFromDB($menuId, $role);
        $rfd = new RenderFromDatabaseData;
        return $rfd->render($this->menu);
    }

    /**
     * @param $menuItemsData
     * @param $menuId
     * @return Collection
     */
    private function buildMenu($menuItemsData, $menuId): Collection
    {
        $menuCollection = new Collection();
        $sequence = 1;
        foreach ($menuItemsData as $menuItemData) {
            $menu = new Menus();
            $menu->fill($menuItemData);
            $menu->menu_id = $menuId;
            $menu->sequence = $sequence++;
            $menuCollection->add($menu);
        }
        return $menuCollection;
    }
}
