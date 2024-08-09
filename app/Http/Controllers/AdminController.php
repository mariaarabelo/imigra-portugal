<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Content;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Comment;
use App\Models\Tag;
use App\Models\ContentTag;
use App\Models\Vote;
use App\Models\UserVoteContent;
use App\Models\Author;
use App\Models\Report;
use App\Models\Notification;

class AdminController extends Controller
{
    // ************* Users ****************
    public function show()
    {
        $users = User::all();
        $questions = Question::all();
        $answers = Answer::all();
        $comments = Comment::all();
        $tags = Tag::all();

        return view('pages.admin', compact('users', 'questions', 'answers', 'comments', 'tags'));     
    }

    public function showUsers()
    {
        $users = User::where('isblocked', '=', 'false')
                    ->orderBy('id', 'asc')
                    ->get();

        return view('pages.view-users', compact('users'));   
    }

    public function showCreateUserForm()
    {
        return view('pages.create-user');     
    }

    public function showSearchUser($redirect)
    {
        return view('pages.search-user', compact('redirect'));     
    }

    public function searchUser(Request $request)
    {
        $searchTerm = $request->input('searchTerm');

        $users = User::where('name', 'like', "%$searchTerm%")
                      ->orWhere('email', 'like', "%$searchTerm%")
                      ->get();

        return response()->json(['users' => $users]);
    }

/*
    public function searchUser(Request $request)
    {
        $searchTerm = $request->input('searchTerm');

        $users = DB::table('users')
            ->select('id', 'name', 'email')
            ->whereRaw("to_tsvector('english', name || ' ' || email) @@ to_tsquery('english', ?)", [$searchTerm])
            ->get();

        return response()->json(['users' => $users]);
    }
*/

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);

        return view('pages.delete-user', compact('user')); 
    }


    public function destroyUser($id)
    {
        UserVoteContent::where('iduser', $id)->delete();

        // Excluir os comentarios, respostas e perguntas do utilizador
        $contents = Content::whereHas('author', function ($query) use ($id) {
            $query->where('iduser', $id);
        })->get();

        foreach ($contents as $content) {
            if($content->comments) {
                foreach ($content->comments as $comment) {
                    $comment->delete();
                }
            }
            
            if($content->answers) {
                foreach ($content->answers as $answer) {
                    $answer->delete();
                }
            }
            
            $content->question()->delete();
        }

        Author::where('iduser', $id)->delete();
        Report::where('iduser', $id)->delete();
        Notification::where('iduser', $id)->delete();

        // Finalmente, excluir o utilizador
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.show')->with('success', 'User deleted successfully');
    }


    public function editUser($id)
    {
        $user = User::findOrFail($id);

        return view('pages.edit-user', compact('user')); 
    }

    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:250',
            'email' => 'required|email|max:250|unique:users,email,'.$id,
            'birthdate' => 'required|date'
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->birthdate = $request->birthdate;
        $user->save();

        return redirect()->route('admin.show')
                ->with('success', 'User updated successfully!');
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:250',
            'email' => 'required|email|max:250|unique:users',
            'password' => 'required|min:8|confirmed',
            'birthdate' => 'required|date'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->birthdate = $request->birthdate;
        $user->regdate = now();
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect('/admin')
            ->withSuccess('User created successfully!');
    }

    public function blockedUsers()
    {
        $users = User::where('isblocked', '=', 'true')
                    ->orderBy('id', 'asc')
                    ->get();

        return view('pages.blocked-users', compact('users')); 
    }

    public function blockUser($id)
    {
        $user = User::findOrFail($id);
        $user->isblocked = true;
        $user->save();

        return redirect()->back()->with('success', 'User blocked successfully');
    }

    public function unblockUser($id)
    {
        $user = User::findOrFail($id);
        $user->isblocked = false;
        $user->save();

        return redirect()->back()->with('success', 'User unblocked successfully');
    }

    // *************** Tags ****************

    public function showTags()
    {
        $tags = Tag::all();

        return view('pages.view-tags', compact('tags'));   
    }

    public function showSearchTag($redirect)
    {
        return view('pages.search-tag', compact('redirect'));     
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

        return view('pages.edit-tag', compact('tag')); 
    }

    public function updateTag(Request $request, $id)
    {
        $request->validate([
            'description' => 'required|string|max:250',
        ]);

        $tag = Tag::findOrFail($id);
        $tag->description = $request->description;
        $tag->save();

        return redirect()->route('admin.show')
                ->with('success', 'Tag updated successfully!');
    }

    public function deleteTag($id)
    {
        $tag = Tag::findOrFail($id);

        return view('pages.delete-tag', compact('tag')); 
    }

    public function destroyTag($id)
    {
        $tag = Tag::findOrFail($id);

        ContentTag::where('idtag', $tag->id)->delete();

        $tag->delete();

        return redirect()->route('admin.show')->with('success', 'Tag deleted successfully');
    }


    public function showCreateTagForm()
    {
        return view('pages.create-tag');     
    }

    public function storeTag(Request $request)
    {
        $request->validate([
            'description' => 'required|string|max:250',
        ]);

        $tag = new Tag();
        $tag->description = $request->description;
        $tag->save();

        return redirect('/admin') 
            ->withSuccess('Tag created successfully!');    
    }
}
