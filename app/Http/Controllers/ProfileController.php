<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Author;
use App\Models\Question;
use App\Models\Content;
use App\Models\Answer;
use App\Models\Comment;

class ProfileController extends Controller
{
    public function show($userId)
    {

        // Obter o usuário com base no ID fornecido
        $user = User::findOrFail($userId);

        // Carregar as perguntas, respostas e comentários associados ao usuário
        $questions = $user->questions()->with('content')->get();
        $answers = $user->answers()->with('content')->get();
        $comments = $user->comments()->with('content')->get();


        // Retornar a view de perfil com os dados do usuário
        return view('profiles.show', compact('user', 'questions', 'answers', 'comments'));
        
    }

    public function updateEmail(Request $request, $userId)
    {    
        $user = User::findOrFail($userId);
   
        try {
            $request->validate([
                'email' => 'required|email|unique:users,email,' . $userId,
            ]);
            $user->email = $request->input('email');
            $user->save();
    
            $updatedEmail = $user->email;
            return response()->json([
                'message' => 'Email updated successfully',
                'email' => $updatedEmail,
            ]);    

        } catch (ValidationException $e) {
            // Validation failed
            $errors = $e->validator->errors()->all();

            return response()->json(['error' => $errors], 422);
        } catch (\Exception $e) {
            // Other exceptions (e.g., database error)
            return response()->json(['error' => [$e->getMessage()]], 500); // Internal Server Error
        } 
    }

    public function updatePass(Request $request, $userId)
    {    
        $user = User::findOrFail($userId);
   
        try {
            $request->validate([
                'oldPassword' => 'required|old_password',
                'newPassword' => 'required|min:6',
                'newPasswordConfirm' => 'required|same:newPassword',
            ]);
    
            // Perform the password change logic
            $user->password = bcrypt($request->input('newPassword'));
            $user->save();
    
            return response()->json(['success' => true, 'message' => 'Password changed successfully']);
        } catch (ValidationException $e) {
            // Validation failed
            $errors = $e->validator->errors()->all();
    
            return response()->json(['error' => $errors], 422); 
        } catch (\Exception $e) {
            // Other exceptions (e.g., database error)
            return response()->json(['error' => [$e->getMessage()]], 500); // Internal Server Error
        }
    }

}
