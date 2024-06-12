<?php

namespace App\Http\Controllers;

use App\Applications;
use App\Laundries;
use App\News;
use App\Tags;
use App\Types_applications;
use App\Students;
use App\Http\Controllers\Student;
use App\Application;
use App\Washing_machines;
use Carbon\Carbon;
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
        $tags = Tags::with('news')->get(); 
        return view('home.news', compact('news', 'tags'));
    }

    public function tag($tagId)
    {
        $tag = Tags::where('id', $tagId)->with('news')->firstOrFail();
        $news = $tag->news()->orderBy('created_at', 'desc')->paginate(3);
        return view('home.news', compact('news', 'tag'));
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
        $machines = Washing_machines::all('id');
        $bookings = Laundries::select('id_mash', 'date_wash', 'time_wash')
        ->where('date_wash', '>=', now()->toDateString())
            ->get()
            ->map(function ($booking) {
                // Преобразуем строку в объект Carbon перед форматированием
                $booking->date_wash = Carbon::createFromFormat('Y-m-d', $booking->date_wash)->format('Y-m-d');
                $booking->time_wash = Carbon::createFromFormat('H:i:s', trim($booking->time_wash))->format('H:i');
                return $booking;
            });

        // Получаем email авторизованного пользователя
        $userEmail = auth()->user()->email;
        
        // Получаем ID студента из таблицы students, используя email
        $studentId = Students::where('email', $userEmail)->first()->id;
        // dd($studentId);
        // Передаем данные в представление
        return view('home.laundry', compact('machines', 'bookings', 'studentId'));
    }

    public function createBooking(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'id_mash' => 'required|integer',
                'date_wash' => 'required|date',
                'time_wash' => 'required',
                'id_stud' => 'required|integer',
            ]);

            // Создаем новую запись в таблице laundries
            Laundries::create($validatedData);

            // Возвращаем ответ об успешном создании записи
            return response()->json(['success' => true]);
        } catch (\Throwable $e) {
            // Логируем ошибку
            \Illuminate\Support\Facades\Log::error('Ошибка при создании бронирования: ' . $e->getMessage());

            // Возвращаем JSON-ответ с информацией об ошибке
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    public function getMachinesData()
    {
        $machines = Washing_machines::all('id');
        return response()->json($machines);
    }

    public function getBookings()
    {
        $bookings = Laundries::all('id_mash', 'date_wash', 'time_wash');
        return response()->json($bookings);
    }

    public function cabinet()
    {
        $user = auth()->user();
        $student = Students::where('email', $user->email)->first();

        if ($student && $student->room) {
            $roomNumber = $student->room->number;
        } else {
            $roomNumber = 'Номер комнаты не найден';
        }

        if ($student) {
            $balance = $student->balance;
        } else {
            $balance = 'Баланс не найден';
        }

        if ($student) {
            $fullName = $student->surname . ' ' . $student->name . ' ' . $student->patronymic;
        } else {
            $fullName = 'Студент не найден';
        }

        if ($student) {
            $propertiesList = $student->properties->map(function ($property) {
                return "<li>" . htmlspecialchars($property->title, ENT_QUOTES, 'UTF-8')
                . " (" . htmlspecialchars($property->mark, ENT_QUOTES, 'UTF-8') . ")</li>";
            })->implode('');

            // Если список имущества не пуст, создаем список в HTML, иначе оставляем $properties пустым
            $properties = !empty($propertiesList) ? "<ul>$propertiesList</ul>" : '';
        } else {
            $properties = 'Информация о студенте не найдена';
        }

        // Получаем записи о стирке для студента, начиная с сегодняшнего дня
        $laundryRecords = Laundries::where('id_stud', $student->id)
        ->where('date_wash', '>=', Carbon::today()->toDateString())
        ->orderBy('date_wash')
        ->orderBy('time_wash')
        ->get();

        // Формируем список записей на стирку
        $laundryList = $laundryRecords->map(function ($record) {
            $date = new Carbon($record->date_wash);
            // Форматируем время, убирая секунды и информацию о годе
            $time = (new Carbon($record->time_wash))->format('H:i');
            return "<li>" . $date->locale('ru')->isoFormat('dddd, DD.MM.YYYY') . " в " . $time . " (" . $record->id_mash . " машинка)</li>";
        })->implode('');

        // Проверяем, есть ли записи на стирку
        $laundryStatus = !empty($laundryList) ? 'Вы записаны на стирку :' : 'Вы пока не записаны на стирку';

        return view('home.cabinet', compact('roomNumber', 'balance', 'fullName','properties', 'laundryStatus', 'laundryList'));
    }
}
