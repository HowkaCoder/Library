<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Facultet;
use App\Models\Group;
use App\Models\Student;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search($search){
        $data = Book::select('newbooks.name as Book_Name' , 'janres.name as Janre_Name' , 'authors.name as Author_Name')
        ->join('janres' , 'janres.id' , 'newbooks.janre_id')
        ->join('authors' , 'authors.id' , 'newbooks.author_id')
        ->where('newbooks.name' , 'LIKE' , "%{$search}%")
        ->orWhere('janres.name' , 'LIKE' , "%{$search}%")
        ->orWhere('authors.name' , 'LIKE' , "%{$search}%")
        ->get();
        return $data;
    }

    public function student_search($search){
        
        $data = Student::select("students.name as Student_Name" , "groups.name as Group_Name" , "facultets.name as Facultet_Name" )
            ->join('groups' , 'groups.id' , 'students.group_id')
            ->join('facultets' , 'facultets.id' , 'groups.facultet_id')
            ->where('facultets.name' , 'LIKE' , "%{$search}%")
            ->orWhere('groups.name' , 'LIKE' , "%{$search}%")
            ->orWhere('students.name' , 'LIKE' , "%{$search}%")
            ->get();
            return $data;
    
    }
}
