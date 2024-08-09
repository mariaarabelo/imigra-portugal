<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\Content;
use App\Models\Moderator;
use App\Models\Report;
use App\Models\Tag;

class ReportController extends Controller
{
    public function show()
    {
        $tags = Tag::all();

        return view('pages.reports', compact('tags'));     
    }

    public function showModeratorReports()
    {
        $moderatorId = auth('moderator')->id();
        $reports = Report::with('content.question', 'content.answer', 'content.comment')
            ->where('idmoderator', $moderatorId)
            ->get();

        return view('pages.reports', ['reports' => $reports]);
    }

    // *************** Tags ****************

    public function showTags()
    {
        $tags = Tag::all();

        return view('pages.view-tags2', compact('tags'));   
    }

    public function showSearchTag($redirect)
    {
        return view('pages.search-tag2', compact('redirect'));     
    }

    public function searchTag(Request $request)
    {
        $searchTerm = $request->input('searchTerm');

        $tags = Tag::where('description', 'like', "%$searchTerm%")
                      ->get();

        return response()->json(['tags' => $tags]);
    }

    public function editTag($id)
    {
        $tag = Tag::findOrFail($id);

        return view('pages.edit-tag2', compact('tag')); 
    }

    public function updateTag(Request $request, $id)
    {
        $request->validate([
            'description' => 'required|string|max:250',
        ]);

        $tag = Tag::findOrFail($id);
        $tag->description = $request->description;
        $tag->save();

        return redirect()->route('moderator.showTags')
                ->with('success', 'Tag updated successfully!');
    }

    public function deleteTag($id)
    {
        $tag = Tag::findOrFail($id);

        return view('pages.delete-tag2', compact('tag')); 
    }

    public function destroyTag($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();

        return redirect()->route('moderator.showTags')->with('success', 'Tag deleted successfully');
    }


    public function showCreateTagForm()
    {
        return view('pages.create-tag2');     
    }

    public function storeTag(Request $request)
    {
        $request->validate([
            'description' => 'required|string|max:250',
        ]);

        $lastId = $this->getLastTagId();
        if (!$lastId) {
            $lastId = 1;
        } else {
            $lastId = $lastId + 1;
        } 

        $tag = new Tag();
        $tag->id = $lastId;
        $tag->description = $request->description;
        $tag->save();

        return redirect('/moderator') 
            ->withSuccess('Tag created successfully!');    
    }

    public function getLastTagId()
    {
        $lastTag = Tag::latest('id')->first();

        if ($lastTag) {
            $lastTagId = $lastTag->id;
            return $lastTagId;
        } else {
            return null;
        }
    }
}
