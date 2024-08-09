<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Content;
use App\Models\Report;

class ContentController extends Controller
{

    public function destroyContent($id) //used for report management by moderator
    {
        $content = Content::findOrFail($id);

        // Update reports with the given content id to set id_content to NULL
        Report::where('idcontent', $id)->update(['idcontent' => null]);
        Report::where('idcontent', $id)->update(['status' => TRUE]);

        $content->delete();

        return back()->with('success', 'Content deleted successfully');
    }

}
