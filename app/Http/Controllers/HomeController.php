<?php

namespace App\Http\Controllers;

use App\Applications;
use App\News;
use App\Types_applications;
use App\Students;
use App\Http\Controllers\Student;
use App\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    public function index()
    {
        $news = News::with('tags')->orderBy('created_at', 'desc')->paginate(4);
        return view('home.index', compact('news'));
    }

    public function abiturient()
    {
        return view('home.abiturient');
    }

    public function news()
    {
        $news = News::with('tags')->orderBy('created_at', 'desc')->paginate(3);
        return view('home.news', compact('news'));
    }

    public function request()
    {
        $types_applications = Types_applications::pluck('name_category', 'id')->all();
        $students = Students::all();
        $studentEmail = Auth::user()->email; // Получаем email авторизованного пользователя

        // Получаем заявки студента с is_check=0
        $applications = Applications::with(['type', 'student'])
        ->whereHas('student', function ($query) use ($studentEmail) {
            $query->where('email', $studentEmail);
        })
        ->where('is_check', 0)
        ->get();

        return view('home.request', compact('types_applications', 'students', 'applications'));
    }

    public function addApplication(Request $request)
    {
        // Проверка существования студента с данным email
        $student = Students::where('email', $request->email)->firstOrFail();

        // Создание новой заявки
        $application = new Applications();
        $application->id_category = $request->id_category;
        $application->id_stud = $student->id;
        $application->description = $request->description;
        $application->is_check = 0;
        $application->save();

        // Возвращение с сообщением об успехе
        return redirect()->back()->with('success', 'Ваша заявка отправлена.');
    }

    public function laundry()
    {
        return view('home.laundry');
    }

    public function complaint()
    {
        return view('home.complaint');
    }

    public function cabinet()
    {
        $user = auth()->user();
        $student = Students::where('email', $user->email)->first();

        if ($student && $student->room) {
            $roomNumber = $student->room->number;
        } else {
            // Обработка ситуации, когда у студента нет комнаты или email не совпадает
            $roomNumber = 'Номер комнаты не найден';
        }

        if ($student) {
            $balance = $student->balance;
        } else {
            // Обработка ситуации, когда у студента нет записи в таблице
            $balance = 'Баланс не найден';
        }

        if ($student) {
            $fullName = $student->surname . ' ' . $student->name . ' ' . $student->patronymic;
        } else {
            // Обработка ситуации, когда у студента нет записи в таблице
            $fullName = 'Студент не найден';
        }

        return view('home.cabinet', compact('roomNumber', 'balance', 'fullName'));
    }
}
