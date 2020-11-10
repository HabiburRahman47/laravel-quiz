<?php


namespace App\Http\Controllers\Web\Admin;


use App\Http\Controllers\Controller;

class AdminBaseController extends Controller
{
    public function flashStoredMsg($displayUrl)
    {
        flash()->success("Created Successfully. <a href=\"$displayUrl\">Click here </a> to view it.")->important();
    }

    public function flashUpdatedMsg($displayUrl)
    {
        flash()->success("Updated Successfully. <a href=\"$displayUrl\">Click here </a> to view it.")->important();
    }
}
